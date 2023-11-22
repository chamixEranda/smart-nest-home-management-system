@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{ asset('assets/admin/images/vacation.png') }}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.edit_family_plan') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['admin.relationship-management.update', $plan_category->id], 'method' => 'put', 'files' =>
            true, 'autocomplete' => 'off']) !!}
            @csrf
            <div class="form-group mb-3">
                <center class="py-3 my-auto">
                    <img class="img--200" id="viewer" onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'"
                        src="{{ asset('storage/plans/' . $plan_category->image) }}" alt="logo image" />
                </center>
                <label class="form-label mb-0">
                    {{ translate('messages.Image') }}
                    <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                        )</small>
                </label>
                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                    class="form-control" id="customFileEg1">
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.name') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $plan_category->name }}">
                @error('title')
                <span class="valitation-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.description') }}</label>
                <textarea class="form-control summernote" name="description">{{ $plan_category->description }}</textarea>
                @error('description')
                <span class="valitation-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 mt-4">
                <div class="btn--container justify-content-end">
                    <button type="reset" id="reset_btn" class="btn btn--reset">{{translate('messages.reset')}}</button>
                    <button type="submit" class="btn btn-primary">{{translate('messages.submit')}}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
      $(document).ready(function() {
        $('.summernote').summernote({
        tabsize: 2,
        height: 150
        });
    });
</script>
@endpush