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
                    <h2 class="text-uppercase">{{ translate('messages.incomes') }}</h2>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end mt-1" data-bs-toggle="modal" type="button"
                        data-bs-target="#addIncomeCategory"><i class="fas fa-plus"></i> {{
                        translate('messages.add_new_income') }}</button>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <td>{{ translate('messages.#') }}</td>
                        <td>{{ translate('messages.category_name') }}</td>
                        <td>{{ translate('messages.name') }}</td>
                        <td>{{ translate('messages.purpose') }}</td>
                        <td>{{ translate('messages.date') }}</td>
                        <td>{{ translate('messages.amount') }}</td>
                        <td>{{ translate('messages.action') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lims_income_list as $key => $income)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $income->category->name }}</td>
                            <td>{{ $income->name }}</td>
                            <td>{!! $income->purpose !!}</td>
                            <td>{{ $income->date }}</td>
                            <td>{{ number_format($income->amount,2) }}</td>
                            <td>
                                <div class="">
                                    <a href="javascript:"
                                        onclick="editIncome({{ $income->id }},{{ $income->income_category_id }},'{{ $income->name }}','{{ $income->purpose }}','{{ $income->method }}','{{ $income->date }}', {{ $income->amount }})"
                                        class="text-dark mx-1"><i class="fas fa-pencil-alt fa-2x"></i></a>
                                    <a class="text-danger mx-1" href="javascript:"
                                        onclick="form_alert('income-{{$income['id']}}','{{ translate('Want to delete this income ?') }}')"
                                        title="{{translate('messages.delete')}} {{translate('messages.income')}}"><i
                                            class="fas fa-trash fa-2x"></i>
                                    </a>
                                    <form action="{{route('finance.income.destroy',[$income['id']])}}"
                                        method="post" id="income-{{$income['id']}}">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ translate('messages.do_data_to_show') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    {!! $lims_income_list->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addIncomeCategory" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.add_income_category') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="javascript:" method="POST" autocomplete="off" id="add-income-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">{{ translate('messages.income_category') }} <small
                                        class="text-danger">* </small></label>
                                <select class="form-select" name="income_category_id"
                                    aria-label="Default select example" required>
                                    @foreach ($lims_category_list as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col form-group">
                                    <label>{{ translate('messages.name') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col form-group">
                                    <label>{{ translate('messages.amount') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col form-group">
                                    <label>{{ translate('messages.date') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="col form-group">
                                    <label>{{ translate('messages.method') }}</label>
                                    <input type="text" class="form-control" name="method">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ translate('messages.purpose') }} <small
                                        class="text-danger">* </small></label>
                                <textarea class="form-control" name="purpose" rows="3" required></textarea>
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

    <div class="modal fade" id="editIncome" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
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
                        <form action="javascript:" autocomplete="off" id="edit-income-form"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ translate('messages.income_category') }} <small
                                        class="text-danger">* </small></label>
                                <select class="form-select" name="income_category_id"
                                    aria-label="Default select example" required>
                                    @foreach ($lims_category_list as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col form-group">
                                    <label>{{ translate('messages.name') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col form-group">
                                    <label>{{ translate('messages.amount') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col form-group">
                                    <label>{{ translate('messages.date') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="col form-group">
                                    <label>{{ translate('messages.method') }} <small class="text-danger">*
                                        </small></label>
                                    <input type="text" class="form-control" name="method" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ translate('messages.purpose') }} <small
                                        class="text-danger">* </small></label>
                                <textarea class="form-control" name="purpose" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <span class="buttonPreloader float-end rounded-0 btn outline my-0 w-50"
                                    style="display: none">
                                    <img src="{{ asset('assets/img/btn-preloader.gif') }}" alt=""
                                        style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:inline">
                                    Please Wait
                                </span>
                                <button type="submit" class="btn btn-primary w-50 float-end" id="edit-income-btn">{{
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
    $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 150
        });
    });

    var edit_id;

  $('#add-income-form').on('submit', function() {
        $('#add-recipe-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#add-income-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route("finance.income.store") }}',
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

    function editIncome(id, category_id, name, purpose, method, date, amount) {
        edit_id = id;
      $('#edit-income-form input[name="name"]').val(name);
      $('#edit-income-form input[name="method"]').val(method);
      $('#edit-income-form input[name="date"]').val(date);
      $('#edit-income-form input[name="amount"]').val(amount);
      $('#edit-income-form input[name="id"]').val(id);
      $('#edit-income-form select[name="income_category_id"]').val(category_id);
      $('#edit-income-form textarea[name="purpose"]').html(purpose);
      $('#editIncome').modal('show');
    }

    $('#edit-income-form').on('submit', function() {
        $('#edit-income-btn').css('display', 'none');
        $('.buttonPreloader').css('display', 'block');
        var formData = new FormData($('#edit-income-form')[0]);
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/finance/income/'+edit_id,
            type: "POST",
            dataType: 'json',
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
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
                    $('#edit-income-btn').css('display', 'block');
                }

                else{
                    ToastMixin.fire({
                        animation: true,
                        icon: 'success',
                        title: data.message,
                    });
                    $('.buttonPreloader').css('display', 'none');
                    $('#edit-income-btn').css('display', 'block');
                    location.reload();
                }
            },
            error: function (err) {
                $('.buttonPreloader').css('display', 'none');
                $('#edit-income-btn').css('display', 'block');
            }
        });
    });

</script>
@endpush