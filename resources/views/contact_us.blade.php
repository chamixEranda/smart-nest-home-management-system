@extends('layouts.app')

@section('content')

<section class="contact_us_section">
    <div class="contact_upper_contact">
        <h1 class="text-center text-light text-capitalize">{{ translate('messages.contact_us') }}</h1>
    </div>
    <div class="contact_down_section">
        <div class="container">
            <div class="col-md-12 ">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-card">
                            <img src="{{ asset('assets/img/Place Marker.png') }}" alt="">
                            <h5>{{ $business_address ? $business_address->value : 'No 20, Galle Road, Kollupitiya' }}</h5>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-card">
                            <img src="{{ asset('assets/img/Ringing Phone.png') }}" alt="">
                            <h5>{{ $business_phone ? $business_phone->value : '+94 76 889 9990' }}</h5>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-card">
                            <img src="{{ asset('assets/img/Email.png') }}" alt="">
                            <h5>{{ $business_email ? $business_email->value : 'zfathima.nafha@gmail.com' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection