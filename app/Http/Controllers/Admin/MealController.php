<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealItem;
use App\Models\MealType;
use App\Models\MealCategory;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_meal_list = MealItem::with(['category','type'])->active()->get();

        return view('admin-views.meal_item.index',compact('lims_meal_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lims_category_list = MealCategory::active()->get();
        $lims_type_list = MealType::active()->get();

        return view('admin-views.meal_item.create',compact('lims_category_list','lims_type_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'image'                 => 'required',
            'meal_category_id'      => 'required',
            'meal_type_id'          => 'required',
        ]);

        DB::beginTransaction();
        
        $meal_item = new MealItem();
        $meal_item->name = $request->input('name');
        $meal_item->meal_categroy_id = $request->input('meal_category_id');
        $meal_item->meal_type_id = $request->input('meal_type_id');
        $meal_item->description = $request->input('description');
        if ($request->has('image')) {
            $image_name = Helpers::update('meal/', null, 'png', $request->file('image'));
            $meal_item->image = $image_name;
        }
        $meal_item->is_active = true;
        $meal_item->save();

        DB::commit();

        Toastr::success(translate('messages.meal_added_successfully'));
        return redirect()->route('admin.meal-item.index');
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
        $lims_category_list = MealCategory::active()->get();
        $lims_type_list = MealType::active()->get();
        $lims_meal_data = MealItem::find($id);

        return view('admin-views.meal_item.edit',compact('lims_category_list','lims_type_list','lims_meal_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'                  => 'required',
            'meal_category_id'      => 'required',
            'meal_type_id'          => 'required',
        ]);

        DB::beginTransaction();

        $lims_meal_data = MealItem::find($id);
        if ($request->has('image')) {
            $image_name = Helpers::update('meal/', $lims_meal_data->image, 'png', $request->file('image'));
            $lims_meal_data->image = $image_name;
        }
        $lims_meal_data->name = $request->input('name');
        $lims_meal_data->meal_categroy_id = $request->input('meal_category_id');
        $lims_meal_data->meal_type_id = $request->input('meal_type_id');
        $lims_meal_data->description = $request->input('description');
        $lims_meal_data->save();

        DB::commit();

        Toastr::success(translate('messages.meal_updated_successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $meal = MealItem::find($id);
        $meal->is_active = false;
        $meal->save();

        DB::commit();

        Toastr::success(translate('messages.meal_deleted_successfully'));
        return redirect()->route('admin.meal-item.index');
    }
}
