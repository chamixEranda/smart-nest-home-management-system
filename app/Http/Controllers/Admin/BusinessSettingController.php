<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class BusinessSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-views.business-setting.index');
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

        DB::table('business_settings')->updateOrInsert(['key' => 'business_name'], [
            'value' => $request['business_name']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'currency'], [
            'value' => $request['currency']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'phone'], [
            'value' => $request['phone']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'email_address'], [
            'value' => $request['email']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'address'], [
            'value' => $request['address']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'footer_text'], [
            'value' => $request['footer_text']
        ]);

        DB::table('business_settings')->updateOrInsert(['key' => 'about_text'], [
            'value' => $request['about_text']
        ]);

        $curr_logo = BusinessSetting::where(['key' => 'logo'])->first();
        if ($request->has('logo')) {
            $image_name = Helpers::update('business/', $curr_logo = null, 'png', $request->file('logo'));
        } else {
            $image_name = $curr_logo['value'];
        }

        DB::table('business_settings')->updateOrInsert(['key' => 'logo'], [
            'value' => $image_name
        ]);

        $fav_icon = BusinessSetting::where(['key' => 'icon'])->first();
        if ($request->has('icon')) {
            $image_name = Helpers::update('business/', $fav_icon = null, 'png', $request->file('icon'));
        } else {
            $image_name = $fav_icon['value'];
        }

        DB::table('business_settings')->updateOrInsert(['key' => 'icon'], [
            'value' => $image_name
        ]);

        DB::commit();

        Toastr::success(translate('messages.successfully_updated'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
