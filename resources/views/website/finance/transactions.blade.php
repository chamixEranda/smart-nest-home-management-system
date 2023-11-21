@extends('layouts.app')

@section('content')

<section class="transaction_section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.finance') }} <i class="fas fa-chevron-right"></i> {{
            translate('messages.transactions') }}
        </h2>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ translate('messages.transactions') }}</h3>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    @foreach($categoryPercentages as $categoryName => $data)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->index }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true"
                                aria-controls="collapse{{ $loop->index }}">
                                {{ $categoryName }} - {{ number_format($data['percentage'], 2) }}%
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse show"
                            aria-labelledby="heading{{ $loop->index }}">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <td>{{ translate('messages.category_name') }}</td>
                                                <td>{{ translate('messages.name') }}</td>
                                                <td>{{ translate('messages.purpose') }}</td>
                                                <td>{{ translate('messages.date') }}</td>
                                                <td>{{ translate('messages.amount') }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['expenses'] as $expense)
                                            <tr>
                                                <td>{{ $expense->category->name }}</td>
                                                <td>{{ $expense->name }}</td>
                                                <td>{!! $expense->purpose !!}</td>
                                                <td>{{ $expense->date }}</td>
                                                <td>{{ \App\CentralLogics\Helpers::currency_symbol().' '.number_format($expense->amount,2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection