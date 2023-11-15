<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealType;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class MealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_type_list = MealType::active()->get();
        return view('admin-views.meal_type.index',compact('lims_type_list'));
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
        DB::beginTransaction();

        $data = $request->all();
        $data['is_active'] = true;
        MealType::create($data);

        DB::commit();

        Toastr::success(translate('messages.type_added_successfully'));
        return back();
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
        DB::beginTransaction();

        $data = $request->all();
        $lims_type_data = MealType::find($request->id);
        $lims_type_data->update($data);

        DB::commit();

        Toastr::success(translate('messages.type_updated_successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $lims_type_data = MealType::find($id);
        $lims_type_data->is_active = false;
        $lims_type_data->save();

        DB::commit();

        Toastr::success(translate('messages.type_deleted_successfully'));
        return back();
    }
}
