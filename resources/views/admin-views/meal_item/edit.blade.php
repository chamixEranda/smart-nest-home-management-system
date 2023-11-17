@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('assets/admin/images/meals.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.edit_meal') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['admin.meal-item.update', $lims_meal_data->id], 'method' => 'put', 'files' =>
            true, 'autocomplete' => 'off']) !!}
            @csrf
            <div class="form-group mb-3">
                <center class="py-3 my-auto">
                    <img class="img--200" id="viewer" onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'"
                        src="{{ asset('storage/meal/' . $lims_meal_data->image) }}" alt="logo image" />
                </center>
                <label class="form-label mb-0">
                    {{ translate('messages.Meal Image') }}
                    <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                        )</small>
                </label>
                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                    class="form-control" id="customFileEg1">
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.name') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $lims_meal_data->name }}">
                @error('name')
                <span class="valitation-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">{{ translate('messages.meal_category') }}</label>
                    <select class="form-select" name="meal_category_id" aria-label="Default select example" required>
                        <option value="">{{ translate('messages.select a meal category') }}</option>
                        @foreach ($lims_category_list as $category)
                        <option value="{{ $category->id }}" @if($lims_meal_data->meal_categroy_id == $category->id)
                            selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('meal_category_id')
                    <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col form-group">
                    <label class="form-label">{{ translate('messages.meal_type') }}</label>
                    <select class="form-select" name="meal_type_id" aria-label="Default select example" required>
                        <option value="">{{ translate('messages.select a meal type') }}</option>
                        @foreach ($lims_type_list as $type)
                        <option value="{{ $type->id }}" @if($lims_meal_data->meal_type_id == $type->id) selected
                            @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('meal_type_id')
                    <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.description') }}</label>
                <textarea class="form-control" name="description"
                    id="summernote">{{ $lims_meal_data->description }}</textarea>
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
        $('#summernote').summernote({
        tabsize: 2,
        height: 150
        });
    });

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
</script>
@endpush