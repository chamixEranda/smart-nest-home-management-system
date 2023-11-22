<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $payments = SubscriptionPayment::get();

        $labels = $payments->pluck('created_at');

        $paymentValues = $payments->pluck('amount');

        $totalEarning = SubscriptionPayment::sum('amount');

        $lims_user_list = User::latest()->limit(5)->get();
        
        return view('admin-views.dashboard', compact('labels', 'paymentValues', 'totalEarning', 'lims_user_list'));
    }
}
