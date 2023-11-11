<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $lims_subscription_list = Subscription::active()->get();
        return view('pricing',compact('lims_subscription_list'));
    }

    public function checkout()
    {
        $lims_subscription_list = Subscription::active()->get();
        return view('pricing-checkout',compact('lims_subscription_list'));
    }

    public function checkoutStore(Request $request)
    {
        dd($request);
    }
}
