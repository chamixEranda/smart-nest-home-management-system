@extends('layouts.app')

@section('content')
<style>
    .card {
        /* max-width: 30em; */
        flex-direction: row;
        background-color: #696969;
        border: 0;
        box-shadow: 0 7px 7px rgba(0, 0, 0, 0.18);
        margin: 3em auto;
        border-radius: 30px;
        background: rgba(0, 0, 0, 0.75);
        color: #fff !important;
    }

    .card.dark {
        color: #fff;
    }

    .card.card.bg-light-subtle .card-title {
        color: dimgrey;
    }

    .card img {
        max-width: 10%;
        margin: auto;
        padding: 0.5em;
        border-radius: 0.7em;
        border-radius: 50%;
    }

    .card-body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .text-section {
        max-width: 70%;
    }

    .cta-section {
        max-width: 30%;
        display: flex;
        /* flex-direction: column; */
        /* align-items: flex-end; */
        justify-content: space-between;
    }

    .cta-section .btn {
        padding: 0.3em 0.5em;
        /* color: #696969; */
    }

    .card.bg-light-subtle .cta-section .btn {
        background-color: #898989;
        border-color: #898989;
    }

    @media screen and (max-width: 475px) {
        .card {
            font-size: 0.9em;
        }
    }
</style>
<section class="meal-index-section">
    <div class="container">
        <div class="row">
            <div class="card mt-4">
                <img src="{{ asset('assets/img/sara.png') }}" class="card-img-top" alt="..."
                    onerror="this.src='{{ asset('assets/img/user.jpg') }}'">
                <div class="card-body">
                    <div class="text-section">
                        <h5 class="card-title fw-bold">Sarah Ramsy</h5>
                        <p class="card-text text-capitalize" style="text-align: start">
                            I can't express how much SmartNest has transformed the way my family and I
                            manage our household. With a busy schedule and the need to juggle finances, meals, and
                            family activities, this app has been a true lifesaver. The relationship management section
                            is a thoughtful touch, helping us plan family projects and remember important events. I
                            can't thank the SmartNest team enough for creating this fantastic tool. It's a definite
                            5-star app for us!
                        </p>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <img src="{{ asset('assets/img/rasal.png') }}" class="card-img-top" alt="..."
                    onerror="this.src='{{ asset('assets/img/user.jpg') }}'">
                <div class="card-body">
                    <div class="text-section">
                        <h5 class="card-title fw-bold">Rasal Gamage</h5>
                        <p class="card-text text-capitalize" style="text-align: start">
                            SmartNest is a breath of fresh air in the world of home management applications. It's clear
                            that the developers have put a lot of thought into the features it offers. The finance
                            section is comprehensive and has already helped me better manage my budget. The meal
                            planning tools are fantastic for someone like me who enjoys trying new recipes. What sets
                            SmartNest apart is its relationship management features – they add a unique dimension to the
                            app, helping me plan family projects and remember important events.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <img src="{{ asset('assets/img/nashen.png') }}" class="card-img-top" alt="..."
                    onerror="this.src='{{ asset('assets/img/user.jpg') }}'">
                <div class="card-body">
                    <div class="text-section">
                        <h5 class="card-title fw-bold">Nashen Mark</h5>
                        <p class="card-text text-capitalize" style="text-align: start">
                            SmartNest is a promising, innovative app. It's got all the essentials for home management
                            and stands out with its relationship features. I'm excited to see how it evolves
                            with future updates!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection