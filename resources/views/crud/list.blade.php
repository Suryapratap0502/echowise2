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
                            <h5 class="m-b-10">Crud Master</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Crud Master</a></li>
                            <li class="breadcrumb-item"><a href="#">List</a></li>
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
                            <div class="col-sm-6 text-end mb-2">
                                <button class="btn btn-success btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Add New</button>
                            </div>
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
                <h5 class="modal-title">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_crud_data" method="post">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Table Name</label>
                                <input type="text" class="form-control" id="table_name" placeholder="Enter Table Name" name="table_name" data-table="employee">
                                <span id="table_name_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Emp Name</label>
                                <input type="text" class="form-control" id="emp_name" placeholder="Enter Employee Name" name="emp_name" data-coloumn="emp_name">
                                <span id="emp_name_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Emp Email</label>
                                <input type="email" class="form-control" id="emp_email" placeholder="Enter Employee Email" name="emp_email" data-coloumn1="emp_email">
                                <span id="emp_email_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Emp Password</label>
                                <input type="password" class="form-control" id="emp_password" placeholder="Enter Employee Password" name="emp_password" data-coloumn2="emp_password">
                                <span id="emp_password_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Emp Contact</label>
                                <input type="number" class="form-control" id="emp_contact" placeholder="Enter Employee Contact" name="emp_contact" data-coloumn3="emp_contact">
                                <span id="emp_contact_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">Emp Address</label>
                                <textarea class="form-control" id="emp_address" placeholder="Enter Employee Address" name="emp_address" data-coloumn4="emp_address"></textarea>
                                <span id="emp_address_error" class="error"></span>
                            </div>
                        </div>
                        </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Save">
                        <button class="btn btn-danger"> Clear </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="edit_hsn" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit HSN Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_hsn_data" method="post" enctype="multipart/form-data">

                    <div id="edithsndiv"></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary submitbtn"> Save </button>
                <button class="btn btn-danger"> Clear </button>
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
<script src="{{ asset('assets/js/menu-setting.min.js') }}"></script>
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
    $(document).on('submit', '#add_crud_data', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        var table_name = $('#table_name').data('table');
        var coloumn_name = $('#emp_name').data('coloumn');
        var coloumn_name1 = $('#emp_email').data('coloumn1');
        var coloumn_name2 = $('#emp_password').data('coloumn2');
        var coloumn_name3 = $('#emp_contact').data('coloumn3');
        var coloumn_name4 = $('#emp_address').data('coloumn4');

        formData.append('table_name', table_name);
        formData.append('coloumn_name', coloumn_name);
        formData.append('coloumn_name1', coloumn_name1);
        formData.append('coloumn_name2', coloumn_name2);
        formData.append('coloumn_name3', coloumn_name3);
        formData.append('coloumn_name4', coloumn_name4);

        if (error == false) {
            $.ajax({
                url: "{{ url('list/add') }} ",
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
                        getpaylist(uri_value);

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