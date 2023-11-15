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
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" for="inlineRadio1">Breakfast</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                        <label class="form-check-label" for="inlineRadio2">Lunch</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option3">
                        <label class="form-check-label" for="inlineRadio3">Dinner</label>
                    </div>
                </div>
                <div class="mb-3">
                    <h3 class="text-light category-text mx-2">{{ translate('messages.meal_type') }}: </h3>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" for="inlineRadio1">Breakfast</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                        <label class="form-check-label" for="inlineRadio2">Lunch</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                            value="option3">
                        <label class="form-check-label" for="inlineRadio3">Dinner</label>
                    </div>
                </div>
                <a href="" class="btn btn-primary w-25">Generate Meal</a>
            </div>
        </div>
    </div>
</section>

@endsection