@extends('layouts.app')

@section('content')
    
    <section class="pricing_section">
        <div class="container">
            <div class="pricing-grid">
                <div class="grid">
                    <div class="box basic">
                        <div class="title">{{ translate('messages.basic') }}</div>
                        <div class="price">
                            <b>$29.55</b>
                            <span>{{ translate('messages.per_month') }}</span>
                        </div>
                        <div class="button">
                            <button>{{ translate('messages.subscribe') }}</button>
                        </div>
                    </div>
                </div>
    
                <div class="grid">
                    <div class="box premium">
                        <div class="title">{{ translate('messages.premium') }}</div>
                        <div class="price">
                            <b>$39.55</b>
                            <span>{{ translate('messages.per_month') }}</span>
                        </div>
                        <div class="button">
                            <button>{{ translate('messages.subscribe') }}</button>
                        </div>
                    </div>
                </div>
    
                <div class="grid">
                    <div class="box yearly">
                        <div class="title">{{ translate('messages.yearly') }}</div>
                        <div class="price">
                            <b>$59.55</b>
                            <span>{{ translate('messages.per_month') }}</span>
                        </div>
                        <div class="button">
                            <button>{{ translate('messages.subscribe') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection