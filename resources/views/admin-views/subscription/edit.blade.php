@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('assets/admin/images/edit.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.update_subscription') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.subscription.update', [$subscription->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">{{ translate('messages.title') }}</label>
                    <input type="text" class="form-control" name="title" value="{{ $subscription->title }}">
                    @error('title')
                        <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-3">
                    <label class="form-label">{{ translate('messages.price') }}</label>
                    <input type="number" class="form-control" name="price" value="{{ $subscription->price }}">
                    @error('price')
                        <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-3">
                    <label class="form-label">{{ translate('messages.description') }}</label>
                    <textarea class="form-control" name="description" id="summernote">{!! $subscription->description !!}</textarea>
                    @error('description')
                        <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="submit" class="btn btn-primary">{{translate('messages.update')}}</button>
                    </div>
                </div>
            </form>
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

</script>
@endpush


