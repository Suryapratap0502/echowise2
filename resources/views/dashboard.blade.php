@include('include/header')



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            @if(getuserdetail('role') == 1)
            <!-- seo analytics start -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <a href="{{ url('user') }}">
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-auto">
                                    <i class="icon feather icon-users f-30 text-c-blue"></i>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted m-b-10">Total Users</h6>
                                    <h2 class="m-b-0">{{$total_user}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-trending-up f-30 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Sales</h6>
                                <h2 class="m-b-0">₹ {{$total_sale}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-trending-down f-30 text-c-red"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Expenses</h6>
                                <h2 class="m-b-0">₹ {{$total_expense}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-award f-30 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Clients</h6>
                                <h2 class="m-b-0">{{$total_client}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seo analytics end -->
            <!-- Latest Order start -->
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-c-green pb-0">
                        <div class="row text-white">
                            <div class="col-auto">
                                <h4 class="m-b-5 text-white">₹ {{$today_sale}}</h4>
                            </div>
                            <div class="col text-end">
                                <h6 class="text-white">Today Sale</h6>
                                <h6 class="text-white">{{ date('d/m/Y') }}</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <h5>₹ {{$this_month_sales}}</h5>
                        <p class="text-muted">Total Sales in <b>{{ date('m/Y') }}</b></p>
                        <div class="row">
                            <p class="mb-2" style="color:#00acc1"><b>Top 3 Products Sale</b></p>
                            @if(!empty($sale_data))
                            @foreach($sale_data as $value)
                            <div class="col">
                                <p class="text-muted m-b-5">{{$value->product->name}}</p>
                                <h6>₹ {{$value->amount}}</h6>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-c-red pb-0">
                        <div class="row text-white">
                            <div class="col-auto">
                                <h4 class="m-b-5 text-white">₹ {{$today_expense}}</h4>
                            </div>
                            <div class="col text-end">
                                <h6 class="text-white">Today Expenses</h6>
                                <h6 class="text-white">{{ date('d/m/Y') }}</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <h5>₹ {{$this_month_expense}}</h5>
                        <p class="text-muted">Total Expenses in <b>{{ date('m/Y') }}</b> </p>
                        <div class="row">
                            <p class="mb-2" style="color:#00acc1"><b>Top Clients Expense</b></p>
                            @if(!empty($expense_data))
                            @foreach($expense_data as $value)
                            @php $cl_nam = explode(" ",$value->client->name); @endphp
                            <div class="col">
                                <p class="text-muted m-b-5">{{$cl_nam[0]}}</p>
                                <h6>₹ {{$value->amount}}</h6>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-c-eco-green pb-0">
                        <div class="row text-white">
                            <div class="col-auto">
                                <h4 class="m-b-5 text-white">₹ {{$today_cashflow}}</h4>
                            </div>
                            <div class="col text-end">
                                <h6 class="text-white">Cash Flow of Today</h6>
                                <h6 class="text-white">{{ date('d/m/Y') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h5> @if($curr_month_cashflow < 0) <span style="color:red;"> ₹ {{$curr_month_cashflow}}</span> @else <span style="color:green;"> ₹ {{$curr_month_cashflow}}</span> @endif</h5>
                        <p class="mb-4" style="color:#00acc1"><b>Cashflow of {{ date('m/Y') }}</b></p>
                        <div class="row">
                            <div id="monthlyprofit_2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-c-eco-green pb-0">
                        <div class="row text-white">
                            <div class="col-auto">
                                <h4 class="m-b-5 text-white">₹ {{ $total_cash_flow}}</h4>
                            </div>
                            <div class="col text-end">
                                <h6 class="text-white">Total Cash Flow</h6>
                                <h6 class="text-white">{{ date("m/Y", strtotime($min_month)) }} to {{ date("m/Y", strtotime($max_month)) }} </h6>
                            </div>
                        </div>
                        <div id="sec-ecommerce-chart-line"></div>
                    </div>
                    <div class="card-footer">
                        <h5>₹ {{ $sale}} - ₹ {{ $expense}} </h5>
                        <p class="mb-4" style="color:#00acc1"><b>Total Cashflow</b></p>
                        <div class="row">
                            <div id="monthlyprofit-1"></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Latest Order end -->
            <!-- order  start -->

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Sales</h5>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart-2"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Expenses</h5>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart-3"></div>
                    </div>
                </div>
            </div>

            <!-- order  end -->
            @else
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-users f-30 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Users</h6>
                                <h2 class="m-b-0">{{$total_user}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-file-text f-30 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Category</h6>
                                <h2 class="m-b-0">{{$total_category}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-file-minus f-30 text-c-green"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total SubCategry</h6>
                                <h2 class="m-b-0">{{$total_subcategory}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-auto">
                                <i class="icon feather icon-shopping-cart f-30 text-c-blue"></i>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-muted m-b-10">Total Products</h6>
                                <h2 class="m-b-0">{{$total_products}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <iframe src="https://www.ecowise.net.in/" title="description" height="500" width="1250" title="Iframe Example"></iframe>
            </div>
            @endif
        </div>
        <!-- [ Main Content ] end -->


    </div>
</div>

<!-- Required Js -->
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
<!-- custom-chart js -->
<script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
<script>
    $(document).ready(function() {
        checkCookie();
    });

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {
        var ticks = getCookie("modelopen");
        if (ticks != "") {
            ticks++;
            setCookie("modelopen", ticks, 1);
            if (ticks == "2" || ticks == "1" || ticks == "0") {
                $('#exampleModalCenter').modal();
            }
        } else {
            // user = prompt("Please enter your name:", "");
            $('#exampleModalCenter').modal();
            ticks = 1;
            setCookie("modelopen", ticks, 1);
        }
    }
</script>

<script>
    // [ monthlyprofit-1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 70,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#9cc026"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#9cc026",
                strokeColor: "#9cc026",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [<?php
                        foreach ($sale_chart as $val) {
                            echo $val->amount . ','; ?>

                    <?php  }

                    ?>
                ]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {

                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#monthlyprofit-1"), options);
        chart.render();
    });
    // [ monthlyprofit-1 ] end
</script>
<!-- Sale Graph Start -->
<script>
    $(function() {
        var options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            series: <?= json_encode($arrs) ?>,
            xaxis: {
                type: 'datetime',
                categories: [<?php foreach ($month_chart as $val) {
                                    echo '"' . $val->month . '"' . ','; ?> <?php  } ?>],
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(
            document.querySelector("#bar-chart-2"),
            options
        );
        chart.render();
    });
</script>

<!-- Sale Graph End -->

<!-- total cash flow Graph Start -->
<script>
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 70,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#9cc026"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#9cc026",
                strokeColor: "#9cc026",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 9]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Monthly Profit :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#monthlyprofit_2"), options);
        chart.render();
    });
</script>
<!-- total cash flow Graph End -->

<!-- expense chart start -->
<script>
    $(function() {
        var options = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252", "#9ccc65"],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            series: <?= json_encode($arrs_exp) ?>,
            xaxis: {
                type: 'datetime',
                categories: [<?php foreach ($exp_chart as $val) {
                                    echo '"' . $val->month . '"' . ','; ?> <?php  } ?>],
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(
            document.querySelector("#bar-chart-3"),
            options
        );
        chart.render();
    });
</script>
<!-- expense chart end -->

</body>

</html>