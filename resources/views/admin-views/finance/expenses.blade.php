@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{ asset('assets/admin/images/spending.png') }}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.expenses') }}
            </span>
        </h1>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4">{{ translate('messages.expense_list') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="account-table" class="table">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th class="border-0">{{ translate('messages.user') }}</th>
                        <th class="border-0">{{translate('messages.expense_category')}}</th>
                        <th class="border-0">{{translate('messages.name')}}</th>
                        <th class="border-0">{{translate('messages.purpose')}}</th>
                        <th class="border-0">{{translate('messages.date')}}</th>
                        <th class="border-0">{{translate('messages.amount')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lims_expense_list as $key=> $expense)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $expense->user->f_name.' '.$expense->user->l_name }}</td>
                        <td>{{ $expense->category->name }}</td>
                        <td>{{ $expense->name }}</td>
                        <td>{{ $expense->purpose }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($expense->amount,2) }}</td>
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