<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Research Projects & Surveys - CATI, CAWI and CAPI Management System">
    <meta name="author" content="Kenneth Kipchumba">
    <meta name="author" content="Kipchumba.Kenneth@ymail.com">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        TIFA Surveys
    </title>

    <meta name="theme-color" content="#ffffff">

    @if (request()->segment(1) === 'analytics')
        @include('layouts.analytics-resources')
    @else
        @include('layouts.survey-js')
    @endif


    @inertiaHead

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('assets/core-ui/css/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/core-ui/css/style.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/core-ui/css/coreui.min.css') }}"> -->

    <!-- Toastify CSS (For Notifications) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastify/toastify.min.css') }}">
    <!-- End Toastify CSS (For Notifications) -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- End jQuery -->

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- End Select2 -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('favicon.jpeg') }}" />
    <!-- End Favicon -->

</head>

<body>
    @inertia
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('layouts.header')

        <noscript>
            <div class=" alert alert-warning mt-2 text-center">
                <div class="row">
                    <div class="col">
                        <strong>
                            Javascript needs to be enabled for this system to function properly. If your current browser
                            does not support JavaScript, you can use one of these instead:
                        </strong>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="https://www.mozilla.org/en-US/firefox/all/#product-desktop-release"
                                    target="_blank" title="Firefox Browser">
                                    <img src="{{ asset('assets/images/firefox-icon.png') }}" alt="Mozilla Firefox"
                                        height="30px" width="30px">
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://brave.com/download/" target="_blank" title="Brave Browser">
                                    <img src="{{ asset('assets/images/brave_browser_logo_icon.png') }}"
                                        alt="Brave Browser" height="30px" width="30px">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </noscript>

        @yield('content')

        @include('layouts.footer')
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('assets/core-ui/js/coreui.bundle.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/core-ui/js/simplebar.min.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('assets/core-ui/js/coreui-utils.js') }}" type="de208106593c1661e843c327-text/javascript"></script>

    <!-- <script src="js/main.js" type="de208106593c1661e843c327-text/javascript"></script>
    <script type="de208106593c1661e843c327-text/javascript">
    </script> -->

    <!-- Fontawesome Kit -->
    <script src="{{ asset('assets/fontawesome/kit.js') }}" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/core-ui/js/rocket-loader.min.js') }}" data-cf-settings="de208106593c1661e843c327-|49"
        defer=""></script>

    <!-- Toastify Js (For Notifications) -->
    <script type="text/javascript" src="{{ asset('assets/toastify/toastify-js') }}" defer></script>

</body>

</html>
