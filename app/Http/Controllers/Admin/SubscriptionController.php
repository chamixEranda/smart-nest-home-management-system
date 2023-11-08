<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_subscription_list = Subscription::active()->get();
        return view('admin-views.subscription.index',compact('lims_subscription_list'));
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
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        $subscription = new Subscription();
        $subscription->title = $request->title;
        $subscription->price = $request->price;
        $subscription->description = $request->description;
        $subscription->save();

        DB::commit();

        Toastr::success(translate('messages.subscription_added_successfully'), 'success');
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
        $subscription = Subscription::find($id);
        return view('admin-views.subscription.edit',compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $subscription = Subscription::find($id);
        $subscription->update($data);

        DB::commit();

        Toastr::success(translate('messages.subscription_updated_successfully'), 'Success');
        return redirect()->route('admin.subscription.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $subscription = Subscription::find($id);
        $subscription->is_active = false;
        $subscription->save();

        DB::commit();

        Toastr::success(translate('messages.subscription_deleted_successfully'), 'Success');
        return back();
    }
}
