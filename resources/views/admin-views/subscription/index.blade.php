@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('assets/admin/images/subscription.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.add_new_subscription') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.subscription.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ translate('messages.title') }}</label>
                    <input type="text" class="form-control" name="title">
                    @error('title')
                        <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-3">
                    <label class="form-label">{{ translate('messages.price') }}</label>
                    <input type="number" class="form-control" name="price">
                    @error('price')
                        <span class="valitation-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-3">
                    <label class="form-label">{{ translate('messages.description') }}</label>
                    <textarea class="form-control" name="description" id="summernote"></textarea>
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
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-4">{{ translate('messages.subscription_list') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="account-table" class="table">
                    <thead>
                        <tr>
                            <th class="not-exported"></th>
                            <th class="border-0">{{ translate('messages.title') }}</th>
                            <th class="border-0">{{translate('messages.price')}}</th>
                            <th class="border-0">{{translate('messages.description')}}</th>
                            <th class="border-0 text-center">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lims_subscription_list as $key => $subscription)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subscription->title }}</td>
                                <td>{{ $subscription->price }}</td>
                                <td>{!! $subscription->description !!}</td>
                                <td>
                                    <div class="btn--container justify-content-center">
                                        <a class="btn action-btn btn--primary btn-outline-primary" href="{{ route('admin.subscription.edit',$subscription['id']) }}" title="{{translate('messages.edit')}} {{translate('messages.subscription')}}"><i class="fas fa-pen"></i>
                                        </a>
                                        <a class="btn action-btn btn--danger btn-outline-danger" href="javascript:" onclick="form_alert('subscription-{{$subscription['id']}}','{{ translate('Want to delete this subscription ?') }}')" title="{{translate('messages.delete')}} {{translate('messages.subscription')}}"><i class="fas fa-trash"></i>
                                        </a>
                                        <form action="{{route('admin.subscription.destroy',[$subscription['id']])}}"
                                                    method="post" id="subscription-{{$subscription['id']}}">
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
  $('#summernote').summernote({
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

