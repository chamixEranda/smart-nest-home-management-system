<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CentralLogics\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function getSignup()
    {
        return view('auth.register');
    }

    public function signupCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name'            => 'required',
            'l_name'            => 'required',
            'dob'               => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:6|max:20',
            'confirm_password'  => 'required|min:6|max:20|same:password'
        ], [
            'f_name.required'   => 'The first name field is required.',
            'l_name.required'   => 'The last name field is required.',
            'email.required'    => 'The email field is required.',
            'phone.required'    => 'The phone field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'dob' => $request->dob
        ]);

        DB::commit();

        if(Auth::loginUsingId($user->id))
            return response()->json(['status' => true, 'message' => "Registration successfull"], 200);
    }
}
