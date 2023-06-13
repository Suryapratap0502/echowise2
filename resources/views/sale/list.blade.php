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
                            <h5 class="m-b-10">Sales Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
                            <li class="breadcrumb-item"><a href="#">Sale Report</a></li>
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
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm">Start Date</span>
                                    <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="startdate" onchange="filter('sale')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">End Date</span>
                                    <input type="date" class="form-control" aria-label="Small" id="enddate" aria-describedby="inputGroup-sizing-sm" onchange="filter('sale')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text btn-info" id="inputGroup-sizing-sm" style="color:white;">Item Name</span>
                                    <select class="form-select" id="itemname" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filter('sale')">
                                        <option>Select</option>
                                        @if(!empty($exist_pro))
                                        @foreach($exist_pro as $value)
                                        <option value="{{ $value->item_name}}">{{ $value->product->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1 text-end mb-3">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#import">Import</button>
                            </div>

                            <div class="col-sm-1 text-end mb-3">
                                <a href="{{ url('sale/export') }} " class="btn btn-eco btn-sm btn-round has-ripple">Export</a>
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
            <!-- customar project  end -->
        </div>

    </div>
</section>
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_sale" method="post" enctype="multipart/form-data">
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
                                    <label class="form-label" for="Name">Item Name</label>
                                    <select class="form-select" name="item_name[]" id="item_name">
                                        <option>Select</option>
                                        @if(!empty($product))
                                        @foreach($product as $value)
                                        <option value="{{ $value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id="item_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Quantity</label>
                                    <input type="number" class="form-control" id="qty" name="qty[]" placeholder="Enter Quantity">
                                    <span id="qty_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Rate</label>
                                    <input type="number" class="form-control" id="rate" name="rate[]" placeholder="Enter Rate">
                                    <span id="rate_error" class="error"></span>
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
                                    <label class="form-label" for="Name">Payment</label>
                                    <input type="number" class="form-control" id="payment" name="payment[]" placeholder="Enter Payment">
                                    <span id="payment_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Payment Date</label>
                                    <input type="date" class="form-control" id="pay_date" name="pay_date[]">
                                    <span id="pay_date_error" class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label class="form-label" for="Name">Status</label>
                                    <input type="text" class="form-control" id="status" name="status[]">
                                    <span id="status_error" class="error"></span>
                                </div>
                            </div>
                            <input type="hidden" class="rowcount" value="" name="rowcount">
                            <div class="col-sm-4">
                                <div class="mt-3" style="float: right;">
                                    <button type="button" class="btn btn-eco waves-effect waves-light btn-sm " onclick="add_row()">Add</button>
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

<div class="modal fade" id="edit_sale" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_sale_data" method="post" enctype="multipart/form-data">

                    <div id="editsale"></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-eco submitbtn"> Save </button>
                <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
            </div>
            </form>
        </div>
    </div>
</div>

<!-- import Data modal start -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Excel For Sale Report</h5>
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
    var uri_value = $('#uri_value').val();
    getpaylist(uri_value);
    $(document).on('submit', '#add_sale', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('sale/add') }} ",
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

<script>
    var rowcount = 1;
    $(".rowcount").val(rowcount);

    function add_row() {
        rowcount++;
        $(".rowcount").val(rowcount);

        var html = '<div class="row borderset" id="addnew' + rowcount + '" >';
        html += '<div class="mt-2 mb-2" style="border-bottom: 1px solid #e2e5e8;"></div>';;
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Date</label><input type="date" class="form-control" id="date" name="date[]"><span id="date_error" class="error"></span> </div> </div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Item Name</label><select class="form-select" name="item_name[]" id="item_name"> <option value="" selected>Select</option>@if(!empty($product)) @foreach($product as $value) <option value="{{ $value->id}}">{{ $value->name }}</option> @endforeach @endif </select><span id="item_error" class="error"></span></div></div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Quantity</label><input type="number" class="form-control" id="qty" name="qty[]" placeholder="Enter Quantity"><span id="qty_error" class="error"></span></div></div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Rate</label><input type="number" class="form-control" id="rate" name="rate[]" placeholder="Enter Rate"> <span id="rate_error" class="error"></span></div> </div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Amount</label><input type="number" class="form-control" id="amount" name="amount[]" placeholder="Enter Amount"> <span id="amount_error" class="error"></span>  </div> </div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" >Payment</label><input type="number" class="form-control" id="payment" name="payment[]" placeholder="Enter Payment"> <span id="payment_error" class="error"></span> </div></div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" for="Name">Payment Date</label><input type="date" class="form-control" id="pay_date" name="pay_date[]"> <span id="pay_date_error" class="error"></span></div></div>';
        html += '<div class="col-sm-4"> <div class="form-group input-group-sm"><label class="form-label" >Status</label><input type="text" class="form-control" id="status" name="status[]"> <span id="status_error" class="error"></span> </div> </div>';
        html += '<div class="col-sm-4"> <div class="form-check form-switch" style="float:right;"><div class="d-flex align-items-start gap-3 mt-4" ><button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="removerow(' + rowcount + ')">Less</button></div></div></div><div class="eqress"></div></div></div>';

        $('#addnew').append(html);
     
    }

    function removerow(product) {
        $('#addnew' + product).remove();
    }
</script>

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
                    url: "{{ url('sale/importexcel') }} ",
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
    </script>



</body>

</html>