function filter(page) {
    if (page == 'expense') {
        url = 'filter/expense';
    } else if (page == 'sale') {
        url = 'filter/sale';
    } else if (page == 'rental') {
        url = 'filter/rental';
    } else if (page == 'cash_report_filter') {
        url = 'filter/cash_filter';
    } else if (page == 'transport') {
        url = 'filter/transport';
    }
    var startdate = $('#startdate').val();
    var enddate = $('#enddate').val();
    var itemname = $('#itemname').val();
    $.ajax({
        url: base_url + url,
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            startdate: startdate,
            enddate: enddate,
            itemname: itemname
        },
        success: function(response) {

            $("#pay_list").html(response);
        }
    })
}