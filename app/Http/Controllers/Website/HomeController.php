<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessSetting;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function about_us()
    {
        return view('about-us');
    }

    public function contact_us()
    {
        $business_phone = BusinessSetting::where('key', 'phone')->first();
        $business_email = BusinessSetting::where('key', 'email_address')->first();
        $business_address = BusinessSetting::where('key', 'address')->first();
        return view('contact_us',compact('business_phone','business_email', 'business_address'));
    }
}
