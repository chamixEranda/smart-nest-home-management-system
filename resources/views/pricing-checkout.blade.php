@extends('layouts.app')

@section('content')
<style>
    .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
    background-color: var(--primary) !important;
}
</style>
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
                <form action="javascript:" method="POST" id="subscription-form" autocomplete="off">
                    @csrf
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
                                    <input type="radio" class="btn-check subscription-check" data-price="{{ $subscription->price }}" name="subscription_id" value="{{ $subscription->id }}" id="{{ $subscription->id }}" autocomplete="off">
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
                                        <input type="text" class="form-control" placeholder="MM/YY" name="expiry_date">
                                        @error('expiry_date')
                                            <span class="valitation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group mb-4">
                                        <label class="form-label">{{ translate('messages.CVV') }}</label>
                                        <input type="text" class="form-control" placeholder="XXX" name="cvv">
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
                                    <p class="text-capitalize"><strong>{{ \App\CentralLogics\Helpers::currency_symbol() }} <span id="subtotal"></span></strong></p>
                                    <p class="text-secondary">{{ \App\CentralLogics\Helpers::currency_symbol().' '. 0.00 }}</p>
                                    <h4 class="font-weight-bold">{{ \App\CentralLogics\Helpers::currency_symbol() }} <span id="total"></span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-end">
                            <button class="btn btn-primary" id="checkout-btn" type="submit" disabled>{{ translate('messages.Subscribe_&_Checkout') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).on('change', $(".subscription-check"), function(el) {
        var price = $(el.target).data('price');
        $('#subtotal').text(price.toFixed(2));
        $('#total').text(price.toFixed(2));
        $('#checkout-btn').attr('disabled',false);
    });

    $(document).on('submit', $('#subscription-form'), function(e) {
        e.preventDefault();
        var formData = new FormData($('#subscription-form')[0]);
        $.ajax({
            type: "POST",
            url: '{{ route('pricing-checkout.store') }}',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'error') {
                    $.each(data.errors, function(key, val) {
                        toastr.error(val['message'], {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    });
                }else{
                    toastr.success(data.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    location.href = '/';
                }
                
            }
        });
    });
    
</script>
@endpush