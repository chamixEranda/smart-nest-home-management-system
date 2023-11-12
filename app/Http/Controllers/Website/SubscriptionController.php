<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'subscription_id'     => 'required',
            'card_number'         => 'required',
            'expiry_date'         => 'required',
            'cvv'         => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $subscription = Subscription::find($data['subscription_id']);
        $data['user_id'] = auth()->user()->id;
        $data['amount'] = $subscription->price;
        $lims_payment_create = SubscriptionPayment::create($data);

        $user = User::find(auth()->user()->id);
        $user->subscription_id = $subscription->id;
        $user->save();

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.your_subscription_successfully_activated')]);
    }
}
