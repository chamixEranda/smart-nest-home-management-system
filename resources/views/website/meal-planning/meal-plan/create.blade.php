@extends('layouts.app')

@section('content')

<section class="meal-plan-section">
    <div class="container d-flex justify-content-center">
        <div class="meal-plan-card">
            <h3 class="meal-card-title">{{ translate('messages.meal_planning') }}</h3>
            <h2 class="meal-card-subtitle">{{ translate('messages.choose_your_meal') }}</h2>
            <div class="meal-card-body text-center">
                <form action="javascript:" method="post" id="meal-plan-generate-form">
                    @csrf
                    <div class="mb-4">
                        <h3 class="text-light category-text mx-2">{{ translate('messages.meal') }}: </h3>
                        @foreach ($lims_category_list as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" required name="meal_category"
                                id="Category-{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="Category-{{ $category->id }}">{{ $category->name
                                }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <h3 class="text-light category-text mx-2">{{ translate('messages.meal_type') }}: </h3>
                        @foreach ($lims_type_list as $type)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" required name="meal_type"
                                id="Type-{{ $type->id }}" value="{{ $type->id }}">
                            <label class="form-check-label" for="Type-{{ $type->id }}">{{ $type->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <span class="buttonPreloader rounded-0 btn outline small my-0 w-25" style="display: none">
                            <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt=""
                                style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline">
                            Please Wait
                        </span>
                        <button type="submit" class="btn btn-primary w-25" id="add-recipe-btn">{{
                            translate('messages.generate_meals') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="generateMealPlan" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content" id="meal-plan-content">

            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
    $('#meal-plan-generate-form').on('submit', function(e) {
        e.preventDefault();
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#meal-plan-generate-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("meal-planning.meal-plan") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == true) {
                    $('#generateMealPlan').modal('show');
                    $('#meal-plan-content').empty().html(data.view);

                    $('.buttonPreloader').css('display', 'none');
                    $('#add-recipe-btn').css('display', 'block');
                }
            },
            error: function (err) {
                $('.buttonPreloader').css('display', 'none');
                $('#add-recipe-btn').css('display', 'block');
            }
        });
    });
</script>
@endpush