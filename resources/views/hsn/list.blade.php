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
                            <h5 class="m-b-10">HSN Master</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">HSN Management</a></li>
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
                            @if(checkaccess('4', 'write_per','main'))
                            <div class="col-sm-6 text-end mb-2">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Add HSN Code</button>
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
                <h5 class="modal-title">Add HSN Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_hsn_code" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="Name">HSN Code</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter HSN Code" name="name">
                                <span id="name_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                                <span id="description_error" class="error"></span>
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
    $(document).on('submit', '#add_hsn_code', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('hsn_management/add_hsn') }} ",
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