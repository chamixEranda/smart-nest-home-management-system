@extends('layouts.app')

@section('content')

<section class="meal-plan-section">
    <div class="container d-flex justify-content-center">
        <div class="meal-plan-card">
            <h3 class="meal-card-title">{{ translate('messages.meal_planning') }}</h3>
            <h2 class="meal-card-subtitle">{{ translate('messages.choose_your_meal') }}</h2>
            <div class="meal-card-body text-center">
                <div class="mb-4">
                    <h3 class="text-light category-text mx-2">{{ translate('messages.meal') }}: </h3>
                    @foreach ($lims_category_list as $category)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="meal_category" id="Category-{{ $category->id }}"
                            value="option1">
                        <label class="form-check-label" for="Category-{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <h3 class="text-light category-text mx-2">{{ translate('messages.meal_type') }}: </h3>
                    @foreach ($lims_type_list as $type)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Type-{{ $type->id }}"
                            value="option1">
                        <label class="form-check-label" for="Type-{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                    @endforeach
                </div>
                <a href="" class="btn btn-primary w-25">Generate Meal</a>
            </div>
        </div>
    </div>
</section>

@endsection