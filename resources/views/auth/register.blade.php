@extends('layouts.app')

@section('content')

<section class="login_section">
    <div class="container">
        <div class="col-md-12 signup_form_all">
            <div class="row">
                <div class="col-md-4 signup_form_img">
                    <img src="{{ asset('assets/img/logo white.png') }}" alt="SmartNest Logo" width="160"> 
                    <h3>
                        {{ translate('messages.welcome_to') }}
                        {{ translate('messages.smartnest') }}
                    </h3>   
                
                </div>
                <div class="col-md-8 signup_form_fill">
                    <form action="" autocomplete="off">
                        <h2>{{ translate('messages.sign_up') }}</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input_box">
                                    <input type="text" name="f_name" required>
                                    <label>{{ translate('messages.first_name') }}</label>    
                                </div>
                                <div class="input_box">
                                    <input type="email" name="email" required>
                                    <label>{{ translate('messages.email') }}</label>    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input_box">
                                    <input type="text" name="l_name" required>
                                    <label>{{ translate('messages.last_name') }}</label>    
                                </div>
                                <div class="">
                                    <label>{{ translate('messages.gender') }}</label>    
                                    <select name="gender" class="form-control">
                                        <option value="male">{{ translate('messages.male') }}</option>
                                        <option value="female">{{ translate('messages.female') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input_box">
                                    <input type="date" name="dob" required>
                                    <label>{{ translate('messages.DOB') }}</label>    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input_box">
                                    <input type="password" name="password" required>
                                    <label>{{ translate('messages.password') }}</label>    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input_box">
                                    <input type="password" name="confirm_password" required>
                                    <label>{{ translate('messages.confirm_password') }}</label>    
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn login_button">{{ translate('messages.sign_up') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection