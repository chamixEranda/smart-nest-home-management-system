@extends('layouts.app')

@section('content')

<section class="grocery-list-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase text-light">{{ translate('messages.meal_planning') }} <i
                class="fas fa-chevron-right"></i> {{ translate('messages.grocery_list') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <a href="{{ route('meal-planning.grocery.add-ingredients') }}" class="btn btn-primary">{{ translate('messages.add_ingredients') }}</a>
        </div>
        <div class="grocery-items py-3">
            <div class="row row-cols-4 g-4">
                <div class="col">
                    <div class="card ingredient-card">
                        <div class="ingredient-image">
                            <img src="{{ asset('assets/img/Sauce-Bottle.png') }}" class="card-img-top"
                            alt="Hollywood Sign on The Hill" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sauce</h5>
                            <p class="card-text">
                                <a href=""><i class="fas fa-plus"></i></a>
                                <a href=""><i class="fas fa-minus"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card ingredient-card">
                        <div class="ingredient-image">
                            <img src="{{ asset('assets/img/Sauce-Bottle.png') }}" class="card-img-top"
                            alt="Hollywood Sign on The Hill" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sauce</h5>
                            <p class="card-text">
                                <a href=""><i class="fas fa-plus"></i></a>
                                <a href=""><i class="fas fa-minus"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card ingredient-card">
                        <div class="ingredient-image">
                            <img src="{{ asset('assets/img/Sauce-Bottle.png') }}" class="card-img-top"
                            alt="Hollywood Sign on The Hill" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sauce</h5>
                            <p class="card-text">
                                <a href=""><i class="fas fa-plus"></i></a>
                                <a href=""><i class="fas fa-minus"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card ingredient-card">
                        <div class="ingredient-image">
                            <img src="{{ asset('assets/img/Sauce-Bottle.png') }}" class="card-img-top"
                            alt="Hollywood Sign on The Hill" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sauce</h5>
                            <p class="card-text">
                                <a href=""><i class="fas fa-plus"></i></a>
                                <a href=""><i class="fas fa-minus"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection