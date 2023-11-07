<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\CentralLogics\Helpers;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function loginCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6|max:20',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $creds = $request->only('email','password');
            if (Auth::guard('web')->attempt($creds) ) {
                return response()->json(['status' => true, 'message' => translate('messages.you_are_logged_in')]);

            }else {
                return response()->json(['status' => false, 'message' => translate('messages.invalid_credentials')]);
            }
        }else
            return response()->json(['status' => false, 'message' => translate('messages.user_not_found')]);
    }

    public function log_out(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
