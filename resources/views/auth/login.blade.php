@extends('layouts.app')

@section('content')
    <section class="login_section">
        <div class="container">
            <div class="col-md-12  d-flex justify-content-center">
                <div class="row">
                    <div class="login_wrapper">
                        <div class="login_card">
                            <div class="img-fluid">
                                <img src="{{ asset('assets/img/logo white.png') }}" alt="SmartNest Logo" width="160">    
                            </div>
                            <form action="" autocomplete="off">
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
                                <button type="submit" class="btn login_button">{{ translate('messages.login') }}</button>
                                <div class="login_register my-3">
                                    <p>{{ translate('messages.dont_have_an_account') }}?
                                        <a href="{{ url('/signup') }}">{{ translate('messages.sign_up') }}</a>
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