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
                            <h5 class="m-b-10">Product</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                            @if(checkaccess('2', 'write_per','inner'))
                            <div class="col-sm-6 text-end mb-2">
                                <button class="btn btn-eco btn-sm btn-round has-ripple" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Add Product</button>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="add_products" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="code">Product Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{$code}}" readonly>
                                <span id="code_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="cat_id">Category</label>
                                <select class="form-select" name="cat_id" id="cat_id" onchange="getsubcat(this.value);">
                                    <option>Select</option>
                                    @if(!empty($category))
                                    @foreach($category as $value)
                                    <option value="{{ $value->id}}">{{ $value->category }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="cat_id_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="sub_cat_id">Sub Category</label>
                                <select class="form-select subcategory" name="sub_cat_id" id="sub_cat_id" onchange="getsubsubcat(this.value);">
                                <option>Select</option>   
                                </select>
                                <span id="sub_cat_id_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="sub_sub_cat_id">Sub Sub Category</label>
                                <select class="form-select subsubcat" name="sub_sub_cat_id" id="sub_sub_cat_id">
                                    <option>Select</option>
                                </select>
                                <span id="sub_sub_cat_id_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="Code">Product Name</label>
                                <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Product Name">
                                <span id="p_name_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="hsn">HSN Code</label>
                                <select class="form-select" name="hsn" id="hsn">
                                    <option value="" selected>Select</option>
                                    <option value="hsn1">HSN1</option>
                                </select>
                                <span id="hsn_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="p_unit">Product Unit</label>
                                <select class="form-select" name="p_unit" id="p_unit">
                                    <option value="" selected>Select</option>
                                    <option value="kg">kg</option>
                                </select>
                                <span id="p_unit_error" class="error"></span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="p_size">Product Size</label>
                                <input type="text" class="form-control" id="p_size" name="p_size" placeholder="Product Size">
                                <span id="p_size_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="p_quanity">Product Quantity</label>
                                <input type="number" class="form-control" id="p_quanity" name="p_quanity" placeholder="Product Quantity">
                                <span id="p_quantity_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="form-label" for="image">Select Image</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="">
                                <span id="image_error" class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label " for="p_desc">Product Discription</label>
                                <textarea type="text" class="form-control" id="p_desc" name="p_desc" placeholder="Product Description"></textarea>
                                <span id="p_desc_error" class="error"></span>
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

<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_product_data" method="post" enctype="multipart/form-data">

                    <div id="editproductdiv"></div>

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
    $(document).on('submit', '#add_products', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{url('product/add_product')}} ",
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