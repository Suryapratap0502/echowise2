@include('include/header')
<meta name="csrf-token" content="{{ csrf_token()}}" />
<style>
    #alert {
        display: none;
    }

    #export_btn {
        display: none;
    }
</style>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <!-- profile header start -->
        <div class="user-profile user-card mb-4">
            <div class="card-header border-0 p-0 pb-0">
                <div class="cover-img-block">
                    <!-- <img src="assets/images/profile/cover.jpg" alt="" class="img-fluid"> -->
                    <div class="overlay"></div>
                    <div class="change-cover">
                        <div class="dropdown">
                            <a class="drp-icon dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon feather icon-camera"></i></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud me-2"></i>upload new</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-image me-2"></i>from photos</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-film me-2"></i> upload video</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-trash-2 me-2"></i>remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-0">
                <div class="user-about-block m-0">
                    <div class="row">
                        <div class="col-md-4 text-center mt-n5">
                            <div class="change-profile text-center">
                                <div class="dropdown w-auto d-inline-block">
                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="profile-dp">
                                            <div class="position-relative d-inline-block">
                                                <img class="img-radius img-fluid wid-100" src="{{asset('uploads/staff/'.$user_details->staff_image)}}" alt="User image">
                                            </div>
                                            <!-- <div class="overlay">
												<span>change</span>
											</div> -->
                                        </div>
                                        <div class="certificated-badge">
                                            <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                            <i class="fas fa-check front-icon text-white"></i>
                                        </div>
                                    </a>
                                    <!-- <div class="dropdown-menu">
									 <input type="file" name="image" id="image">
									</div> -->
                                </div>
                            </div>
                            <h5 class="mb-1">{{ $user_details->role_name->role}}</h5>
                            <p class="mb-2 text-muted">{{ $user_details->name}}</p>
                        </div>
                        <div class="col-md-8 mt-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-globe me-2 f-18"></i>www.echowise.com</a>
                                    <div class="clearfix"></div>
                                    <a href="mailto:demo@domain.com" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail me-2 f-18"></i>{{ $user_details->email}}</a>
                                    <div class="clearfix"></div>
                                    <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone me-2 f-18"></i>{{ $user_details->mobile_no}}</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <i class="feather icon-map-pin me-2 mt-1 f-18"></i>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 text-muted">Keshavpuram</p>
                                            <p class="mb-0 text-muted">New Delhi</p>
                                            <p class="mb-0 text-muted">112233</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-reset active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-home me-2"></i>Profile Details</a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profile header end -->

        <!-- profile body start -->
        <div class="row">
            <div class="col-md-12 order-md-2">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Personal details</h5>
                                @if(checkaccess('7', 'write_per','inner'))
                                <button type="button" class="btn btn-eco btn-sm rounded m-0 float-end" onclick="get_data_edit('{{ $user_details->id}}')" data-bs-toggle="collapse" data-bs-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                    <i class="feather icon-edit"></i>
                                </button>
                                @endif
                            </div>
                            <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                                <form>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                        <div class="col-sm-9">
                                            {{ $user_details->name}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
                                        <div class="col-sm-9">
                                            {{ $user_details->email}}
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Contact</label>
                                        <div class="col-sm-9">
                                            {{ $user_details->mobile_no}}
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-body border-top pro-det-edit collapse fetch_for_edit" id="pro-det-edit-2">

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Change Password</h5>
                            </div>
                            <div class="card-body border-top pro-wrk-edit collapse show" id="pro-wrk-edit-1">
                                <form id="change_password" method="post">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="old_pass" placeholder="Old Password">
                                            <span id="old_pass_error" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="new_pass" placeholder="New Password">
                                            <span id="new_pass_error" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="confirm_pass" placeholder="Conform Password">
                                            <span id="confirm_pass_error" class="error"></span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="hidden_id" name="hidden_id" value="{{ $user_details->id}}">
                                    <div class="form-group row align-items-center mt-2">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-eco">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
        <!-- profile body end -->
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
    $(document).on('submit', '#add_hsn_code', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('vehicle_list/add_vehicle') }} ",
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

                    } else if (result.code == 400) {
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