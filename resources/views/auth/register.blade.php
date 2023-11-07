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
                    <form action="javascript:" method="POST" autocomplete="off" id="registration_form">
                        @csrf
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
                        <div class="text-center mt-2">
                            <span class="buttonPreloader btn outline small my-0" style="display: none">
                                <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt="" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline"> Please Wait 
                            </span>
                            <button type="submit" id="Registerbtn" class="btn login_button mt-0">{{ translate('messages.sign_up') }}</button>
                        </div>
                        
                        <div class="login_register text-center my-3">
                            <p>{{ translate('messages.already_have_an_account') }}?
                                <a class="text-dark" href="{{ route('login') }}">{{ translate('messages.log_in') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
@push('scripts')
<script>
    
</script>
@endpush