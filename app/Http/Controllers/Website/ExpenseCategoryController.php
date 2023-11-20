<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_category_list = ExpenseCategory::where('user_id', auth()->user()->id)->active()->paginate(10);
        return view('website.finance.expenses.expense_category',compact('lims_category_list'));
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
            'name'              => 'required|unique:income_categories',
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
        ExpenseCategory::create($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.expense_category_created_successfully')]);
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
            'name'              => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $lims_category_data = ExpenseCategory::find($id);
        $lims_category_data->update($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.expense_category_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $lims_category_data = ExpenseCategory::find($id);
        $lims_category_data->is_active = false;
        $lims_category_data->save();

        DB::commit();

        return back();
    }
}
