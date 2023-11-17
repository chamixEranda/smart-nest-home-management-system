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
                {{ translate('messages.meal_items') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4">{{ translate('messages.meal_item_list') }}</h5>
                </div>
                <div class="col">
                    <a href="{{ route('admin.meal-item.create') }}" class="btn btn-primary float-end"><i class="fa fa-plus"></i> {{ translate('messages.add_new_meal') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="account-table" class="table">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th class="border-0">{{ translate('messages.image') }}</th>
                        <th class="border-0">{{translate('messages.name')}}</th>
                        <th class="border-0">{{translate('messages.meal_category')}}</th>
                        <th class="border-0">{{translate('messages.meal_type')}}</th>
                        <th class="border-0">{{translate('messages.description')}}</th>
                        <th class="border-0 text-center">{{translate('messages.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lims_meal_list as $key=> $meal)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>
                                <img src="{{ asset('storage/meal/' . $meal->image) }}" height="80" width="80" onerror="this.src='{{ asset('assets/admin/images/img2.jpg') }}'">
                            </td>
                            <td>{{ $meal->name }}</td>
                            <td>{{ $meal->category->name }}</td>
                            <td>{{ $meal->type->name }}</td>
                            <td>{!! $meal->description !!}</td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--primary btn-outline-primary" href="{{ route('admin.meal-item.edit',$meal['id']) }}" title="{{translate('messages.edit')}} {{translate('messages.meal')}}"><i class="fas fa-pen"></i>
                                    </a>
                                    <a class="btn action-btn btn--danger btn-outline-danger" href="javascript:" onclick="form_alert('meal-{{$meal['id']}}','{{ translate('Want to delete this meal ?') }}')" title="{{translate('messages.delete')}} {{translate('messages.meal')}}"><i class="fas fa-trash"></i>
                                    </a>
                                    <form action="{{route('admin.meal-item.destroy',[$meal['id']])}}"
                                                method="post" id="meal-{{$meal['id']}}">
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

@endsection
@push('script')
<script>
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
            'targets': [0,4]
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