@extends('layouts.app')

@section('content')

<section class="home_section">
    <div class="container">
        <div class="home_intro text-center">
            <h1>“{{ translate('messages.Your Home, Your Rules, Our Tech') }}”</h1>
            <p>SmartNest as a family management digital web application is almost like being CEO of a company. There are
                numerous household chores and activities that a person has to keep in mind. For an illustration things
                like
                budgeting, expenses, subscriptions to keep healthy financial habits, managing goals/savings like an
                emergency fund or planning the next vacation or Christmas; having a meal plan, generating grocery list
                according to meals and ingredients needed as well as all the things you need can be organized via this
                innovative web application.
            </p>
        </div>
    </div>
</section>

<section class="our_services" id="our_services">
    <div class='container mx-auto py-5 col-12' style="text-align: center">
        <div class="hd">{{ translate('messages.our_services') }}</div>
        <p><small class="text-muted">Always render more and better service than <br />is expected of you, no matter what
                your ask may be.</small></p>
        <div class="row" style="justify-content: space-evenly">
            <div class="card col-md-3 col-12">
                <div class="card-content">
                    <a href="">
                        <div class="card-body"> <img class="img" src="{{ asset('assets/img/assets.png') }}" width="100"/>
                            <div class="shadow"></div>
                            <div class="card-title text-dark"> {{ translate('messages.finance_management') }} </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted">"Take control of your finances with SmartNest's Finance
                                        Management tools. Budget effectively, track expenses, and build a secure financial
                                        future for you and your family"</small> </p>
                            </div>
                            <div class="card-button">
                                <a href="" class="btn-primary">Find More</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card col-md-3 col-12 ml-2">
                <div class="card-content">
                    <a href="">
                        <div class="card-body"> <img class="img" src="{{ asset('assets/img/food.png') }}" alt="" width="100">
                            <div class="card-title text-dark"> {{ translate('messages.meal_planning') }} </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> "Simplify meal planning and transform your kitchen with
                                        SmartNest's Meal Planning features. Plan nutritious meals, organize recipes, and
                                        generate grocery lists effortlessly" </small> </p>
                            </div>
                            <div class="card-button">
                                <a href="{{ route('meal-planning.index') }}" class="btn-primary">Find More</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card col-md-3 col-12 ml-2">
                <div class="card-content">
                    <a href="">
                        <div class="card-body"> <img class="img" src="{{ asset('assets/img/team-management.png') }}" width="100"/>
                            <div class="card-title text-dark"> {{ translate('messages.relationship_management') }} </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted">
                                        "Strengthen your bonds and cherish every moment with SmartNest's Relationship
                                        Management tools. Set goals, manage family projects, and keep track of
                                        memorable occasions"
                                    </small> </p>
                            </div>
                            <div class="card-button">
                                <a href="" class="btn-primary">Find More</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection