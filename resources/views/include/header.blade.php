<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ecowise Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <!-- <meta name="author" content="Phoenixcoded" /> -->
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }} " type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

</head>

<body class="background-img-4">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">
                <div class="">
                    <div class="main-menu-header">
                        @if(getuserdetail('role') == 1)
                        <img class="img-radius_1" src="{{ asset('assets/images/logo.png') }}" alt="User-Profile-Image">
                        @else
                        <img class="img-radius" src="{{ asset('uploads/staff/'.getuserdetail('image')) }}" alt="User-Profile-Image">
                        @endif
                        <div class="user-details">
                            <div id="more-details">{{ getuserdetail('name')}}<i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-inline">

                            <li class="list-inline-item"><a href="{{ url('logout') }} " data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav pcoded-inner-navbar ">
                    @php $main_arr = getsidebar(); @endphp
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    @php if(!empty($main_arr)) { foreach($main_arr as $values) { @endphp

                    <li class="nav-item @if(!empty($values['innermenu'])) {{ 'pcoded-hasmenu' }} @endif">

                        @if(!empty($values['innermenu']))
                        <a href="#" class="nav-link "><span class="pcoded-micon">{!! $values['icon'] !!}</span><span class="pcoded-mtext">{{ $values['menu']}}</span></a>
                        @else
                        <a href="{{ url($values['slug']) }}" class="nav-link "><span class="pcoded-micon">{!! $values['icon'] !!}</span><span class="pcoded-mtext">{{ $values['menu']}}</span></a>
                        @endif
                        @if(!empty($values['innermenu']))
                        <ul class="pcoded-submenu">
                            @foreach($values['innermenu'] as $innerval)

                            <li><a href="{{ url($innerval['slug']) }}">{{ $innerval['inner_menu']}}</a></li>

                            @endforeach

                        </ul>
                        @endif
                    </li>

                    @php } } @endphp
                </ul>

            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-end notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-end">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="d-flex">
                                        <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="flex-grow-1">
                                            <p><strong>Dummy</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New Sales Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>

                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('assets/images/logo.png') }}" class="img-radius" alt="User-Profile-Image">
                                <span>{{ getuserdetail('name')}}</span>
                                <a href="{{ url('logout') }}" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="{{ url('settings') }}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>

                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->