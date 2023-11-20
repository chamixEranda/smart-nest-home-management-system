@extends('layouts.app')

@section('content')

<section class="budgeting_section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.finance') }} <i class="fas fa-chevron-right"></i> {{
            translate('messages.budgeting') }}
        </h2>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-sm-5 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center">
                            <span>{{ translate('messages.Expense Overview').' - '.date('M Y') }}</span>
                        </div>
                        <div class="card-body">
                            <canvas id="expenseOverview"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center">
                            <span>{{ translate('messages.Income Overview').' - '.date('M Y') }}</span>
                        </div>
                        <div class="card-body">
                            <canvas id="incomeOverview"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <span>{{ translate('messages.Incomes & Expenses Overview').' - '.date('M Y') }}</span>
                </div>
                <div class="card-body">
                    <canvas id="overallOverview"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
    if(document.getElementById('expenseOverview')){
      var link2 = "/finance/budgeting/json_expense_by_category";
      $.ajax({
          url: link2,
          success: function (data2) {
              var json2 = JSON.parse(data2);

              const ctx = document.getElementById('expenseOverview').getContext('2d');
              const expenseOverviewChart = new Chart(ctx,{
                type: 'doughnut',
                  data: {
                      labels: json2['category'],
                      datasets: [
                          {
                              data: json2['amounts'],
                              backgroundColor: json2['colors'],	
                          }
                      ],
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: {
                              position: 'top',
                          },
                          title: {
                              display: false,
                              text: '$lang_expense_overview'
                          },
                          tooltip: {
                              callbacks: {
                                  label: function(context) {
                                      return " " + context.label + ": " + _currency + " " + context.parsed;
                                  },
                              },
                          },
                      }
                  },
              });
          }
      });
    }

    if(document.getElementById('incomeOverview')){
      var link3 = "/finance/budgeting/json_income_by_category";
      $.ajax({
          url: link3,
          success: function (data2) {
              var json2 = JSON.parse(data2);

              const ctx = document.getElementById('incomeOverview').getContext('2d');
              const incomeOverviewChart = new Chart(ctx,{
                  type: 'pie',
                  data: {
                      labels: json2['category'],
                      datasets: [
                          {
                              data: json2['amounts'],
                              backgroundColor: json2['colors'],	
                          }
                      ],
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: {
                              position: 'top',
                          },
                          title: {
                              display: false,
                              text: '$lang_expense_overview'
                          },
                          tooltip: {
                              callbacks: {
                                  label: function(context) {
                                      return " " + context.label + ": " + _currency + " " + context.parsed;
                                  },
                              },
                          },
                      }
                  },
              });
          }
      });
    }

    var ctx = document.getElementById('overallOverview').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: @json($labels),
        datasets: [{
            label: 'Expenses',
            data: @json($expensesValues),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Income',
            data: @json($incomeValues),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
        },
        options: {
        // Customize chart options as needed
        }
    });
</script>
@endpush