@extends('layouts.app')

@section('content')

<section class="relation-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.relationship_management') }} <i
                class="fas fa-chevron-right"></i> {{
            translate('messages.add_family_member') }}</h2>
    </div>
    <div class="container">
        <div class="col-md-12 recipe-create-form d-flex justify-content-center">
            <div class="custom-card p-4 my-3" style="width: 700px;">
                <div class="card-header">
                    <h3 class="text-center text-uppercase">{{ translate('messages.update_family_member') }}</h3>
                </div>
                <div class="row">
                    <form action="javascript:" autocomplete="off" id="update-family-form"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group mb-3">
                            <center class="py-3 my-auto">
                                <img class="img--vertical" id="viewer"
                                    onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'" src="{{ asset('public/documents/family_members/'.$family_member->image) }}"
                                    alt="logo image" />
                            </center>
                            <label class="form-label mb-0">
                                {{ translate('messages.Member Image') }}
                                <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                                    )</small>
                            </label>
                            <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="form-control" id="customFileEg1">
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                            <input type="text" class="form-control" name="name" value="{{ $family_member->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.DOB') }} <small class="text-danger">* </small></label>
                            <input type="date" class="form-control" name="dob" value="{{ $family_member->dob }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">{{ translate('messages.gender') }} <small class="text-danger">* </small></label>
                            <select class="form-control" name="gender" aria-label="Default select example" required>
                                <option value="male" @if($family_member->gender == 'male') selected @endif>{{ translate('messages.male') }}</option>
                                <option value="female" @if($family_member->gender == 'female') selected @endif>{{ translate('messages.female') }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.phone_number') }} <small class="text-danger">* </small></label>
                            <input type="text" class="form-control" name="phone_number" value="{{ $family_member->phone_number }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.family_position') }} <small class="text-danger">* </small></label>
                            <input type="text" class="form-control" name="family_position" value="{{ $family_member->family_position }}" required>
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
    var edit_member_id = <?php echo json_encode($family_member->id); ?>;

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

    $('#update-family-form').on('submit', function() {
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#update-family-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '/relationship-management/family-member/'+edit_member_id,
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
                    location.href = '/relationship-management/family-member/';
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