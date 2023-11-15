@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('assets/admin/images/business.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.business_setup') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['route' => 'admin.business-settings.store', 'method' => 'post', 'files' => true, 'autocomplete' => 'off']) !!}
        @csrf
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> <span class="card-header-icon mr-2"><i class="fas fa-user"></i>&nbsp; </span>
                            <span>{{ translate('genaral') }} & {{ translate('business_Information') }}</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-0">
                            @php($name = \App\Models\BusinessSetting::where('key', 'business_name')->first())
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.business') }}
                                        {{ translate('messages.name') }}</label>
                                    <input type="text" name="business_name" value="{{ $name->value ?? '' }}"
                                        class="form-control" placeholder="{{ translate('messages.new_business') }}"
                                        required>
                                </div>
                            </div>
                            @php($phone = \App\Models\BusinessSetting::where('key', 'phone')->first())
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.phone') }}</label>
                                    <input type="number" value="{{ $phone->value ?? '' }}" name="phone"
                                        class="form-control" placeholder="{{ translate('messages.phone') }}" required>
                                </div>
                            </div>
                            @php($email = \App\Models\BusinessSetting::where('key', 'email_address')->first())
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.email') }}</label>
                                    <input type="email" value="{{ $email->value ?? '' }}" name="email"
                                        class="form-control" placeholder="{{ translate('messages.email') }}" required>
                                </div>
                            </div>
                            @php($address = \App\Models\BusinessSetting::where('key', 'address')->first())
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.address') }}</label>
                                    <textarea type="text" id="address" rows="3" name="address" class="form-control" placeholder="{{ translate('messages.address') }}" rows="1" required>{{ $address->value ?? '' }}</textarea>
                                </div>
                            </div>
                            @php($footer_text = \App\Models\BusinessSetting::where('key', 'footer_text')->first())
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.footer') }}
                                        {{ translate('messages.text') }}</label>
                                    <textarea type="text" value="" rows="3" name="footer_text" class="form-control h--45"
                                        placeholder="{{ translate('messages.Ex_:_Footer_Text') }}" required>{{ $footer_text->value ?? '' }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                @php($currency_code = \App\Models\BusinessSetting::where('key', 'currency')->first())
                                <div class="form-group mb-0">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.currency') }}</label>
                                    <select name="currency" class="form-control js-select2-custom">
                                        @foreach (\App\Models\Currency::orderBy('currency_code')->get() as $currency)
                                            <option value="{{ $currency['currency_code'] }}"
                                                {{ $currency_code ? ($currency_code->value == $currency['currency_code'] ? 'selected' : '') : '' }}>
                                                {{ $currency['currency_code'] }} ( {{ $currency['currency_symbol'] }}
                                                )
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @php($about_text = \App\Models\BusinessSetting::where('key', 'about_text')->first())
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"
                                        for="exampleFormControlInput1">{{ translate('messages.about_us') }}
                                        {{ translate('messages.text') }}</label>
                                    <textarea class="form-control" rows="3" name="about_text" name="description" id="summernote">{{ $about_text->value ?? '' }}</textarea>
                                    @error('description')
                                        <span class="valitation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                @php($logo = \App\Models\BusinessSetting::where('key', 'logo')->first())
                                @php($logo = $logo->value ?? '')
                                <div class="d-flex flex-column h-100">
                                    <label class="form-label mb-0">
                                        {{ translate('messages.logo') }}
                                        <small class="text-danger">* ( {{ translate('messages.ratio') }} 300x100
                                            )</small>
                                    </label>
                                    <center class="py-3 my-auto">
                                        <img class="img--vertical" id="viewer"
                                            onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'"
                                            src="{{ asset('storage/business/' . $logo) }}"
                                            alt="logo image" />
                                    </center>
                                    <div class="custom-file">
                                        <input type="file" name="logo" id="customFileEg1"
                                            >
                                        <label class="custom-file-label"
                                            for="customFileEg1">{{ translate('messages.choose') }}
                                            {{ translate('messages.file') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                @php($icon = \App\Models\BusinessSetting::where('key', 'icon')->first())
                                @php($icon = $icon->value ?? '')
                                <div class="d-flex flex-column h-100">
                                    <label class="form-label mb-0">
                                        {{ translate('messages.Fav Icon') }}
                                        <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                                            )</small>
                                    </label>
                                    <center class="py-3 my-auto">
                                        <img class="img--110" id="iconViewer"
                                            onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'"
                                            src="{{ asset('storage/business/' . $icon) }}"
                                            alt="Fav icon" />
                                    </center>
                                    <div class="custom-file">
                                        <input type="file" name="icon" id="favIconUpload"
                                            class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                            for="favIconUpload">{{ translate('messages.choose') }}
                                            {{ translate('messages.file') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn--container justify-content-end mt-3">
                    <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                    <button type="submit" class="btn btn-primary">{{ translate('save_information') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>

@endsection
@push('script')
<script>

    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 150
        });
    });

    function getImagePreview(event)
    {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('previewAdd');
    var newimg=document.createElement('img');
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="400";
    newimg.height="200";
    newimg.className = "border border-dark img-fluid mb-3";
    imagediv.appendChild(newimg);
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

    $("#favIconUpload").change(function() {
        readURL(this, 'iconViewer');
    });
</script>
@endpush