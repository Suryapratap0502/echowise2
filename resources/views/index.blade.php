<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ecowise Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Ecowise Admin Panel" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<style>
    .error {
        color: red;
    }
    #error_toast{
        display: none;
    }
</style>
<body style="overflow:hidden;">
<div class="row ">
    <!-- <div class="flex-grow-1"> -->

        <div class="auth-wrapper offline aut-bg-img" >

                
            <!-- <div class="h-100 d-md-flex align-items-center auth-side-img"> -->
            <div class="row">
                <img src="assets/images/maintance/sparcle-1.png" alt="User-Image" class="img-fluid s-img-1">
                <img src="assets/images/maintance/sparcle-2.png" alt="User-Image" class="img-fluid s-img-2">
                <div class="container off-main">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="text-center">
                                
                                <div class="moon"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 justify-content-center off-content">
                        
                        <div class="sark">
                            <img src="assets/images/maintance/sark.svg" alt="" class="img-fluid img-sark">
                            <div class="bubble"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 auth-content w-auto">
                    <img src="assets/images/logo.png" alt="" style="width: 150px;">
                    <h1 class="text-white my-4">Welcome Back!</h1>
                    <h4 class="text-white font-weight-normal">Login to your account and explore the Ecowise Admin Panel.</h4>
                </div>
            <!-- </div> -->
            <!-- <div class="offline-wrapper"> -->
                <!-- form start -->
                <div class="col-md-4" style="margin-left: 75px;">
                    <div class="card" style="box-shadow: 0px 0px 25px -1px rgb(15 23 26);background-color: #6f859b;">

                        <div class=" auth-content">
                            <form id="login" method="post">
                                @csrf()
                                <img src="{{ asset('assets/images/nav-bg/body-bg-4.jpg')}}" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                                <h3 class="mb-4 f-w-400 text-light">Welcome Back!</h3>

                                <div class="form-group ">
                                    <label class="form-label mb-2 text-light" for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="">
                                    <span id="email_error" class="error"></span>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label mb-2 text-light" for="Password">Password</label>
                                    <input type="password" class="form-control" id="Password" name="password" placeholder="">
                                    <span id="password_error" class="error"></span>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-block btn-eco mb-4">Login</button>
                                </div>
                                <div class="toast text-white bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true" id="error_toast">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            <span id="err_resp"></span>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                    </div>
                </div>
                <!-- form end -->
                
                

                

            </div>

                <!-- <svg width="100%" height="70%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
                    <defs></defs>
                    <path id="feel-the-wave" d="" />
                </svg>
                <svg width="100%" height="70%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
                    <defs></defs>
                    <path id="feel-the-wave-two" d="" />
                </svg> -->
            <!-- </div> -->
        </div>

    <!-- </div> -->
</div>

<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).on('submit', '#login', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        if (error == false) {
            $.ajax({
                url: "{{ url('login') }} ",
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
                        window.location.href = "{{ url('dashboard') }}";
                    } else if (result.code == 401) {
                        $.each(result.message, function(prefix, val) {
                            $('#' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#error_toast').css('display','block');
                        setTimeout(function() {
                            $('#error_toast').css('display','none');
                        }, 5000);
                        $("#err_resp").text(result.message);
                        
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