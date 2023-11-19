@extends('layouts.app')

@section('content')
<style>
    .h-100 {
        height: 360px !important;
    }
    .card:hover {
        transform: scale(1.1); 
    }
    .card{
        transition: transform .2s;
    }
</style>
<section class="meal-index-section">
    <div class="container px-4 py-5" id="custom-cards">
        <div class="row row-cols-3 row-cols-lg-3 align-items-stretch g-4 py-5">
            <div class="col">
                <a href="{{ route('finance.budgeting') }}">
                    <div class=" card card-cover border-0 h-100 overflow-hidden text-white rounded-5 shadow-lg"
                        style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) ,url('assets/img/budgeting.jpg');background-repeat:no-repeat;background-size:cover">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-center text-uppercase">{{
                                translate('messages.budgeting') }}</h2>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('finance.income-category') }}">
                    <div class="card card-cover h-100 border-0 overflow-hidden text-white rounded-5 shadow-lg"
                        style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) ,url('assets/img/income.jpg');background-repeat:no-repeat;background-size:cover">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-center text-uppercase">{{
                                translate('messages.income_&_expenses') }}
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('finance.transactions') }}">
                    <div class="card card-cover h-100 border-0 overflow-hidden text-white rounded-5 shadow-lg"
                        style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) ,url('assets/img/transaction.jpg');background-repeat:no-repeat;background-size:cover">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-center text-uppercase">{{
                                translate('messages.transactions') }}</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection