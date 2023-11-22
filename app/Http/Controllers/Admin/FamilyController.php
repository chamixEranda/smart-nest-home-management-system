<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\FamilyPlanCategory;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $family_members = FamilyMember::active()->get();
        return view('admin-views.family-member.index', compact('family_members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plan_categories = FamilyPlanCategory::active()->get();
        return view('admin-views.family-plans.index',compact('plan_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'image'                  => 'required',
            'description'           => 'required',
        ]);

        DB::beginTransaction();

        $data = $request->all();
        if ($request->has('image')) {
            $image_name = Helpers::update('plans/', null, 'png', $request->file('image'));
            $data['image'] = $image_name;
        }
        FamilyPlanCategory::create($data);

        DB::commit();
        Toastr::success(translate('messages.successfully_created'));
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
        $plan_category = FamilyPlanCategory::find($id);
        return view('admin-views.family-plans.edit',compact('plan_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'                  => 'required',
            'description'           => 'required',
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $lims_category = FamilyPlanCategory::find($id);
        if ($request->has('image')) {
            $image_name = Helpers::update('plans/', null, 'png', $request->file('image'));
            $data['image'] = $image_name;
        }
        $lims_category->update($data);

        DB::commit();
        Toastr::success(translate('messages.successfully_created'));
        return redirect()->route('admin.relationship-management.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $lims_category = FamilyPlanCategory::find($id);
        $lims_category->is_active = false;
        $lims_category->save();

        DB::commit();

        Toastr::success(translate('messages.eleted_successfully'));
        return redirect()->route('admin.relationship-management.create');
    }
}
