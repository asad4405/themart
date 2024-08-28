@extends('layouts.admin')
@section('content')
    <h3>Welcome to Dashboard, <strong class="text-primary">{{ Auth::user()->name }}</strong></h3>

    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Last 7 days Order</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Last 7 days Sales Amount</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        const ctx = document.getElementById('myChart');
        var total_order = {{ Js::from($total_order_info) }};
        var order_date = {{ Js::from($order_date_info) }};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: order_date,
                datasets: [{
                    label: 'Total Orders',
                    data: total_order,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // Sales Chart


        const sales = document.getElementById('myChart2');
        var total_sales = {{ Js::from($total_sales_info) }};
        var sales_date = {{ Js::from($sales_date_info) }};

        new Chart(sales, {
            type: 'bar',
            data: {
                labels: sales_date,
                datasets: [{
                    label: 'Sales Amount',
                    data: total_sales,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
