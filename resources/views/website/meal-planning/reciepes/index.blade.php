@extends('layouts.app')

@section('content')

<section class="reciepes-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase"><i class="fas fa-chevron-right"></i> {{ translate('messages.meal_planning') }} <i class="fas fa-chevron-right"></i> {{ translate('messages.recipes') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <a href="" class="btn btn-primary">{{ translate('messages.add_new_recipe') }}</a>
        </div>
        <div class="col-md-12 recipe-card">
            <div class="row">
                <div class="col-md-4 reciepe-image">
                    <img src="{{ asset('assets/img/food 1.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="recipe-name">
                        <h3>Omelette</h3>
                    </div>
                    <div class="recipe-details">
                        <h5>Instructions:</h5>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                    </div>
                </div>
                <div class="col-md-2 text-end">
                    <a href="" class="text-dark mx-1"><i class="fas fa-pencil-alt"></i></a>
                    <a href="" class="text-dark mx-1"><i class="fas fa-trash"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-12 recipe-card">
            <div class="row">
                <div class="col-md-4 reciepe-image">
                    <img src="{{ asset('assets/img/food 1.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="recipe-name">
                        <h3>Omelette</h3>
                    </div>
                    <div class="recipe-details">
                        <h5>Instructions:</h5>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                        <p>Whisk eggs, water, salt and pepper.</p>
                    </div>
                </div>
                <div class="col-md-2 text-end">
                    <a href="" class="text-dark mx-1"><i class="fas fa-pencil-alt"></i></a>
                    <a href="" class="text-dark mx-1"><i class="fas fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection