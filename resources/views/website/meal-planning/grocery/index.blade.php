@extends('layouts.app')

@section('content')
<style>

</style>
<section class="grocery-list-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase text-light">{{ translate('messages.meal_planning') }} <i
                class="fas fa-chevron-right"></i> {{ translate('messages.grocery_list') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <button data-bs-toggle="modal" type="button" data-bs-target="#addIngredientModal" class="btn btn-primary">{{
                translate('messages.add_ingredients') }}</button>
        </div>
        <div class="grocery-items py-3">
            @if (count($lims_ingredient_data) > 0)
            <div class="row row-cols-4 g-4 pagination__list" id="pagination-1">
                @foreach ($lims_ingredient_data as $ingredient)
                <div class="col pagination__item">
                    <div class="card ingredient-card">
                        <div class="ingredient-image">
                            <img src="{{ asset('public/documents/grocery/'.$ingredient->image) }}"
                                class="card-img-top" alt="Ingredient"
                                onerror="this.src='{{ asset('assets/img/ingredients.png') }}'" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $ingredient->name }}</h5>
                            <p class="card-text">
                                <a href="javascript:" onclick="updateIngredientStock({{ $ingredient->id }}, 'minus')"><i
                                        class="fas fa-minus"></i></a>
                                <span class="ingred-stock mx-1">{{ $ingredient->in_stcok }}</span>
                                <a href="javascript:" onclick="updateIngredientStock({{ $ingredient->id }}, 'plus')"><i
                                        class="fas fa-plus"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    {!! $lims_ingredient_data->links() !!}
                </div>
            </div>
            @else
            <div class="empty-list-div my-5 py-5 h-100">
                <img src="{{ asset('assets/img/ingredients.png') }}" class="d-block mx-auto" alt="Recipe" width="200">
                <h3 class="text-center text-light">{{ translate('messages.no_ingredients_to_show') }}</h3>
            </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="addIngredientModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.add_ingredient') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="javascript:" method="POST" autocomplete="off" id="add-ingredient-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <center class="py-3 my-auto">
                                    <img class="img--vertical" id="viewer"
                                        onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'" src=""
                                        alt="logo image" />
                                </center>
                                <label class="form-label mb-0">
                                    {{ translate('messages.Ingredient Image') }}
                                    <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                                        )</small>
                                </label>
                                <input type="file" name="image"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                    class="form-control" id="customFileEg1">
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.quantity') }} <small class="text-danger">* </small></label>
                                <input type="number" class="form-control" name="in_stcok" required>
                            </div>
                            <div class="form-group">
                                <span class="buttonPreloader float-end rounded-0 btn outline my-0 w-50"
                                    style="display: none">
                                    <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt=""
                                        style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline">
                                    Please Wait
                                </span>
                                <button type="submit" class="btn btn-primary w-50 float-end" id="add-recipe-btn">{{
                                    translate('messages.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
    function updateIngredientStock(id, action) {
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/meal-planning/grocery/update-stock/'+id+'/'+action,
            success: function (data) {
                if (data.status == true) {
                    ToastMixin.fire({
                        animation: true,
                        icon: 'success',
                        title: data.message,
                    });
                    location.reload();
                }else{
                    ToastMixin.fire({
                        animation: true,
                        icon: 'warning',
                        title: data.message,
                    });
                }
            },
            error: function (err) {
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: 'Somthing went wrong !',
                });
            }
        });
    }

    function readURL(input, viewer) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + viewer).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function() {
        readURL(this, 'viewer');
    });

    $('#add-ingredient-form').on('submit', function() {
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#add-ingredient-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("meal-planning.grocery.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 'error') {
                    $.each(data.errors, function(key, val) {
                        ToastMixin.fire({
                            animation: true,
                            icon: 'warning',
                            title: val['message'],
                        });
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#add-recipe-btn').css('display', 'block');
                }

                else{
                    ToastMixin.fire({
                        animation: true,
                        icon: 'success',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#add-recipe-btn').css('display', 'block');
                    location.reload();
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