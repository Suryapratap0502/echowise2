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
                            <h5 class="m-b-10">Client Master</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Master</a></li>
                            <li class="breadcrumb-item"><a href="#">Client Master</a></li>
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
                            <div class="col-sm-6">
                            </div>
                            @if(checkaccess('8', 'write_per','inner'))
                            <div class="col-sm-6 text-end mb-2">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Add New Client</button>
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
                <h5 class="modal-title">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_client" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                <span id="name_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                <span id="email_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Contact</label>
                                <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact No.">
                                <span id="contact_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">State</label>
                                <select class="form-select" name="state" id="state" require>
                                    <option>Select</option>
                                    @if(!empty($state))
                                    @foreach($state as $value)
                                    <option value="{{ $value->id}}">{{ $value->state_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="state_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location">
                                <span id="location_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">PAN No.</label>
                                <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN No.">
                                <span id="pan_error" class="error"></span>
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

<div class="modal fade" id="edit_client" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_client_data" method="post">

                    <div id="editclient"></div>

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
    $(document).on('submit', '#add_client', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        var panVal = $('#pan').val();
        var regpan = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
        if (!regpan.test(panVal)) {
            $('#pan_error').html('Enter Valid PAN No.');
            $('.error').css('color','red');
            error = true;
        } else
        {
            $('#pan_error').html('');
        }

    if (error == false) {
        $.ajax({
            url: "{{ url('client/add') }} ",
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
                    $('#add_client')[0].reset();

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



</body>

</html>