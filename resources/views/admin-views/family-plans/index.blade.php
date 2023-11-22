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
                {{ translate('messages.family_plan_category') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.relationship-management.store', 'method' => 'post', 'files' => true,
            'autocomplete' => 'off']) !!}
            @csrf
            <div class="form-group mb-3">
                <center class="py-3 my-auto">
                    <img class="img--200" id="viewer" onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'"
                        src="" alt="logo image" />
                </center>
                <label class="form-label mb-0">
                    {{ translate('messages.Image') }}
                    <small class="text-danger">* ( {{ translate('messages.ratio') }} 200x200
                        )</small>
                </label>
                <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                    class="form-control" id="customFileEg1">
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.name') }}</label>
                <input type="text" class="form-control" name="name">
                @error('title')
                <span class="valitation-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ translate('messages.description') }}</label>
                <textarea class="form-control summernote" name="description"></textarea>
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
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4">{{ translate('messages.family_plan_categories') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="account-table" class="table">
                    <thead>
                        <tr>
                            <th class="not-exported"></th>
                            <th class="border-0">{{translate('messages.image')}}</th>
                            <th class="border-0">{{translate('messages.name')}}</th>
                            <th class="border-0">{{translate('messages.description')}}</th>
                            <th class="border-0">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plan_categories as $key => $category)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>
                                <img src="{{ asset('storage/plans/' . $category->image) }}" height="80" width="80" onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'">
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{!! $category->description !!}</td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--primary btn-outline-primary"
                                        href="{{ route('admin.relationship-management.edit',$category['id']) }}"
                                        title="{{translate('messages.edit')}} {{translate('messages.category')}}"><i
                                            class="fas fa-pen"></i>
                                    </a>
                                    <a class="btn action-btn btn--danger btn-outline-danger" href="javascript:"
                                        onclick="form_alert('category-{{$category['id']}}','{{ translate('Want to delete this category ?') }}')"
                                        title="{{translate('messages.delete')}} {{translate('messages.category')}}"><i
                                            class="fas fa-trash"></i>
                                    </a>
                                    <form action="{{route('admin.relationship-management.destroy',[$category['id']])}}" method="post"
                                        id="category-{{$category['id']}}">
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