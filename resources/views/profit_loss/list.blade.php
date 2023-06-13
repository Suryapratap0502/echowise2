@include('include/header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    #alert {
        display: none;
    }
</style>
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Cost & Revenue</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Cost & Revenue</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="uri_value" id="uri_value" value="{{ request()->segment(1) }}">

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- customar project  start -->
            <div class="col-xl-6">
                <div class="card">
                <div class="card-header">
                        <h5>Cost</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info">Start Month</span>
                                    <input type="month" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="startdate" onchange="filter('cash_report_filter')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" style="color:white;">End Month</span>
                                    <input type="month" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="enddate" onchange="filter('cash_report_filter')">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-sm-2 mb-3">
                                <a href="{{ url('cash_report/export') }} " class="btn btn-eco btn-sm btn-round has-ripple">Export</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Exp. Category </th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($expense))
                                    @foreach($expense as $key => $value)
                                    <tr>
                                        <td>1</td>
                                        <td>03-2023</td>
                                        <td>Rental Truck</td>
                                        <td>40000</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                <div class="card-header">
                        <h5>Revenue</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info">Start Month</span>
                                    <input type="month" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="startdate" onchange="filter('cash_report_filter')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" style="color:white;">End Month</span>
                                    <input type="month" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="enddate" onchange="filter('cash_report_filter')">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-sm-2 text-end mb-3">
                                <a href="{{ url('cash_report/export') }} " class="btn btn-eco btn-sm btn-round has-ripple">Export</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="report-table-1" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Service Name</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>03-2023</td>
                                        <td>Transpotation Service</td>
                                        <td>20998</td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            <!-- customar project  end -->
        </div>

    </div>
</section>
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Cash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_cash" method="post" enctype="multipart/form-data">
                    <div id="addnew">
                        @csrf()
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Date</label>
                                    <input type="date" class="form-control" id="date" name="date[]">
                                    <span id="date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Cash With</label>
                                    <input type="text" class="form-control" id="cash_with" name="cash_with[]" placeholder="Enter Cash With">
                                    <span id="cash_with_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount[]" placeholder="Enter Amount">
                                    <span id="amount_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Status</label>
                                    <input type="text" class="form-control" id="data_status" name="data_status[]">
                                    <span id="status_error" class="error"></span>
                                </div>
                            </div>
                            <input type="hidden" class="rowcount" value="" name="rowcount">
                            <div class="col-sm-8">
                                <div class="mt-3" style="float: right;">
                                    <button type="button" class="btn btn-primary waves-effect waves-light btn-sm " onclick="add_row()">Add</button>
                                    <div class="eqress"></div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-eco submitbtn"> Save </button>
                <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_cash_report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cash Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_cashreport_data" method="post" enctype="multipart/form-data">

                    <div id="edit_cash"></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-eco submitbtn"> Save </button>
                <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ac-alert.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
<script>
    //  DataTable start
    $('#report-table').DataTable();
    $('#report-table-1').DataTable();
    //  DataTable end
</script>
</body>

</html>