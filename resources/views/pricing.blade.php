@extends('layouts.app')

@section('content')
    
    <section class="pricing_section">
        <div class="container">
            <div class="pricing-grid">
                @foreach ($lims_subscription_list as $key => $subscription)
                <div class="grid">
                    <div class="box {{ $key == 1 ? 'premium' : 'basic' }}">
                        <div class="title">{{ $subscription->title }}</div>
                        <div class="price">
                            <b> {{ \App\CentralLogics\Helpers::currency_symbol().' '.$subscription->price }}</b>
                            <span>{!! $subscription->description !!}</span>
                        </div>
                        <div class="button">
                           <a href="{{ route('pricing-checkout') }}"><button>{{ translate('messages.subscribe') }}</button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection