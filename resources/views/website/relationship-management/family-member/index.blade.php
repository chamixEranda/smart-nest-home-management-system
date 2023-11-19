@extends('layouts.app')

@section('content')
<style>
    .card {
        max-width: 30em;
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
<section class="relation-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.relationship_management') }} <i
                class="fas fa-chevron-right"></i> {{
            translate('messages.family_members') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <a href="{{ route('relationship-management.family-member.create') }}" class="btn btn-primary">{{
                translate('messages.add_new_member') }}</a>
        </div>
        <div class="row">
            @forelse ($family_members as $member)
            <div class="card bg-primary-subtle mt-4">
                <img src="{{ asset('public/documents/family_members/'.$member->image) }}" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <div class="text-section">
                        <h5 class="card-title fw-bold">{{ $member->name }}</h5>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.DOB') }}:</strong> {{
                            $member->dob }}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.gender') }}:</strong> {{
                            $member->gender }}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.phone_number') }}:</strong>
                            {{ $member->phone_number }}</p>
                        <p class="card-text text-capitalize"><strong>{{ translate('messages.family_position')
                                }}:</strong> {{ $member->family_position }}</p>
                    </div>
                    <div class="cta-section">
                        <a href="{{ route('relationship-management.family-member.edit',$member->id) }}" class="text-dark mx-1"><i
                                class="fas fa-pencil-alt"></i></a>
                        <a class="text-dark mx-1" href="javascript:"
                            onclick="form_alert('member-{{$member['id']}}','{{ translate('Want to delete this member ?') }}')"
                            title="{{translate('messages.delete')}} {{translate('messages.member')}}"><i
                                class="fas fa-trash"></i>
                        </a>
                        <form action="{{route('relationship-management.family-member.destroy',[$member['id']])}}" method="post"
                            id="member-{{$member['id']}}">
                            @csrf @method('delete')
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-list-div my-5 py-5 h-100">
                <img src="{{ asset('assets/img/people.png') }}" class="d-block mx-auto" alt="Family Mmber" width="200">
                <h3 class="text-center text-light">{{ translate('messages.no_family_members_to_show') }}</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection