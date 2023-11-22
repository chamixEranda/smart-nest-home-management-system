<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyPlan;
use App\Models\FamilyPlanCategory;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

class FamilyProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $family_plans = FamilyPlan::where('user_id', auth()->user()->id)->active()->paginate(5);
        return view('website.relationship-management.family-projects.index',compact('family_plans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plan_categories = FamilyPlanCategory::active()->get();
        return view('website.relationship-management.family-projects.create',compact('plan_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'              => 'required',
            'image'             => 'required',
            'expense'           => 'required',
            'amount'            => 'required',
            'description'       => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();
        $result = [];
        
        $family_plan = new FamilyPlan();
        $family_plan->user_id = auth()->user()->id;
        $family_plan->plan_category_id = $request->plan_category_id;
        $family_plan->description = $request->description;
        $family_plan->title = $request->title;
        $family_plan->date = $request->date;
        $document = $request->image;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ]);
            }
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = date("Ymdhis");
            if(!config('database.connections.cloudnist_saas')) {
                $documentName = $documentName . '.' . $ext;
                $document->move('public/documents/plans', $documentName);
            }
            else {
                $documentName = $this->getTenantId() . '_' . $documentName . '.' . $ext;
                $document->move('public/documents/plans', $documentName);
            }
            $family_plan->image = $documentName;
        }
        $total_budget = 0;
        for ($i = 0; $i < count($request['expense']); $i++) {
            $total_budget += $request['amount'][$i];
            $result[] = [
                'name' => $request['expense'][$i],
                'amount' => $request['amount'][$i],
            ];
        }
        $family_plan->budget_info = json_encode($result);
        

        $lims_expense_category = ExpenseCategory::whereRaw('LOWER(name) = ?', [strtolower('Family Plans')])
        ->where('user_id', auth()->user()->id)->first();
        if (!$lims_expense_category) {
            $lims_expense_category = new ExpenseCategory();
            $lims_expense_category->name = 'Family Plans';
            $lims_expense_category->color = '#'.dechex(rand(0x000000, 0xFFFFFF));
            $lims_expense_category->user_id = auth()->user()->id;
            $lims_expense_category->save();
        }

        $lims_expense = new Expense();
        $lims_expense->user_id = auth()->user()->id;
        $lims_expense->expense_category_id = $lims_expense_category->id;
        $lims_expense->name = $family_plan->title;
        $lims_expense->purpose = $family_plan->title;
        $lims_expense->date = $family_plan->date;
        $lims_expense->amount = $total_budget;
        $lims_expense->save();

        $family_plan->expense_id = $lims_expense->id;
        $family_plan->save();


        DB::commit();
        return response()->json(['status' => true, 'message' => translate('messages.plan_created_successfully')]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lims_family_plan = FamilyPlan::find($id);
        $plan_categories = FamilyPlanCategory::active()->get();
        return view('website.relationship-management.family-projects.edit',compact('plan_categories','lims_family_plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title'              => 'required',
            'expense'           => 'required',
            'amount'            => 'required',
            'description'       => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $lims_plan_data = FamilyPlan::find($id);
        $lims_plan_data->plan_category_id = $request->plan_category_id;
        $lims_plan_data->description = $request->description;
        $lims_plan_data->title = $request->title;
        $lims_plan_data->date = $request->date;
        $document = $request->image;
        if ($document) {
            if ($lims_plan_data->image && file_exists('public/documents/plans/'.$lims_plan_data->image)) {
                unlink('public/documents/plans/'.$lims_plan_data->image); 
            }
            $documentName = $document->getClientOriginalName();
            $document->move('public/documents/plans', $documentName);
            $lims_plan_data->image = $documentName;
        }
        $total_budget = 0;
        for ($i = 0; $i < count($request['expense']); $i++) {
            $total_budget += $request['amount'][$i];
            $result[] = [
                'name' => $request['expense'][$i],
                'amount' => $request['amount'][$i],
            ];
        }
        $lims_plan_data->budget_info = json_encode($result);
        $lims_plan_data->save();

        $lims_expense = Expense::find($lims_plan_data->expense_id);
        $lims_expense->name = $lims_plan_data->title;
        $lims_expense->purpose = $lims_plan_data->title;
        $lims_expense->date = $lims_plan_data->date;
        $lims_expense->amount = $total_budget;
        $lims_expense->save();

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.plan_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $lims_plan_data = FamilyPlan::find($id);
        if($lims_plan_data->image && file_exists('public/documents/recipes/'.$lims_plan_data->image)) {
            unlink('public/documents/plans/'.$lims_plan_data->image); 
        }
        $lims_expense = Expense::find($lims_plan_data->expense_id);
        $lims_expense->delete();
        $lims_plan_data->delete();

        DB::commit();

        return back();
    }
}
