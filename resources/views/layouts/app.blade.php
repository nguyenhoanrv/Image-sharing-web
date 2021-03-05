<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel')}} @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <meta charset="utf-8" />
    <title>Calendar | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/tui-time-picker/tui-time-picker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/tui-date-picker/tui-date-picker.min.css')}}">
    <link href="{{asset('assets/libs/tui-calendar/tui-calendar.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Styles -->
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    @yield('css')
</head>
<script>
    window.userId = {{ auth() -> user() -> id }}
</script>

<body data-topbar="dark" data-layout="horizontal" data-layout-size="boxed">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">

                        <a href="{{route('home')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/logo-light.svg')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                        data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>


                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Search input">

                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="{{asset('assets/images/flags/us.jpg')}}"
                                alt="Header Language" height="16">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                                <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-1"
                                    height="12">
                                <span class="align-middle">English</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                <img src="{{asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="me-1"
                                    height="12">
                                <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1"
                                    height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                <img src="{{asset('assets/images/flags/italy.jpg')}}" alt="user-image" class="me-1"
                                    height="12">
                                <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                <img src="{{asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-1"
                                    height="12">
                                <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div>



                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>
                    <div id="notifications">
                        <notification-component></notification-component>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{Storage::url(Auth::user()->avatar)}}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name
                                }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('profile', ['id' => auth()->user()->id]) }}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">Profile</span>
                                <a class="dropdown-item d-block" href="#"><span
                                        class="badge bg-success float-end">11</span><i
                                        class="bx bx-wrench font-size-16 align-middle me-1"></i> <span
                                        key="t-settings">Settings</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    <span key="t-logout">Logout</span>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a href="{{route('album')}}" class="nav-link" role="button">
                                    <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">Dashboards</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="topnav-more" role="button">
                                    <i class="bx bx-collection me-2"></i><span key="t-components">Categories</span>
                                    <div class="arrow-down"></div>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    @foreach(\App\Category::all() as $category)
                                    <a class="dropdown-item" href="{{ route('category', ['id'=> $category->id]) }}"
                                        key="t-{{$category->id}}">{{$category->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid" id="app">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    @yield('js')
    {{--
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script> --}}
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script type="text/javascript">

    </script>
</body>

</html>