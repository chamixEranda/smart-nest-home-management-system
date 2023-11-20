<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_expenses_list = Expense::where('user_id', auth()->user()->id)->paginate(10);
        $lims_category_list = ExpenseCategory::where('user_id', auth()->user()->id)->active()->get();
        return view('website.finance.expenses.expenses', compact('lims_expenses_list','lims_category_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'expense_category_id'   => 'required',
            'amount'                => 'required',
            'date'                  => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Expense::create($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.expense_created_successfully')]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'expense_category_id'   => 'required',
            'amount'                => 'required',
            'date'                  => 'required',
            'purpose'               => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $lims_expense_data = Expense::find($id);
        $lims_expense_data->update($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.expense_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $lims_expense_data = Expense::find($id);
        $lims_expense_data->delete();

        DB::commit();

        return back();
    }
}
