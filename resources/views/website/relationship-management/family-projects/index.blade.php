@extends('layouts.app')

@section('content')
<style>
    .projects_section {
        background-image: url('/assets/img/login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 10px 0px
    }

    .card {
        /* max-width: 30em; */
        flex-direction: row;
        background-color: #696969;
        border: 0;
        box-shadow: 0 7px 7px rgba(0, 0, 0, 0.18);
        margin: 3em auto;
    }

    .card.dark {
        color: #fff;
    }

    .card.card.bg-light-subtle .card-title {
        color: dimgrey;
    }

    .card img {
        max-width: 25%;
        margin: auto;
        padding: 0.5em;
        border-radius: 0.7em;
    }

    .card-body {
        display: flex;
        justify-content: space-between;
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
<section class="projects_section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.relationship_management') }} <i
                class="fas fa-chevron-right"></i> {{
            translate('messages.family_plans') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <a href="{{ route('relationship-management.family-projects.create') }}" class="btn btn-primary">{{
                translate('messages.add_new_plan') }}</a>
        </div>
        <div class="row">
            @forelse ($family_plans as $plan)
            <div class="card bg-warning-subtle mt-4">
                <img src="{{ asset('public/documents/plans/'.$plan->image) }}" class="card-img-top" alt="..."
                    onerror="this.src='{{ asset('assets/img/vacation.png') }}'">
                <div class="card-body">
                    <div class="text-section">
                        <h5 class="card-title fw-bold">{{ $plan->title }}</h5>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.category') }}:</strong> {{
                            $plan->category->name }}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.date') }}:</strong> {{
                            $plan->date }}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.description') }}:</strong>
                            {!! $plan->description !!}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.budget')}}:</strong> </p>
                            @foreach (json_decode($plan->budget_info) as $budget)
                            {{ $budget->name }}: {{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($budget->amount,2) }} <br>
                            @endforeach
                        
                    </div>
                    <div class="cta-section">
                        <a href="{{ route('relationship-management.family-projects.edit',$plan->id) }}"
                            class="text-dark mx-1"><i class="fas fa-pencil-alt"></i></a>
                        <a class="text-dark mx-1" href="javascript:"
                            onclick="form_alert('plan-{{$plan['id']}}','{{ translate('Want to delete this plan ?') }}')"
                            title="{{translate('messages.delete')}} {{translate('messages.member')}}"><i
                                class="fas fa-trash"></i>
                        </a>
                        <form action="{{route('relationship-management.family-projects.destroy',[$plan['id']])}}"
                            method="post" id="plan-{{$plan['id']}}">
                            @csrf @method('delete')
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    {!! $family_plans->links() !!}
                </div>
            </div>
            @empty
            <div class="empty-list-div my-5 py-5 h-100">
                <img src="{{ asset('assets/img/vacation.png') }}" class="d-block mx-auto" alt="Family Mmber" width="200">
                <h3 class="text-center text-light">{{ translate('messages.no_family_plans_to_show') }}</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection