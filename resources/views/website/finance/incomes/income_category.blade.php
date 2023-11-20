@extends('layouts.app')

@section('content')

<div class="wrapper">
    @include('layouts.sidebar')
    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
        </nav>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-uppercase">{{ translate('messages.income_category') }}</h2>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end mt-1" data-bs-toggle="modal" type="button"
                        data-bs-target="#addIncomeCategory"><i class="fas fa-plus"></i> {{
                        translate('messages.add_new_category') }}</button>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <td>{{ translate('messages.#') }}</td>
                        <td>{{ translate('messages.category_name') }}</td>
                        <td>{{ translate('messages.color') }}</td>
                        <td class="text-end">{{ translate('messages.total_incomes') }}</td>
                        <td class="text-center">{{ translate('messages.action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lims_category_list as $key => $category)
                    @php
                        $total_incomes = App\Models\Income::where('income_category_id', $category->id)->sum('amount');
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td><div class="rounded-circle color-circle" style="background:{{ $category->color }}"></div></td>
                        <td class="text-end">{{ number_format($total_incomes,2) }}</td>
                        <td>
                            <div class="text-center">
                                <a href="javascript:"
                                    onclick="editIncomeCategory({{ $category->id }},'{{ $category->name }}','{{ $category->color }}')"
                                    class="text-dark mx-1"><i class="fas fa-pencil-alt fa-2x"></i></a>
                                <a class="text-danger mx-1" href="javascript:"
                                    onclick="form_alert('category-{{$category['id']}}','{{ translate('Want to delete this category ?') }}')"
                                    title="{{translate('messages.delete')}} {{translate('messages.category')}}"><i
                                        class="fas fa-trash fa-2x"></i>
                                </a>
                                <form action="{{route('finance.income-category.destroy',[$category['id']])}}"
                                    method="post" id="category-{{$category['id']}}">
                                    @csrf @method('delete')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">{{ translate('messages.do_data_to_show') }}</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    {!! $lims_category_list->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addIncomeCategory" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.add_income_category') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="javascript:" method="POST" autocomplete="off" id="add-incomCategory-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.color') }} <small class="text-danger">* </small></label>
                                <input type="color" class="form-control" name="color" required>
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

    <div class="modal fade" id="editIncomeCategory" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.add_income_category') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="javascript:" autocomplete="off" id="edit-incomCategory-form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="">
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>{{ translate('messages.color') }} <small class="text-danger">* </small></label>
                                <input type="color" class="form-control" name="color" required>
                            </div>
                            <div class="form-group">
                                <span class="buttonPreloader float-end rounded-0 btn outline my-0 w-50"
                                    style="display: none">
                                    <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt=""
                                        style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline">
                                    Please Wait
                                </span>
                                <button type="submit" class="btn btn-primary w-50 float-end" id="edit-category-btn">{{
                                    translate('messages.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#add-incomCategory-form').on('submit', function() {
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#add-incomCategory-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("finance.income-category.store") }}',
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

    function editIncomeCategory(id, name, color) {
      $('#edit-incomCategory-form input[name="name"]').val(name);
      $('#edit-incomCategory-form input[name="id"]').val(id);
      $('#edit-incomCategory-form input[name="color"]').val(color);
      $('#editIncomeCategory').modal('show');
    }

    $('#edit-incomCategory-form').on('submit', function() {
        $('#edit-category-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#edit-incomCategory-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("finance.income-category.update") }}',
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
                    $('#edit-category-btn').css('display', 'block');
                }

                else{
                    ToastMixin.fire({
                        animation: true,
                        icon: 'success',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#edit-category-btn').css('display', 'block');
                    location.reload();
                }
            },
            error: function (err) {
                $('.buttonPreloader').css('display', 'none');
                $('#edit-category-btn').css('display', 'block');
            }
        });
    });

</script>
@endpush