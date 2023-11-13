@extends('layouts.app')

@section('content')
<style>
    .recipe-create-section {
        background-image: url('/assets/img/login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 10px 0px
    }
</style>
<section class="recipe-create-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.meal_planning') }} <i class="fas fa-chevron-right"></i> {{
            translate('messages.recipes') }} <i class="fas fa-chevron-right"></i> {{ translate('messages.add_recipe') }}
        </h2>
    </div>
    <div class="container">
        <div class="col-md-12 recipe-create-form">
            <div class="custom-card p-4">
                <div class="card-header">
                    <h3 class="text-center text-uppercase">{{ translate('messages.add_new_recipe') }}</h3>
                </div>
                <div class="row">
                    <form action="javascript:" method="POST" autocomplete="off" id="add-recipe-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <center class="py-3 my-auto">
                                <img class="img--vertical" id="viewer"
                                    onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'" src=""
                                    alt="logo image" />
                            </center>
                            <label class="form-label mb-0">
                                {{ translate('messages.Recipe Image') }}
                                <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                                    )</small>
                            </label>
                            <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required class="form-control" id="customFileEg1">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group" id="ingredients-inputs"
                            data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                            <div class="row">
                                <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn btn-primary">{{
                                        translate('messages.add_ingredients') }}</button></div>
                            </div>
                            <div class="row group my-2">
                                <div class="col-md-6">
                                    <label>{{ translate('messages.ingredient_Name') }}</label>
                                    <input class="form-control" required type="text" name="ingredient_name[]">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger mt-4 btnRemove">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">{{ translate('messages.instructions') }} <small
                                    class="text-danger">* </small></label>
                            <textarea class="form-control" name="instruction" required id="summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <span class="buttonPreloader float-end rounded-0 btn outline small my-0 w-25"
                                style="display: none">
                                <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt=""
                                    style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline">
                                Please Wait
                            </span>
                            <button type="submit" class="btn btn-primary w-25 float-end" id="add-recipe-btn">{{
                                translate('messages.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')

<script>
    
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 150
        });
    });

    $('#ingredients-inputs').multifield();

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

    $('#add-recipe-form').on('submit', function() {
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#add-recipe-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("meal-planning.recipes.store") }}',
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
                    location.href = '/meal-planning/recipes';
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