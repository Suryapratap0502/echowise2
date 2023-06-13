@include('include/header')
<meta name="csrf-token" content="{{ csrf_token()}}" />
<style>
    #alert {
        display: none;
    }
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Access Management</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-settings"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Access Management</a></li>
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
            <strong id="response"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <input type="hidden" name="uri_value" id="uri_value" value="{{ request()->segment(1) }}">

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <!-- liveline-section start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row align-items-center m-l-0">
                            <div class="col-sm-6 text-start">
                                <h5>User Management</h5>
                            </div>

                            @if(checkaccess('1', 'write_per','inner'))
                            <div class="col-sm-6 text-end">
                                <button type="button" class="btn btn-eco btn-sm" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i>New User</button>
                            </div>
                            @endif

                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item border-right m-0 "><a class="pe-2 ps-1 text-muted"> Sorting Options </a></li>
                            <li class="list-inline-item border-right m-0"><a href="#!" class="pe-2 ps-1 font-weight-bolder" onclick="get_all_user()"> All </a></li>
                            @if(!empty($user_data))
                            @foreach($user_data as $value)
                            <li class="list-inline-item border-right m-0"><a href="#!" class="pe-2 ps-1 text-muted" onclick="filter_role('{{ $value->roles->id}}');">{{ $value->roles->role}} </a></li>
                            @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" id="pay_list">

            </div>

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_user" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                                <span id="name_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                <span id="email_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="password" placeholder="Enter Password">
                                <span id="password_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Contact">Contact</label>
                                <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact">
                                <span id="contact_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Select Image</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="">
                                <span id="image_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="Name">Select Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option value="" selected>Select</option>
                                    @if(!empty($roles))
                                    @foreach($roles as $value)
                                    <option value="{{ $value->id}}">{{ $value->role }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="role_error" class="error"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div id="permission" class="col-lg-12">
                            <div class="mb-3">
                                <div class="tshadow mb25 bozero">
                                    <hr>
                                    <h5 class="modal-title" style="color:red;">Select Module & Permission</h5>
                                    <hr>
                                    <div class="around10">

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-sx-4"><b>Module</b></div>
                                            <div class="col-md-4 col-sm-2 col-sx-2 text-center"><b>Read</b></div>
                                            <div class="col-md-4 col-sm-2 col-sx-2 text-center"><b>Write</b></div>
                                        </div>

                                        @if(!empty($modulelistdetails))
                                        @foreach($modulelistdetails as $value)
                                        @php $innermenu = App\Models\SidebarInnerMenu::where('navigation_id',$value->id)->get(); @endphp
                                        <div style="border: 1px solid black; margin-top: 20px; padding: 10px">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-sx-4">
                                                    <b>{{ $value->menu }}</b> -
                                                    <input type="hidden" name="sidebar_name[]" value="{{ $value->id }}">
                                                </div>

                                                @if(count($innermenu) == 0)
                                                <div class="col-md-4 col-sm-2 col-sx-2 text-center can_add">
                                                    <input type="checkbox" name="read[]" id="mainread_{{ $value->id }}" value="{{ $value->id }}">
                                                </div>
                                                <div class="col-md-4 col-sm-2 col-sx-2 text-center can_view">
                                                    <input type="checkbox" name="write[]" id="mainwrite_{{ $value->id }}" onclick="permission('{{ $value->id }}','main')" value="{{ $value->id }}">
                                                </div>
                                                @endif
                                            </div>
                                            @if(!empty($innermenu))
                                            @foreach ($innermenu as $value_inner)
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-sx-4">
                                                    &nbsp;&#x2022; {{ $value_inner->inner_menu }}
                                                    <input type="hidden" name="sidebar_inner_name[]" value="{{ $value_inner->id }}">
                                                </div>
                                                <div class="col-md-4 col-sm-2 col-sx-2 text-center can_add">
                                                    <input type="checkbox" name="sidebar_inner_read_id[]" id="innerread_{{$value_inner->id}}" value="{{ $value_inner->id }}">
                                                </div>
                                                <div class="col-md-4 col-sm-2 col-sx-2 text-center can_view">
                                                    <input type="checkbox" name="s[]" id="innerwrite_{{$value_inner->id}}" onclick="permission('{{$value_inner->id}}','inner')" value="{{ $value_inner->id }}">
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        @endforeach
                                        @endif

                                        <script>
                                            function permission(id, nav) {
                                                if ($("#" + nav + "write_" + id).is(':checked')) {
                                                    console.log(id);
                                                    $("#" + nav + "read_" + id).attr("checked", "checked");
                                                }
                                            }
                                        </script>

                                    </div>
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

<div class="modal fade" id="edit_data" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_user" method="post" enctype="multipart/form-data">

                    <div id="editstaffdiv"></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-eco submitbtn"> Save </button>
                <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Close">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- change password -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="update_password" method="post">

                    <div id="changepassstaffdiv"></div>

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


<script>
    // getuser();
    var uri_value = $('#uri_value').val();
    getpaylist(uri_value);
    $(document).on('submit', '#add_user', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('add_user') }} ",
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
                        $('#add_user')[0].reset();
                        getpaylist(uri_value);
                    } else if (result.code == 404) {
                        swal(result.message, {
                            icon: "success",
                        });
                        getpaylist(uri_value);
                    } else if (result.code == 402) {
                        $('#modal-report').modal('show');
                        $('#email_error').html(result.message);
                        $('.error').css('color', 'red');
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
    function open_edit_model(id) {
        $.ajax({
            url: "{{url('show_edit_user') }}",
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function(response) {

                $('#editstaffdiv').html(response);
            }
        })
    }
</script>
<script type="text/javascript">
    $(document).on('submit', '#edit_user', function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ url('update_user') }}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(result) {
                if (result.code == 200) {
                    $('#edit_data').modal('hide');
                    swal(result.message, {
                        icon: "success",
                    });
                    getpaylist(uri_value);
                } else if (result.code == 400) {
                    alert(result.message);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        })
    })
</script>

<!-- change password -->

<script type="text/javascript">
    $(document).on('submit', '#update_password', function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ url('update_password') }}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(result) {
                if (result.code == 200) {
                    $('#change_password').modal('hide');
                    swal(result.message, {
                        icon: "success",
                    });
                    getpaylist(uri_value);
                } else if (result.code == 401) {
                    $('#change_password').modal('show');
                    $.each(result.message, function(prefix, val) {
                        $('#' + prefix + '_error').text(val[0]);
                    });
                    $('.error').css('color', 'red');
                } else if(result.code == 400)
                {
                    $('#change_password').modal('show');
                    swal(result.message, {
                        icon: "error",
                    });
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        })
    })
</script>

</body>

</html>