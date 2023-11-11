@extends('layouts.app')

@section('content')
<div class="checkout-section col-md-12">
    <div class="row">
        <div class="col-md-2 sidebar-pricing">
            <div class="title px-3 pt-5">
                <h4>
                    WELCOME TO <strong>SMARTNEST</strong>
                </h4>
                <h5>
                    Your Home, Your Rules, Our Tech
                </h5>
            </div>
            <img src="{{ asset('assets/img/siderbar.png') }}" alt="">
        </div>

        <div class="col-md-10 checkout-card d-flex justify-content-center align-items-center">
            <div class="card w-100 mx-2 p-3">
                <div class="card-header">
                    <h3>Subscription Plan</h3>
                </div>
                {!! Form::open(['route' => 'pricing-checkout.store', 'method' => 'post']) !!}
                <div class="card-body">
                    <div class="subscription-list d-inline-flex">
                        @foreach ($lims_subscription_list as $key => $subscription)
                        @php
                            $color = '';
                            if ($key == 0) {
                                $color = 'basic';
                            }elseif ($key == 1) {
                                $color = 'premium';
                            }else {
                                $color = 'yearly';
                            }
                        @endphp
                            <div class="form-group mx-2">
                                <input type="radio" class="btn-check" name="subscription_id" value="{{ $subscription->id }}" id="{{ $subscription->id }}" autocomplete="off">
                                <label class="btn btn-secondary {{ $color }}" for="{{ $subscription->id }}">{{ $subscription->title }} &nbsp;&nbsp;&nbsp; {{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($subscription->price,2,'.','')}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="payment-details pt-4">
                        <h4>Payment Details</h4>

                        <div class="card-details my-4">
                            <div class="row">
                                <div class="col-md-4 form-group mb-4">
                                    <label class="form-label">{{ translate('messages.card_number') }}</label>
                                    <input type="text" class="form-control" name="card_number" placeholder="xxxx xxxx xxxx xxxx">
                                    @error('card_number')
                                        <span class="valitation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group mb-4">
                                    <label class="form-label">{{ translate('messages.expiry_date') }}</label>
                                    <input type="text" class="form-control" name="expiry_date">
                                    @error('expiry_date')
                                        <span class="valitation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-4">
                                    <label class="form-label">{{ translate('messages.CVV') }}</label>
                                    <input type="text" class="form-control" name="cvv">
                                    @error('cvv')
                                        <span class="valitation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="calculation-section">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-capitalize"><strong>{{ translate('messages.sub_total') }}</strong></p>
                                <p class="text-secondary">{{ translate('messages.discount') }}</p>
                                <h4 class="font-weight-bold">{{ translate('messages.total') }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <p class="text-capitalize"><strong>{{ \App\CentralLogics\Helpers::currency_symbol() }}</strong></p>
                                <p class="text-secondary">{{ \App\CentralLogics\Helpers::currency_symbol() }}</p>
                                <h4 class="font-weight-bold">{{ \App\CentralLogics\Helpers::currency_symbol() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary">{{ translate('messages.Subscribe_&_Checkout') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection