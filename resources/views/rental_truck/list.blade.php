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
                            <h5 class="m-b-10">Rental Truck Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
                            <li class="breadcrumb-item"><a href="#">Rental Truck Report</a></li>
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
                                    <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="startdate" onchange="filter('rental')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">End Date</span>
                                    <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="enddate" onchange="filter('rental')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">Site</span>
                                    <select class="form-select" id="itemname" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filter('rental')">
                                        <option value="" selected>Select</option>
                                        @if(!empty($exist_site))
                                        @foreach($exist_site as $value)
                                        <option value="{{ $value->site}}">{{ $value->site_1->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-1 text-end mb-3">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#import">Import</button>
                            </div>

                            <div class="col-sm-1 text-end mb-3">
                                <a href="{{ url('rental_truck/export') }} " class="btn btn-eco btn-sm btn-round has-ripple">Export</a>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Rental Truck Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_rental_truck" method="post">
                    <div id="addnew">
                        @csrf()
                        <h6 class="mb-3" style="color:#54be73"><b>BASIC DETAILS</b></h6>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="loading_date">Loading Date</label>
                                    <input type="date" class="form-control" name="loading_date[]" id="loading_date">
                                    <span id="loading_date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Location</label>
                                    <input type="text" class="form-control location" name="location[]" id="location" placeholder="Enter Location">
                                    <span id="location_error" class="error"></span>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="client_id">Client</label>
                                    <select class="form-select" name="client_id[]" id="client_id">
                                        <option value="" selected>Select</option>
                                        @if(!empty($client))
                                        @foreach($client as $value)
                                        <option value="{{ $value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="client_id_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="vehicle_no">Vehicle</label>
                                    <select class="form-select" name="vehicle_no[]" id="vehicle_no">
                                        <option value="" selected>Select</option>
                                        @if(!empty($vehicle))
                                        @foreach($vehicle as $value)
                                        <option value="{{ $value->id}}">{{ $value->vehicle_type }} ({{ $value->vehicle_number }})</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="vehicle_no_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="lab_loading_overloading">Labour Loading Exp / Overloading</label>
                                    <input type="text" class="form-control" name="lab_loading_overloading[]" id="lab_loading_overloading" placeholder="Enter Labour Loading Exp / Overloading">
                                    <span id="lab_loading_overloading_error" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
                        <h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="booking_amt">Booking Amount</label>
                                    <input type="number" class="form-control" id="booking_amt0" name="booking_amt[]" placeholder="Booking Amount">
                                    <span id="booking_amt_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="adv_pay">Advance Payment</label>
                                    <input type="number" class="form-control" id="adv_pay0" name="adv_pay[]" placeholder="Advance Payment" onkeydown="cal_final_amt(0)" onkeyup="cal_final_amt(0)">
                                    <span id="adv_pay_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="adv_pay_date">Advance Payment Date</label>
                                    <input type="date" class="form-control" id="adv_pay_date" name="adv_pay_date[]">
                                    <span id="adv_pay_date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="final_pay">Final Payment</label>
                                    <input type="number" class="form-control final_pay0" id="final_pay" name="final_pay[]" placeholder="Final Payment">
                                    <span id="final_pay_error0" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="final_pay_date">Final Payment Date</label>
                                    <input type="date" class="form-control" id="final_pay_date" name="final_pay_date[]">
                                    <span id="final_pay_date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="unloading_date">Unloading Date</label>
                                    <input type="date" class="form-control" id="unloading_date" name="unloading_date[]">
                                    <span id="unloading_date_error" class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>
                        <h6 class="mb-3" style="color:#54be73"><b>SITE DETAILS</b></h6>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="weight_cl_site">Weight at Client Site (In KG)</label>
                                    <input type="number" class="form-control" id="weight_cl_site0" name="weight_cl_site[]" placeholder="In (KG)">
                                    <span id="weight_cl_site_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="site">Site Name</label>
                                    <select class="form-select" name="site[]" id="site" onchange="change_lable(this.value,'0');">
                                        <option value="" selected>Select</option>
                                        @if(!empty($site))
                                        @foreach($site as $value)
                                        <option value="{{ $value->id}}">{{ $value->name }} ({{ $value->location }})</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="site_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="weight_sel_site">Weight at <span class="sel_site0" style="color:#54be73"></span> (In KG)</label>
                                    <input type="number" class="form-control" id="weight_sel_site0" name="weight_sel_site[]" placeholder="In (KG)" onkeydown="cat_weight_differ(0)" onkeyup="cat_weight_differ(0)">
                                    <span id="weight_sel_site_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="weight_differ">Weight Differnce</label>
                                    <input type="text" class="form-control" id="weight_differ0" name="weight_differ[]" placeholder="In (KG)">
                                    <span id="weight_differ_error0" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="transporter">Transport</label>
                                    <input type="text" class="form-control search_transporter_name" id="transporter" name="transporter[]" placeholder="Enter Transporter Name">
                                    <span id="transporter_error" class="error"></span>
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
                            <div class="col-sm-12">
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
<div class="modal fade" id="edit_rental_truck" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rental Truck</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_rental_truck_report" method="post">
                <div id="edit_rental_truck_model"></div>
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

            var html = '<div class="row borderset" id="addnew' + rowcount + '" >';
            html += '<div class="mt-4 mb-4" style="border-bottom: 1px solid black;"></div>';
            html += '<h6 class="mb-3" style="color:#00acc1"><b> <h6 class="mb-3" style="color:#54be73"><b>BASIC DETAILS</b></h6></b></h6>';
            html += '<div class="col-sm-2"> <div class="form-group input-group-sm"><label class="form-label" for="loading_date">Loading Date</label> <input type="date" class="form-control" name="loading_date[]" id="loading_date"> <span id="loading_date_error" class="error"></span> </div> </div>';
            html += '<div class="col-sm-2"> <div class="form-group input-group-sm"> <label class="form-label" for="Name">Location</label><input type="text" class="form-control location" name="location[]" id="location" placeholder="Enter Location"><span id="location_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"> <div class="form-group input-group-sm"><label class="form-label" for="client_id">Client</label><select class="form-select" name="client_id[]" id="client_id"><option value="" selected>Select</option>@if(!empty($client))@foreach($client as $value)<option value="{{ $value->id}}">{{ $value->name }}</option> @endforeach @endif</select><span id="client_id_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"> <div class="form-group input-group-sm">   <label class="form-label" for="vehicle_no">Vehicle</label><select class="form-select" name="vehicle_no[]" id="vehicle_no"> <option value="" selected>Select</option> @if(!empty($vehicle))@foreach($vehicle as $value)<option value="{{ $value->id}}">{{ $value->vehicle_type }} ({{ $value->vehicle_number }})</option> @endforeach @endif </select><span id="vehicle_no_error" class="error"></span></div> </div>';
            html += '<div class="col-sm-4"><div class="form-group input-group-sm"><label class="form-label" for="lab_loading_overloading">Labour Loading Exp / Overloading</label><input type="text" class="form-control" name="lab_loading_overloading[]" id="lab_loading_overloading" placeholder="Enter Labour Loading Exp / Overloading"><span id="lab_loading_overloading_error" class="error"></span></div></div>';
            html += '<div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div><h6 class="mb-3" style="color:#54be73"><b>PAYMENT DETAILS</b></h6><div class="row"><div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="booking_amt">Booking Amount</label><input type="number" class="form-control" id="booking_amt' + rowcount + '" name="booking_amt[]" placeholder="Booking Amount"><span id="booking_amt_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="adv_pay">Advance Payment</label><input type="number" class="form-control" id="adv_pay' + rowcount + '" name="adv_pay[]" placeholder="Advance Payment" onkeydown="cal_final_amt(' + rowcount + ')" onkeyup="cal_final_amt(' + rowcount + ')"><span id="adv_pay_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="adv_pay_date">Advance Payment Date</label><input type="date" class="form-control" id="adv_pay_date" name="adv_pay_date[]"><span id="adv_pay_date_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="final_pay">Final Payment</label><input type="number" class="form-control final_pay' + rowcount + '" id="final_pay" name="final_pay[]" placeholder="Final Payment"><span id="final_pay_error' + rowcount + '" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="final_pay_date">Final Payment Date</label><input type="date" class="form-control" id="final_pay_date" name="final_pay_date[]"><span id="final_pay_date_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="unloading_date">Unloading Date</label><input type="date" class="form-control" id="unloading_date" name="unloading_date[]"><span id="unloading_date_error" class="error"></span></div></div></div>';
            html += '<div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div><h6 class="mb-3" style="color:#54be73"><b>SITE DETAILS</b></h6><div class="row"><div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="weight_cl_site">Weight at Client Site</label><input type="text" class="form-control" id="weight_cl_site' + rowcount + '" name="weight_cl_site[]" placeholder="In (KG)"><span id="weight_cl_site_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="site">Site Name</label><select class="form-select" name="site[]" id="site" onchange="change_lable(this.value,' + rowcount + ')";> <option value="" selected>Select</option> @if(!empty($site)) @foreach($site as $value)<option value="{{ $value->id}}">{{ $value->name }} ({{ $value->location }})</option> @endforeach @endif</select><span id="site_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="weight_sel_site">Weight at <span id="sel_site' + rowcount + '" style="color:#54be73"></span> Site</label><input type="text" class="form-control" id="weight_sel_site' + rowcount + '" name="weight_sel_site[]" placeholder="In (KG)" onkeydown="cat_weight_differ(' + rowcount + ')" onkeyup="cat_weight_differ(' + rowcount + ')"><span id="weight_sel_site_error" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="weight_differ">Weight Differnce</label><input type="text" class="form-control" id="weight_differ' + rowcount + '" name="weight_differ[]" placeholder="In (KG)"><span id="weight_differ_error' + rowcount + '" class="error"></span></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="transporter">Transport</label><input type="text" class="form-control" id="transporter" name="transporter[]" placeholder="Enter Transporter Name"></div></div>';
            html += '<div class="col-sm-2"><div class="form-group input-group-sm"><label class="form-label" for="pan">PAN</label><input type="text" class="form-control" id="pan" name="pan[]" placeholder="Enter PAN"><span id="pan_error" class="error"></span></div></div>';
            html += '<div class="col-sm-12"> <div class="form-check form-switch" style="float:right;"><div class="d-flex align-items-start gap-3 mt-4 mb-2" ><button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="removerow(' + rowcount + ')">Remove</button></div></div></div><div class="eqress"></div></div></div>';
            $('#addnew').append(html);

        }

        function removerow(product) {
            $('#addnew' + product).remove();
        }
    </script>


    <script>
        var uri_value = $('#uri_value').val();
        getpaylist(uri_value);
        $(document).on('submit', '#add_rental_truck', function(ev) {
            $('.error').html('');

            ev.preventDefault(); // Prevent browers default submit.
            var formData = new FormData(this);
            var error = false;
            if (error == false) {
                $.ajax({
                    url: "{{ url('rental_truck/add') }} ",
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
                            $('#add_rental_truck')[0].reset();

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
                    url: "{{ url('rental_truck/importexcel') }} ",
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