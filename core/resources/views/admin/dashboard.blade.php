@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['total_users']}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Users')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-ban"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['banned_users']}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Banned Users')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($widget['users_balance'])}}</span>
                        <span class="currency-sign">{{$general->cur_sym}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Users Balance')</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($widget['users_invest'])}}</span>
                        <span class="currency-sign">{{$general->cur_sym}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Investment')</span>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($paymentWithdraw['total_withdraw_amount'])}}</span>
                        <span class="currency-sign">{{trans($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Withdraw')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($widget['free_coins'])}} </span>
                        <!-- <span class="currency-sign">{{trans($general->sec_cur_text)}}</span> -->
                         <span class="currency-sign">USDT</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Free Coins')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($paymentWithdraw['total_transfer_charge'])}} </span>
                        <span class="currency-sign">{{trans($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Transfer Charge')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($widget['total_binary_com'])}}</span>
                        <span class="currency-sign">{{$general->cur_sym}}</span>

                    </div>
                    <div class="numbers">
                        <span class="amount">{{getAmount($widget['total_indir_com'])}}</span>
                        <span class="currency-sign">{{$general->cur_sym}}</span>

                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Tree  Commission')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Monthly  Deposit & Withdraw  Report')</h5>
                    <div id="apex-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="row mb-none-30">
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--17  box--shadow2">
                            <i class="las la-money-bill "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{getAmount($payment['total_deposit_amount'])}} {{$general->cur_text}}</h2>
                            <p class="text--small">@lang('Total Deposit')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--17 box--shadow2">
                            <i class="las la-money-check"></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{getAmount($payment['total_deposit_charge'])}} {{$general->cur_text}}</h2>
                            <p class="text--small">@lang('Total Deposit Charge')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--17  box--shadow2">
                            <i class="las la-spinner"></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{$payment['total_deposit_pending']}}</h2>
                            <p class="text--small">@lang('Pending Deposit')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--17 box--shadow2">
                            <i class="las la-ban "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers">{{$payment['total_deposit_reject']}}</h2>
                            <p class="text--small">@lang('Reject Deposit')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row end -->
    <div class="row mb-none-30 mt-5">

        <div class="col-xl-6 mb-30">
            <div class="card ">
                <div class="card-header">
                    <h6 class="card-title mb-0">@lang('New User list')</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($latestUser as $user)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <div class="user">
                                            <div class="thumb"><img
                                                    src="{{ getImage('assets/images/user/profile/'. $user->image, null, true)}}"
                                                    alt="@lang('image')"></div>
                                            <span class="name">{{$user->fullname}}</span>
                                        </div>
                                    </td>
                                    <td data-label="@lang('Username')"><a
                                            href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a>
                                    </td>
                                    <td data-label="@lang('Email')">{{ $user->email }}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.users.detail', $user->id) }}" class="icon-btn"
                                           data-toggle="tooltip" title="@lang('Details')">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">@lang('User Not Found')</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>

        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Last 30 days Withdraw History')</h5>
                    <div id="withdraw-line"></div>
                </div>
            </div>
        </div>


    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Browser')</h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By OS')</h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Login By Country')</h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

    <script src="{{asset('assets/admin/js/vendor/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendor/chart.js.2.8.0.js')}}"></script>

    <script>
        'use strict';
        // apex-bar-chart js
        var options = {
            series: [{
                name: 'Total Deposit',
                data: [
                    @foreach($report['months'] as $month)
                    {{ getAmount(@$depositsMonth->where('months',$month)->first()->depositAmount) }},
                    @endforeach
                ]
            }, {
                name: 'Total Withdraw',
                data: [
                    @foreach($report['months'] as $month)
                    {{ getAmount(@$withdrawalMonth->where('months',$month)->first()->withdrawAmount) }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($report['months']->flatten()),
            },
            yaxis: {
                title: {
                    text: "{{__($general->cur_sym)}}",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "{{__($general->cur_sym)}}" + val + " "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();

        // apex-line chart
        var options = {
            chart: {
                height: 430,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: "Series 1",
                    data: @json($withdrawals['per_day_amount']->flatten())
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($withdrawals['per_day']->flatten())
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#withdraw-line"), options);

        chart.render();

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_browser_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_browser_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });


        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_os_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_os_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_country_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_country_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
@endpush
