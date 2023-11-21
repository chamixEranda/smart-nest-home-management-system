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
                    <h2 class="text-uppercase">{{ translate('messages.savings') }}</h2>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <th>{{ translate('messages.#') }}</th>
                        <th>{{ translate('messages.date') }}</th>
                        <th>{{ translate('messages.transaction_type') }}</th>
                        <th>{{ translate('messages.category') }}</th>
                        <th>{{ translate('messages.name') }}</th>
                        <th>{{ translate('messages.amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i=0;
                    ?>
                    @forelse ($all_transaction_list as $transaction)
                    @php
                        if($transaction->type == 'Income') {
                            $balance += $transaction->amount;
                        }
                        else {
                            $balance -= $transaction->amount;
                        }
                    @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->category }}</td>
                            <td>{{ $transaction->name }}</td>
                            @if ($transaction->type == 'Income')
                            <td class="text-end">+ {{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($transaction->amount,2) }}</td>
                            @else
                            <td class="text-end">- {{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($transaction->amount,2) }}</td>
                            @endif
                            <?php $i++; ?>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ translate('messages.do_data_to_show') }}</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="tfoot active">
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total Savings</strong></td>
                        <td class="text-end"><strong>{{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($balance,2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
    </div>

    
</div>
@endsection
@push('scripts')

@endpush