<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use App\Models\Income;
use App\Models\IncomeCategory;


class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_income_list = Income::paginate(10);
        $lims_category_list = IncomeCategory::active()->get();
        return view('website.finance.incomes.incomes', compact('lims_income_list','lims_category_list'));
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
            'income_category_id'    => 'required',
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
        Income::create($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.income_created_successfully')]);
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
            'income_category_id'    => 'required',
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
        $lims_income_data = Income::find($id);
        $lims_income_data->update($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.income_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $income = Income::find($id);
        $income->delete();

        DB::commit();

        return back();
    }
}
