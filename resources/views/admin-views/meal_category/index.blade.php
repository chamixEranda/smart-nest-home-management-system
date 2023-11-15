@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('assets/admin/images/category.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.add_new_category') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.meal-category.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ translate('messages.name') }}</label>
                    <input type="text" class="form-control" name="name">
                    @error('title')
                    <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mt-4">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn"
                            class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="submit" class="btn btn-primary">{{translate('messages.submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-4">{{ translate('messages.category_list') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="account-table" class="table">
                    <thead>
                        <tr>
                            <th class="not-exported"></th>
                            <th class="border-0">{{ translate('messages.name') }}</th>
                            <th class="border-0 text-center">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lims_category_list as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--primary btn-outline-primary" href="javascript:"
                                        title="{{translate('messages.edit')}} {{translate('messages.category')}}"
                                        onclick="editMealCategory({{ $category->id }}, '{{ $category->name }}')"><i class="fas fa-pen"></i>
                                    </a>
                                    <a class="btn action-btn btn--danger btn-outline-danger" href="javascript:"
                                        onclick="form_alert('category-{{$category['id']}}','{{ translate('Want to delete this category ?') }}')"
                                        title="{{translate('messages.delete')}} {{translate('messages.category')}}"><i
                                            class="fas fa-trash"></i>
                                    </a>
                                    <form action="{{route('admin.meal-category.destroy',[$category['id']])}}"
                                        method="post" id="category-{{$category['id']}}">
                                        @csrf @method('delete')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{ translate('messages.edit_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {!! Form::open(['route' => ['admin.meal-category.update', 1], 'method' => 'put', 'id' =>
                        'edit-category-form']) !!}
                        <input type="hidden" name="id">
                        <div class="form-group mb-3">
                            <label>{{ translate('messages.name') }} <small class="text-danger">* </small></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-50 float-end" id="add-recipe-btn">{{
                                translate('messages.submit') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function editMealCategory(id, name) {
        $('#edit-category-form input[name="id"]').val(id);
        $('#edit-category-form input[name="name"]').val(name);
        $('#editCategoryModal').modal('show');
    }

var table = $('#account-table').DataTable( {
    "order": [],
    'language': {
        'lengthMenu': '_MENU_ {{translate("messages.records per page")}}',
            "info":      '<small>{{translate("messages.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
        "search":  '{{translate("messages.Search")}}',
        'paginate': {
                'previous': '<i class="fas fa-chevron-left"></i>',
                'next': '<i class="fas fa-chevron-right"></i>'
        }
    },
    'columnDefs': [
        {
            "orderable": false,
            'targets': [0]
        },
        {
            'render': function(data, type, row, meta){
                if(type === 'display'){
                    data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                }

                return data;
            },
            'checkboxes': {
                'selectRow': true,
                'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
            },
            'targets': [0]
        }
    ],
    'select': { style: 'multi',  selector: 'td:first-child'},
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: '<"row"lfB>rtip',
    
} );


</script>
@endpush