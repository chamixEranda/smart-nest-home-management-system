<div class="modal-header">
    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.meal_list') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row d-flex justify-content-between">
        @forelse ($lims_meal_list as $meal)
        <div class="meal-card m-2">
            <div class="card-image">
                <img src="{{ asset('storage/meal/'.$meal->image) }}" alt=""
                        onerror="this.src='{{ asset('assets/img/cooking.png') }}'" class="d-block mx-auto">
            </div>
            <p class="card-title text-center mx-0">{{ $meal->name }}</p>
            <p class="card-body">
                {!! $meal->description !!}
            </p>
        </div>
        @empty
        <div class="empty-list-div my-5 py-5 h-100">
            <img src="{{ asset('assets/img/cooking.png') }}" class="d-block mx-auto" alt="Recipe" width="200">
            <h3 class="text-center text-dark">{{ translate('messages.no_meal_plans_to_show') }}</h3>
        </div>
        @endforelse
    </div>
</div>