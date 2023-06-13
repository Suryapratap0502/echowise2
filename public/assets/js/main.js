var base_url = window.location.origin + "/";

function getpaylist(geturl) {
    if (geturl == 'cash_management') {
        mainurl = 'cash_management/fetch_pay_list';
    } else if (geturl == 'user') {
        mainurl = 'fetch_user';
    } else if (geturl == 'category') {
        mainurl = 'fetch_cat';
    } else if (geturl == 'sub_category') {
        mainurl = 'fetch_subcat';
    } else if (geturl == 'sub_sub_category') {
        mainurl = 'fetch_subsubcat';
    } else if (geturl == 'product') {
        mainurl = 'product/get_products';
    } else if (geturl == 'hsn_management') {
        mainurl = 'hsn_management/get_hsn';
    } else if (geturl == 'vehicle_list') {
        mainurl = 'vehicle_list/get_vehicle';
    } else if (geturl == 'sale') {
        mainurl = 'sale/get_data';
    } else if (geturl == 'client') {
        mainurl = 'client/get_data';
    } else if (geturl == 'service_type') {
        mainurl = 'service_type/get_data';
    } else if (geturl == 'expense_account') {
        mainurl = 'expense_account/get_data';
    } else if (geturl == 'cash_report') {
        mainurl = 'cash_report/get_data';
    } else if (geturl == 'site') {
        mainurl = 'site/get_data';
    } else if (geturl == 'rental_truck') {
        mainurl = 'rental_truck/get_data';
    } else if (geturl == 'transport_service') {
        mainurl = 'transport_service/get_data';
    } else if (geturl == 'google_login') {
        mainurl = 'google_login/login_page';
    }

    $.ajax({
        url: base_url + mainurl,
        type: 'get',
        cache: true,
        contentType: false,
        processData: false,
        success: function(result) {
            $("#pay_list").html(result);
        },
    })
}

function filter_role(id) {

    $.ajax({
        url: base_url + 'filter_user_data',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        success: function(result) {
            $("#pay_list").html(result);
        },
    })

}

function get_all_user() {
    $.ajax({
        url: base_url + 'filter_user_all_data',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            $("#pay_list").html(result);
        },
    })
}

function open_cat_edit(id) {
    $.ajax({
        url: base_url + 'show_edit_category',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editcategorydiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_category_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'update_category',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_category').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_category').modal('show');
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

function open_subcat_edit(id) {
    $.ajax({
        url: base_url + 'show_edit_subcategory',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editsubcategorydiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_subcategory_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'update_subcategory',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_subcategory').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_subcategory').modal('show');
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



function getsubcat(id) {
    $.ajax({
        url: base_url + 'getsubcat_with_cat_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res) {
            var result = JSON.parse(res);
            $(".subcategory").html(result.output);
        },
        error: function() {
            alert("Fail")
        }
    });
}

function getsubcat_1(id, num) {
    $.ajax({
        url: base_url + 'getsubcat_with_cat_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res) {
            var result = JSON.parse(res);
            $(".subcategory_" + num).html(result.output);
        },
        error: function() {
            alert("Fail")
        }
    });
}


function getsubcat2(id, subcategory) {
    $.ajax({
        url: base_url + 'getsubcat_with_cat_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res) {
            var result = JSON.parse(res);
            $(".subcategory").html(result.output);
            $('select[id="sub_cat2"] option[value="' + subcategory + '"]').attr("selected", "selected");
        },
        error: function() {
            alert("Fail")
        }
    });
}

function getsubsubcat(id) {
    $.ajax({
        url: base_url + 'getsubsubcat_with_subcat_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res) {
            var result = JSON.parse(res);
            $(".subsubcat").html(result.output);
        },
        error: function() {
            alert("Fail")
        }
    });
}


function open_sub_sub_cat_edit(id) {
    $.ajax({
        url: base_url + 'show_edit_subsubcategory',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editsubsubcategorydiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_sub_sub_category_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'update_sub_subcategory',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_subsubcategory').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_subsubcategory').modal('show');
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

function open_pay_edit(id) {
    $.ajax({
        url: base_url + 'cash_management/show_edit_pay_method',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editpaymethoddiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_pay_mode_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'cash_management/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_pay_mode').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_pay_mode').modal('show');
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

function delete_pay(id, name, table, status) {
    if (status == 'delete') {
        var keys = 'Deleted';
    } else if (status == 'Inactive') {
        var keys = 'Deactivate';
    } else if (status == 'Active') {
        var keys = 'Activate';
    }

    swal({
        title: "Are you sure?",
        text: keys + " " + name,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + 'common_action/change_status',
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    keys: keys,
                    table: table
                },
                success: function(result) {
                    if (result.code == 200) {
                        swal(result.message, {
                            icon: "success",
                        });
                        getpaylist();

                    } else {
                        swal(result.message, {
                            icon: "error",
                        });
                    }
                },

            });

        } else {
            swal("Cancelled", {
                icon: "error",
            });
        }
    });


}

function open_pro_edit(id) {
    $.ajax({
        url: base_url + 'product/show_edit_product',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editproductdiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_product_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'product/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_product').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_product').modal('show');
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

function open_hsn_edit(id) {
    $.ajax({
        url: base_url + 'hsn_management/show_edit_hsn',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edithsndiv').html(response);
        }
    })
}

$(document).on('submit', '#edit_hsn_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'hsn_management/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_hsn').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_hsn').modal('show');
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

function open_vehicle_edit(id) {
    $.ajax({
        url: base_url + 'vehicle_list/show_edit_vehicle',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editvehicaldiv').html(response);
        }
    })
}


$(document).on('submit', '#edit_vehical_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'vehicle_list/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_vehicle').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                $('#edit_vehicle').modal('show');
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

function allot_vehicle(id, v_id, v_no) {

    $.ajax({
        url: base_url + 'vehicle_list/allot_vehicle',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            v_id: v_id,
            v_no: v_no
        },
        success: function(result) {
            if (result.code == 200) {
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();

            } else if (result.code == 400) {
                swal(result.message, {
                    icon: "error",
                });
            }
        },

    })
}

function get_allotted_list() {
    $.ajax({
        url: base_url + 'vehicle_list/alloted_list',
        type: 'get',
        cache: true,
        contentType: false,
        processData: false,
        success: function(result) {
            $("#list_btn").css('display', 'none');
            $("#export_btn").css('display', 'block');
            $("#back_btn").css('display', 'block');
            $("#pay_list").html(result);
        },
    })
}

function get_data_edit(id) {
    $.ajax({
        url: base_url + 'settings/show_edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('.fetch_for_edit').html(response);
            $('#pro-det-edit-2').html(response);
        }
    })
}


$(document).on('submit', '#edit_setting', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'settings/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                swal(result.message, {
                    icon: "success",
                });
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else if (result.code == 400) {
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

$(document).on('submit', '#change_password', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'settings/change_password',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                swal(result.message, {
                    icon: "success",
                });

            } else if (result.code == 400) {
                swal(result.message, {
                    icon: "error",
                });
            } else if (result.code == 401) {
                swal(result.message, {
                    icon: "error",
                });
            } else if (result.code == 402) {
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

function open_sale_edit(id) {
    $.ajax({
        url: base_url + 'sale/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editsale').html(response);
        }
    })
}

$(document).on('submit', '#edit_sale_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'sale/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function open_client_edit(id) {
    $.ajax({
        url: base_url + 'client/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editclient').html(response);
        }
    })
}

$(document).on('submit', '#edit_client_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'client/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_client').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function open_ser_type_edit(id) {
    $.ajax({
        url: base_url + 'service_type/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edit_ser_type_model').html(response);
        }
    })
}

$(document).on('submit', '#edit_ser_type_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'service_type/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_ser_type').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function get_client_data(rowid, id) {
    $.ajax({
        url: base_url + 'client/fetch_data_cl_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {
            $('.pan_' + rowid).val(response.pan);
        }
    })
}


function open_expense_edit(id) {
    $.ajax({
        url: base_url + 'expense_account/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edit_expense_model').html(response);
        }
    })
}

$(document).on('submit', '#edit_expense_report', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'expense_account/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_expense').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function open_cashreport_edit(id) {
    $.ajax({
        url: base_url + 'cash_report/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edit_cash').html(response);
        }
    })
}
$(document).on('submit', '#edit_cashreport_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'cash_report/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_cash_report').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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


//chart script

$(function() {
    var options = {
        chart: {
            height: 350,
            type: 'bar',
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        colors: ["#4680ff", "#0e9e4a", "#ffba57", "#ff5252"],
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
            },
        },
        series: [{
            name: 'PRODUCT A',
            data: [44, 55, 41, 67, 22, 43]
        }, {
            name: 'PRODUCT B',
            data: [13, 23, 20, 8, 13, 27]
        }, {
            name: 'PRODUCT C',
            data: [11, 17, 15, 15, 21, 14]
        }, {
            name: 'PRODUCT D',
            data: [21, 7, 25, 13, 22, 8]
        }],
        xaxis: {
            type: 'datetime',
            categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
        },
        legend: {
            position: 'right',
            offsetY: 40
        },
        fill: {
            opacity: 1
        },
    }
    var chart = new ApexCharts(
        document.querySelector("#bar-chart-2"),
        options
    );
    chart.render();
});

function filter_data() {

    var start_date = $('#start_date').val();
    var pro_filter = $('#pro_filter').val();
    $.ajax({
        url: base_url + 'sale/filterdata',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            start_date: start_date,
            pro_filter: pro_filter
        },
        success: function(response) {

            $('#edit_cash').html(response);
        }
    })

}

function show_access(id) {

    var content = '<div class="spinner-border text-primary" role="status"><span class ="sr-only"> Loading... </span> </div>';
    $.ajax({
        url: base_url + 'get_access',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
        },
        beforeSend: function() {
            $(".data_hold").html(content);
        },
        success: function(response) {
            $('.sidedetails').html(response);
        }
    })

}

function open_site_edit(id) {
    $.ajax({
        url: base_url + 'site/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#editsite').html(response);
        }
    })
}

$(document).on('submit', '#edit_site_data', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'site/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_site').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function change_lable(id, val) {
    $.ajax({
        url: base_url + 'site/get_name',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('.sel_site' + val).html(response);
        }
    })
}

function cal_final_amt(val) {
    var booking_amt = $('#booking_amt' + val).val();
    var adv_amt = $('#adv_pay' + val).val();
    var final_amt = Math.round(Number(booking_amt - adv_amt));
    if (final_amt > 0) {
        $(".final_pay" + val).val(final_amt.toFixed(2));
        $('.final_pay' + val).attr('readonly', true);
    } else {
        $(".final_pay" + val).val(final_amt.toFixed(2));
        $('.final_pay' + val).attr('readonly', true);
        $('.final_pay_error' + val).html('Advance is grater than Booking');
        $('.error').css('color', 'red');
    }

}

function cat_weight_differ(val) {
    var weight_cl_site = $('#weight_cl_site' + val).val();
    var weight_sel_site = $('#weight_sel_site' + val).val();
    var weight_differ = Math.round(Number(weight_cl_site - weight_sel_site));
    if (weight_differ > 0) {
        $("#weight_differ" + val).val(weight_differ.toFixed(2));
        $('#weight_differ' + val).attr('readonly', true);
    } else {
        $("#weight_differ" + val).val(final_amt.toFixed(2));
        $('#weight_differ' + val).attr('readonly', true);
        $('#weight_differ_error' + val).html('Client KG is grater than Site KG');
        $('.error').css('color', 'red');
    }
}

function open_rental_truck_edit(id) {
    $.ajax({
        url: base_url + 'rental_truck/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edit_rental_truck_model').html(response);
        }
    })
}

$(document).on('submit', '#edit_rental_truck_report', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'rental_truck/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_rental_truck').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function open_transport_edit(id) {
    $.ajax({
        url: base_url + 'transport_service/edit',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#edit_transport_model').html(response);
        }
    })
}

$(document).on('submit', '#edit_transport_report', function(ev) {
    ev.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: base_url + 'transport_service/update',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(result) {
            if (result.code == 200) {
                $('#edit_transport').modal('hide');
                swal(result.message, {
                    icon: "success",
                });
                getpaylist();
            } else if (result.code == 400) {
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

function get_vehicle_data(id, rowid) {
    $.ajax({
        url: base_url + 'vehicle_list/get_data_with_id',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('.vehicle_size_' + rowid).val(response.size);
            $('.vehicle_size_' + rowid).attr('readonly', true);
            $('.vehicle_capacity_' + rowid).val(response.capacity);
            $('.vehicle_capacity_' + rowid).attr('readonly', true);
        }
    })
}

function open_change_password(id) {
    $.ajax({
        url: base_url + 'change_password',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(response) {

            $('#changepassstaffdiv').html(response);
        }
    })
}

function get_ser_cat(id) {
    $.ajax({
        url: base_url + 'get_cat_with_service_type',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res) {
            var result = JSON.parse(res);
            $(".service_category").html(result.output);
        },
        error: function() {
            alert("Fail")
        }
    });
}