<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bundle.css') }} " type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/daterangepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/vmap/jqvmap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }} " type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }} " type="text/css">
</head>

<body>
    <!-- <div class="page-loader">
        <div class="spinner-border"></div>
        <span>Loading</span>
    </div> -->
    <div class="side-menu">
        <div class='side-menu-body'>
            <ul>
                <li class="side-menu-divider m-t-0"></li>
                <li>
                    <a href="{{ url('dashboard')}}">
                        <i class="icon fa fa-globe"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('users')}}">
                        <i class="icon fa fa-user-circle-o"></i>
                        <span>Access Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('projects')}}">
                        <i class="icon ti-crown"></i>
                        <span>Projects</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="header-logo">
                <a href="#">
                    <img class="d-none d-lg-block" src="{{ asset('assets/media/image/logo.png') }}" alt="...">
                    <img class="d-lg-none d-sm-block" src="{{ asset('assets/media/image/logo.png') }}" alt="...">
                </a>
            </div>
            <div class="header-body">
                <form class="search">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="fa fa-user-o"></i>
                            <span>{{ getuserdetail('name') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-big"> 
                            <div class="dropdown-menu-title text-center" data-backround-image="{{ asset('admin/media/image/image1.png') }}">
                                <figure class="avatar avatar-state-success avatar-sm m-b-10 bring-forward">
                                    <img src="{{ asset('admin/media/image/avatar.jpg')}}" class="rounded-circle" alt="image">
                                    
                                </figure>
                                <h6 class="text-uppercase font-size-12 m-b-0">Kenneth Hune</h6>
                            </div>
                            <div class="dropdown-menu-body">
                                <div class="bg-light p-t-b-15 p-l-r-20">
                                    <h6 class="text-uppercase font-size-11">Profile completion</h6>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <a href="#" class="list-group-item link-2">Profile</a>
                                    <a href="#" class="list-group-item link-2 d-flex">Followers <span class="text-muted ml-auto">214</span></a>
                                    <a href="#" class="list-group-item link-2 sidebar-open" data-sidebar-target="#settings">Settings</a>
                                    <a href="#" class="list-group-item text-danger">Logout</a>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-lg-none d-sm-block">
                        <a href="#" class="nav-link side-menu-open">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main-content">
        <div class="container-fluid">

            @section('content')
            @show()

        </div>
    </main>

    <script src="{{ asset('assets/vendors/bundle.js') }}"></script>

    <script src="{{ asset('assets/vendors/charts/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/charts/sparkline/sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/examples/charts.js') }}"></script>

    <script src="{{ asset('assets/vendors/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/examples/dashboard.js') }}"></script>

    <script src="{{ asset('assets/vendors/vmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/vmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/js/examples/vmap.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/borderless.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>