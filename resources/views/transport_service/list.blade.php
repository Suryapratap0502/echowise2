@include('include/header')
<meta name="csrf-token" content="{{ csrf_token()}}" />
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
                            <h5 class="m-b-10">Transportation Service Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
                            <li class="breadcrumb-item"><a href="#">Transportation Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="uri_value" id="uri_value" value="{{ request()->segment(1) }}">
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- filter  start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm">Start Date</span>
                                    <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="startdate" onchange="filter('transport')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">End Date</span>
                                    <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="enddate" onchange="filter('transport')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">Driver</span>
                                    <select class="form-select" id="itemname" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filter('transport')">
                                        <option value="" selected>Select</option>
                                        @if(!empty($exist_driver))
                                        @foreach($exist_driver as $value)
                                        <option value="{{ $value->driver_name}}">{{ $value->admin->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-1 text-end mb-3">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#import">Import</button>
                            </div>

                            <div class="col-sm-1 text-end mb-3">
                                <a href="{{ url('transport_service/export') }} " class="btn btn-eco btn-sm btn-round has-ripple">Export</a>
                            </div>
                            @if(checkaccess('5', 'write_per','inner'))
                            <div class="col-sm-1 text-end mb-3">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Add</button>
                            </div>
                            @endif
                        </div>
                        <div class="table-responsive" id="pay_list">

                        </div>
                    </div>
                </div>
            </div>
            <!-- filter  end -->
        </div>

    </div>
</section>
<!-- Insert Data Modal Start -->
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Transportation Service Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_transport" method="post">
                    <div id="addnew">
                        @csrf()
                        <h6 class="mb-3" style="color:#54be73"><b>TRANSPORTATION DETAILS</b></h6>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="booking_date">Booking Date</label>
                                    <input type="date" class="form-control" name="booking_date[]" id="booking_date">
                                    <span id="booking_date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="start_trip">Start Trip</label>
                                    <input type="date" class="form-control location" name="start_trip[]" id="start_trip">
                                    <span id="start_trip_error" class="error"></span>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_no">Vehicle</label>
                                    <select class="form-select" name="vehicle_no[]" id="vehicle_no" onchange="get_vehicle_data(this.value,'0')">
                                        <option value="" selected>Select</option>
                                        @if(!empty($vehicle))
                                        @foreach($vehicle as $value)
                                        <option value="{{ $value->id}}">{{ $value->vehicle_type }} ({{ $value->vehicle_number }} - {{ $value->capacity }} KG)</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="vehicle_no_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_size">Vehicle Size</label>
                                    <input type="text" class="form-control vehicle_size_0" name="vehicle_size[]" id="vehicle_size" placeholder="Enter Vehicle Size">
                                    <span id="vehicle_size_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_capacity">Vehicle Capacity (In TON)</label>
                                    <input type="text" class="form-control vehicle_capacity_0" name="vehicle_capacity[]" id="vehicle_capacity" placeholder="Enter Vehicle Capacity (In TON)">
                                    <span id="vehicle_capacity_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="start_destination">Starting Destination</label>
                                    <select class="form-select" name="start_destination[]" id="start_destination">
                                        <option value="" selected>Select</option>
                                        @if(!empty($site))
                                        @foreach($site as $value)
                                        <option value="{{ $value->id}}">{{ $value->name }} ({{ $value->location }})</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="start_destination_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="start_load_destination">Starting Load Destination</label>
                                    <input type="text" class="form-control" name="start_load_destination[]" id="start_load_destination" placeholder="Enter Starting Load Destination">
                                    <span id="start_load_destination_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="final_destination">Final Destination</label>
                                    <input type="text" class="form-control" name="final_destination[]" id="final_destination" placeholder="Enter Final Destination">
                                    <span id="final_destination_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="distance">Distance (In KM.)</label>
                                    <input type="text" class="form-control" name="distance[]" id="distance" placeholder="Enter Distance">
                                    <span id="distance_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="end_trip">End Trip</label>
                                    <input type="date" class="form-control" name="end_trip[]" id="end_trip">
                                    <span id="end_trip_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="duration_day">Duration (In Days)</label>
                                    <input type="number" class="form-control" name="duration_day[]" id="duration_day" placeholder="Enter Duration (In Days)">
                                    <span id="duration_day_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="driver_name">Driver</label>
                                    <select class="form-select" name="driver_name[]" id="driver_name">
                                        <option value="" selected>Select</option>
                                        @if(!empty($driver))
                                        @foreach($driver as $value)
                                        <option value="{{ $value->id}}">{{ $value->name }} ({{ $value->mobile_no }})</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="driver_name_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="fuel_qty">Diesel liters/ CNG (KG)</label>
                                    <input type="number" class="form-control" name="fuel_qty[]" id="fuel_qty" placeholder="Enter Diesel liters/ CNG (KG)">
                                    <span id="fuel_qty_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="fuel_price">Diesel/CNG Rupees</label>
                                    <input type="number" class="form-control" name="fuel_price[]" id="fuel_price" placeholder="Enter Diesel/CNG Rupees">
                                    <span id="fuel_price_error" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
                        <h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="toll">Toll</label>
                                    <input type="number" class="form-control" name="toll[]" id="toll" placeholder="Enter Toll">
                                    <span id="toll_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="cash_toll">Cash Toll</label>
                                    <input type="number" class="form-control" name="cash_toll[]" id="cash_toll" placeholder="Enter Cash Toll">
                                    <span id="cash_toll_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="worker_expense">Driver/ Helper Expense </label>
                                    <input type="text" class="form-control" id="worker_expense" name="worker_expense[]" placeholder="Enter Driver/ Helper Expense">
                                    <span id="worker_expense_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="police">Police</label>
                                    <input type="number" class="form-control police" id="police" name="police[]" placeholder="Police">
                                    <span id="police_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="ad_blue">Ad Blue</label>
                                    <input type="text" class="form-control" id="ad_blue" name="ad_blue[]" placeholder="Ad Blue">
                                    <span id="ad_blue_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_repair">Vehicle repair</label>
                                    <input type="text" class="form-control" id="vehicle_repair" name="vehicle_repair[]" placeholder="Enter Vehicle repair">
                                    <span id="vehicle_repair_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="dala">Dala</label>
                                    <input type="text" class="form-control" id="dala" name="dala[]" placeholder="Enter Dala">
                                    <span id="dala_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="border">Border</label>
                                    <input type="text" class="form-control" id="border" name="border[]" placeholder="Enter Border">
                                    <span id="border_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="border_weight">Border Weight</label>
                                    <input type="text" class="form-control" id="border_weight" name="border_weight[]" placeholder="Enter Border Weight">
                                    <span id="border_weight_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="bilti">Bilti</label>
                                    <input type="text" class="form-control" id="bilti" name="bilti[]" placeholder="Enter Bilti">
                                    <span id="bilti_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="union_youth">Union</label>
                                    <input type="text" class="form-control" id="union_youth" name="union_youth[]" placeholder="Enter Union Youth">
                                    <span id="union_youth_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="rto">RTO</label>
                                    <input type="text" class="form-control" id="rto" name="rto[]" placeholder="Enter RTO">
                                    <span id="rto_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="misc">Misc</label>
                                    <input type="text" class="form-control" id="misc" name="misc[]" placeholder="Enter Misc">
                                    <span id="misc_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="total_exp_paid">Total expenses (Paid)</label>
                                    <input type="text" class="form-control" id="total_exp_paid" name="total_exp_paid[]" placeholder="Enter Total expenses (Paid)">
                                    <span id="total_exp_paid_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_booking_amt">Vehicle booking amount</label>
                                    <input type="text" class="form-control" id="vehicle_booking_amt" name="vehicle_booking_amt[]" placeholder="Enter Vehicle booking amount">
                                    <span id="vehicle_booking_amt_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_pay_recv">Vehicle payment received</label>
                                    <input type="text" class="form-control" id="vehicle_pay_recv" name="vehicle_pay_recv[]" placeholder="Enter Vehicle booking amount">
                                    <span id="vehicle_pay_recv_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="commission">Commission</label>
                                    <input type="text" class="form-control" id="commission" name="commission[]" placeholder="Enter Commission">
                                    <span id="commission_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="munsiyana">Munsiyana</label>
                                    <input type="text" class="form-control" id="munsiyana" name="munsiyana[]" placeholder="Enter Munsiyana">
                                    <span id="munsiyana_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="tds">TDS</label>
                                    <input type="text" class="form-control" id="tds" name="tds[]" placeholder="Enter TDS">
                                    <span id="tds_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="holding_charges">Holding Charges</label>
                                    <input type="text" class="form-control" id="holding_charges" name="holding_charges[]" placeholder="Enter Holding Charges">
                                    <span id="holding_charges_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="profit_loss">Profit/ Loss</label>
                                    <input type="text" class="form-control" id="profit_loss" name="profit_loss[]" placeholder="Enter Profit/ Loss">
                                    <span id="profit_loss_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="due_on_logistics">Due on logistics</label>
                                    <input type="text" class="form-control" id="due_on_logistics" name="due_on_logistics[]" placeholder="Enter Due on logistics">
                                    <span id="due_on_logistics_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="pan">PAN</label>
                                    <input type="text" class="form-control" id="pan" name="pan[]" placeholder="Enter PAN">
                                    <span id="pan_error" class="error"></span>
                                </div>
                            </div>
                            <input type="hidden" class="rowcount" value="" name="rowcount">
                            <div class="col-sm-2">
                                <div class="mt-3 mb-2" style="float: right;">
                                    <button type="button" class="btn btn-eco waves-effect waves-light btn-sm " onclick="add_row()">Add</button>
                                    <div class="eqress"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-eco submitbtn"> Save </button>
                        <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
                    </div>
            </div>
        </div>

        </form>
    </div>
</div>
</div>
<!-- Insert Data Modal End -->
<!-- edit Modal Start -->
<div class="modal fade" id="edit_transport" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transpotation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_transport_report" method="post">
                    <div id="edit_transport_model"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-eco submitbtn"> Save </button>
                <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- edit Modal End -->

<!-- import Data modal start -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Excel For Rental Truck Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-center p-5">
                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                <lord-icon src="https://cdn.lordicon.com/qduilmpq.json" trigger="loop" style="width:100px;height:100px">
                </lord-icon>
                <div class="mt-4">
                    <h5 class="mb-3">Import Your Excel Here</h5>
                    <a href="" download> <button type="button" data-toggle="tooltip" data-placement="bottom" title="Upload Sample Data" class="btn btn-primary btn-sm btn-round has-ripple">Sample Excel</button></a><br><br>
                    <form method="POST" id="upload_excel" enctype="multipart/form-data">
                        @csrf()
                        <div class="col-md-12">
                            <input type="file" class="form-control" id="uploadFile" name="uploadFile" placeholder="Select Your File" required accept=".xls, .xlsx">
                            <div class="error" id="uploadError"></div>
                        </div><br>
                        <div class="hstack gap-2 justify-content-center">
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal"> Close</a>

                            <input type="submit" name="fileuploadsubmit" class="btn btn-primary" value="Upload">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- import data modal end -->


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/ac-alert.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js')}}"></script>
    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>

    <script>
        var rowcount = 0;
        $(".rowcount").val(rowcount);

        function add_row() {
            rowcount++;
            $(".rowcount").val(rowcount);

            var html = '<div id="addnew' + rowcount + '" ><div class="row borderset">';
            html += '<div class="mt-4 mb-4" style="border-bottom: 1px solid black;"></div>';
            html += '<h6 class="mb-3" style="color:#54be73"><b>TRANSPORTATION DETAILS</b></h6>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="booking_date">Booking Date</label><input type="date" class="form-control" name="booking_date[]" id="booking_date"><span id="booking_date_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="start_trip">Start Trip</label><input type="date" class="form-control location" name="start_trip[]" id="start_trip"><span id="location_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_no">Vehicle</label><select class="form-select" name="vehicle_no[]" id="vehicle_no" onchange="get_vehicle_data(this.value,' + rowcount + ')"> <option value="" selected>Select</option> @if(!empty($vehicle)) @foreach($vehicle as $value) <option value="{{ $value->id}}">{{ $value->vehicle_type }} ({{ $value->vehicle_number }} - {{ $value->capacity }} KG)</option> @endforeach @endif</select><span id="vehicle_no_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_size">Vehicle Size</label><input type="text" class="form-control vehicle_size_' + rowcount + '" name="vehicle_size[]" id="vehicle_size" placeholder="Enter Vehicle Size"><span id="vehicle_size_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_capacity">Vehicle Capacity (In TON)</label><input type="text" class="form-control vehicle_capacity_' + rowcount + '" name="vehicle_capacity[]" id="vehicle_capacity" placeholder="Enter Vehicle Capacity (In TON)"><span id="vehicle_capacity_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="start_destination">Starting Destination</label><select class="form-select" name="start_destination[]" id="start_destination"><option value="" selected>Select</option> @if(!empty($site)) @foreach($site as $value) <option value="{{ $value->id}}">{{ $value->name }} ({{ $value->location }})</option> @endforeach @endif </select><span id="start_destination_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="start_load_destination">Starting Load Destination</label><input type="text" class="form-control" name="start_load_destination[]" id="start_load_destination" placeholder="Enter Starting Load Destination"><span id="start_load_destination_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="final_destination">Final Destination</label><input type="text" class="form-control" name="final_destination[]" id="final_destination" placeholder="Enter Final Destination"><span id="final_destination_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="distance">Distance (In KM.)</label><input type="text" class="form-control" name="distance[]" id="distance" placeholder="Enter Distance"><span id="distance_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="end_trip">End Trip</label><input type="date" class="form-control" name="end_trip[]" id="end_trip"><span id="end_trip_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="duration_day">Duration (In Days)</label><input type="number" class="form-control" name="duration_day[]" id="duration_day" placeholder="Enter Duration (In Days)"><span id="duration_day_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="driver_name">Driver</label><select class="form-select" name="driver_name[]" id="driver_name"> <option value="" selected>Select</option> @if(!empty($driver)) @foreach($driver as $value) <option value="{{ $value->id}}">{{ $value->name }} ({{ $value->mobile_no }})</option> @endforeach @endif </select><span id="driver_name_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="fuel_qty">Diesel liters/ CNG (KG)</label><input type="number" class="form-control" name="fuel_qty[]" id="fuel_qty" placeholder="Enter Diesel liters/ CNG (KG)"><span id="fuel_qty_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="fuel_price">Diesel/CNG Rupees</label><input type="number" class="form-control" name="fuel_price[]" id="fuel_price" placeholder="Enter Diesel/CNG Rupees"><span id="fuel_price_error" class="error"></span></div></div></div>';
            
            html += '<div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div><h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6><div class="row">';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="toll">Toll</label><input type="number" class="form-control" name="toll[]" id="toll" placeholder="Enter Toll"><span id="toll_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="cash_toll">Cash Toll</label><input type="number" class="form-control" name="cash_toll[]" id="cash_toll" placeholder="Enter Cash Toll"><span id="cash_toll_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="worker_expense">Driver/ Helper Expense </label><input type="text" class="form-control" id="worker_expense" name="worker_expense[]" placeholder="Enter Driver/ Helper Expense"><span id="worker_expense_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="police">Police</label><input type="number" class="form-control police" id="police" name="police[]" placeholder="Police"><span id="police_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="ad_blue">Ad Blue</label><input type="text" class="form-control" id="ad_blue" name="ad_blue[]" placeholder="Ad Blue"><span id="ad_blue_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_repair">Vehicle repair</label><input type="text" class="form-control" id="vehicle_repair" name="vehicle_repair[]" placeholder="Enter Vehicle repair"><span id="vehicle_repair_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="dala">Dala</label><input type="text" class="form-control" id="dala" name="dala[]" placeholder="Enter Dala"><span id="dala_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="border">Border</label><input type="text" class="form-control" id="border" name="border[]" placeholder="Enter Border"> <span id="border_error" class="error"></span> </div> </div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="border_weight">Border Weight</label><input type="text" class="form-control" id="border_weight" name="border_weight[]" placeholder="Enter Border Weight"><span id="border_weight_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="bilti">Bilti</label><input type="text" class="form-control" id="bilti" name="bilti[]" placeholder="Enter Bilti"><span id="bilti_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="union_youth">Union</label><input type="text" class="form-control" id="union_youth" name="union_youth[]" placeholder="Enter Union Youth"><span id="union_youth_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="rto">RTO</label><input type="text" class="form-control" id="rto" name="rto[]" placeholder="Enter RTO"><span id="rto_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="misc">Misc</label><input type="text" class="form-control" id="misc" name="misc[]" placeholder="Enter Misc"><span id="misc_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="total_exp_paid">Total expenses (Paid)</label><input type="text" class="form-control" id="total_exp_paid" name="total_exp_paid[]" placeholder="Enter Total expenses (Paid)"><span id="total_exp_paid_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_booking_amt">Vehicle booking amount</label><input type="text" class="form-control" id="vehicle_booking_amt" name="vehicle_booking_amt[]" placeholder="Enter Vehicle booking amount"><span id="vehicle_booking_amt_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="vehicle_pay_recv">Vehicle payment received</label><input type="text" class="form-control" id="vehicle_pay_recv" name="vehicle_pay_recv[]" placeholder="Enter Vehicle booking amount"><span id="vehicle_pay_recv_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="commission">Commission</label><input type="text" class="form-control" id="commission" name="commission[]" placeholder="Enter Commission"><span id="commission_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="munsiyana">Munsiyana</label><input type="text" class="form-control" id="munsiyana" name="munsiyana[]" placeholder="Enter Munsiyana"><span id="munsiyana_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="tds">TDS</label><input type="text" class="form-control" id="tds" name="tds[]" placeholder="Enter TDS"><span id="tds_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="holding_charges">Holding Charges</label><input type="text" class="form-control" id="holding_charges" name="holding_charges[]" placeholder="Enter Holding Charges"><span id="holding_charges_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="profit_loss">Profit/ Loss</label><input type="text" class="form-control" id="profit_loss" name="profit_loss[]" placeholder="Enter Profit/ Loss"><span id="profit_loss_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="due_on_logistics">Due on logistics</label><input type="text" class="form-control" id="due_on_logistics" name="due_on_logistics[]" placeholder="Enter Due on logistics"><span id="due_on_logistics_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="pan">PAN</label><input type="text" class="form-control" id="pan" name="pan[]" placeholder="Enter PAN"><span id="pan_error" class="error"></span></div></div>';
            
            // REMOVE BUTTON
            html += '<div class="col-sm-2"> <div class="form-check form-switch" style="float:right;"><div class="d-flex align-items-start gap-3 mt-4 mb-2" ><button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="removerow(' + rowcount + ')">Remove</button></div></div></div><div class="eqress"></div></div></div></div>';
            $('#addnew').append(html);

        }

        function removerow(product) {
            $('#addnew' + product).remove();
        }
    </script>


    <script>
        var uri_value = $('#uri_value').val();
        getpaylist(uri_value);
        $(document).on('submit', '#add_transport', function(ev) {
            $('.error').html('');

            ev.preventDefault(); // Prevent browers default submit.
            var formData = new FormData(this);
            var error = false;
            if (error == false) {
                $.ajax({
                    url: "{{ url('transport_service/add') }} ",
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".submitbtn").css('display', 'none');
                    },
                    success: function(result) {
                        if (result.code == 200) {
                            $('#modal-report').modal('hide');
                            swal(result.message, {
                                icon: "success",
                            });
                            getpaylist();
                            $('#add_transport')[0].reset();

                        } else if (result.code == 402) {
                            $('#modal-report').modal('show');
                            swal(result.message, {
                                icon: "error",
                            });

                        } else if (result.code == 201) {
                            $('#modal-report').modal('show');
                            swal(result.message, {
                                icon: "error",
                            });
                        } else if (result.code == 401) {
                            $('#modal-report').modal('show');
                            $.each(result.message, function(prefix, val) {
                                $('#' + prefix + '_error').text(val[0]);
                            });
                            $('.error').css('color', 'red');
                        }
                    },
                    error: function(xhr) {
                        $(".submitbtn").css('display', 'block');
                    },
                    complete: function() {
                        $(".submitbtn").css('display', 'block');
                    },
                })
            }
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $(document).on('submit', '#upload_excel', function(ev) {
            $('.error').html('');

            ev.preventDefault(); // Prevent browers default submit.
            var formData = new FormData(this);
            var error = false;
            var file = $('#uploadFile').val();
            if (file == '') {
                $('#uploadError').html('Select Excel for upload');
                $('.error').css('color', 'red');
                error = true;
            }
            if (error == false) {
                $.ajax({
                    url: "{{ url('transport_service/importexcel') }} ",
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".submitbtn").css('display', 'none');
                    },
                    success: function(result) {
                        if (result.code == 200) {
                            $('#import').modal('hide');
                            swal(result.message, {
                                icon: "success",
                            });
                            getpaylist();
                            $('#upload_excel')[0].reset();

                        } else if (result.code == 400) {
                            $('#import').modal('show');
                            swal(result.message, {
                                icon: "error",
                            });

                        }
                    },
                    error: function(xhr) {
                        $(".submitbtn").css('display', 'block');
                    },
                    complete: function() {
                        $(".submitbtn").css('display', 'block');
                    },
                })
            }
        })

        $('.search_transporter_name').typeahead({
            source: function(query, result) {
                $.ajax({
                    url: base_url + 'rental_truck/get_transporter',
                    method: "POST",
                    data: {
                        query: query
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data.length);
                        if (data.length > 0) {
                            result($.map(data, function(item) {
                                return item;
                            }));
                        } else {

                        }
                    },
                })
            },
        });
    </script>



    </body>

    </html>