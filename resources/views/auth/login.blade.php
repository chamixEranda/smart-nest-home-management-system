@extends('layouts.app')

@section('content')
    <section class="login_section">
        <div class="container">
            <div class="col-md-12  d-flex justify-content-center">
                <div class="row">
                    <div class="login_wrapper">
                        <div class="login_card w-100 p-4">
                            <div class="img-fluid">
                                <img src="{{ asset('assets/img/logo white.png') }}" alt="SmartNest Logo" width="160">    
                            </div>
                            <form action="javascript:" method="POST" autocomplete="off" id="user_login_form">
                                @csrf
                                <div class="input_box">
                                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                                    <input type="email" name="email" required>
                                    <label>{{ translate('messages.email') }}</label>    
                                </div>
                                <div class="input_box">
                                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                                    <input type="password" name="password" required>
                                    <label>{{ translate('messages.password') }}</label>    
                                </div>
                                <div class="remember-forgot text-end">
                                    <a href="">{{ translate('messages.forgot_password') }}?</a>
                                </div>
                                <div class="text-center mt-2">
                                    <span class="buttonPreloader btn outline small my-0" style="display: none">
                                        <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt="" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline"> Please Wait 
                                    </span>
                                    <button type="submit" class="btn login_button" id="LoginformBtn">{{ translate('messages.login') }}</button>
                                </div>
                                <div class="login_register text-center my-3">
                                    <p>{{ translate('messages.dont_have_an_account') }}?
                                        <a href="{{ route('signup') }}">{{ translate('messages.sign_up') }}</a>
                                    </p>
                                </div>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection