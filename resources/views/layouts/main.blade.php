<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Research Surveys Management System | CATI System">
    <meta name="author" content="Kenneth Kipchumba">
    <meta name="author" content="Kipchumba.Kenneth@ymail.com">
    <meta name="keyword" content="Laravel PHP Framework, SurveyJS Form Management Library, CoreUI Admin Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cati 3.0 </title>
    
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('assets/core-ui/css/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/core-ui/css/style.css') }}" rel="stylesheet">

    
    @if(request()->is('surveys/*'))
     <!-- ... -->
    <script type="text/javascript" src="https://unpkg.com/knockout/build/output/knockout-latest.js"></script>

    <!-- Default V2 theme -->
    <link href="https://unpkg.com/survey-knockout/defaultV2.min.css" type="text/css" rel="stylesheet">

    <!-- Modern theme -->
    <!-- <link href="https://unpkg.com/survey-knockout/modern.min.css" type="text/css" rel="stylesheet"> -->

    <script type="text/javascript" src="https://unpkg.com/survey-core/survey.core.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/survey-knockout-ui/survey-knockout-ui.min.js"></script>
    
    <!-- ... -->
    @endif
    
  </head>
  <body>
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      
        @yield('content')

      @include('layouts.footer')
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('assets/core-ui/js/coreui.bundle.min.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    <script src="{{ asset('assets/core-ui/js/simplebar.min.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('assets/core-ui/js/coreui-utils.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    
    <!-- <script src="js/main.js" type="de208106593c1661e843c327-text/javascript"></script>
    <script type="de208106593c1661e843c327-text/javascript">
    </script> -->

    <!-- Fontawesome Kit -->
    <!-- Create code to check internet availability before trying ti link to the fontawesome kit -->
    <script src="https://kit.fontawesome.com/63b4fcb6d3.js" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/core-ui/js/rocket-loader.min.js') }}" data-cf-settings="de208106593c1661e843c327-|49" defer=""></script>
    
  </body>
</html>