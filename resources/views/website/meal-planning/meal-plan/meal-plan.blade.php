@extends('layouts.app')

@section('content')
<style>

</style>
<section class="meal-section py-4">
    <div class="container-fluid">
        <div class="meal-header">
            <div class="meal-platte">
                
            </div>
            <h3>
                Meal Plan according to your Nutritional Requirements...
            </h3>
        </div>
    
        <div class="meal-title my-4">
            <h3>
                YOUR MEALS, <br>WHEN YOU NEED THEM.
            </h3>
            <a href="{{ route('meal-planning.create-meal-plan') }}">create meal plan</a>
        </div>
    
        <div class="col-md-12 my-5">
            <div class="">
                <div class="col-md-8 meal-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="text-light mx-4 my-2">WEEKLY MEAL PLANS</h4>
                            <img src="{{ asset('assets/img/food 2.png') }}" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('assets/img/food 1.png') }}" alt="">
                        </div>
                        <div class="col-md-2">
                            <img src="{{ asset('assets/img/food 3.png') }}" alt="">
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3 big-plate-div">
                    <img src="{{ asset('assets/img/meal.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')

@endpush