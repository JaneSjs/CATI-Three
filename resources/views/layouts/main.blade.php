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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>
      Cati 3.0
    </title>
    
    <meta name="theme-color" content="#ffffff">

     <!-- SurveyJs Resources -->
    <script type="text/javascript" src="{{ asset('assets/survey_js/resources/knockout-latest.js') }}"></script>

    <!-- Default V2 theme -->
    <link href="{{ asset('assets/survey_js/resources/defaultV2.min.css') }}" type="text/css" rel="stylesheet">

    <!-- Modern theme -->
    <!-- <link href="https://unpkg.com/survey-knockout/modern.min.css" type="text/css" rel="stylesheet"> -->

    <script type="text/javascript" src="{{ asset('assets/survey_js/resources/survey.core.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/survey_js/resources/survey-knockout-ui.min.js') }}"></script>
    
    <!-- End SurveyJs Resources -->


    @if(request()->is('results/*'))
      @include('layouts.analytics-resources')
    @endif

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('assets/core-ui/css/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/core-ui/css/style.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/core-ui/css/coreui.min.css') }}"> -->

    <!-- Toastify CSS (For Notifications) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- End Toastify CSS (For Notifications) -->
    
  </head>
  <body>
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <noscript>
        <div class=" alert alert-warning mt-2 text-center">
          <div class="row">
            <div class="col">
              <strong>
                Javascript needs to be enabled for this system to function properly. If your current browser does not support JavaScript, you can use one of these instead:
              </strong>
            </div>
            <div class="col">
              <ul class="list-group">
                <li class="list-group-item">
                  <a href="https://www.mozilla.org/en-US/firefox/all/#product-desktop-release" target="_blank" title="Firefox Browser">
                    <img src="{{ asset('assets/images/firefox-icon.png') }}" alt="Firefox Browser" height="30px" width="30px">
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="https://www.google.com/chrome/" target="_blank" title="Google Chrome">
                    <img src="{{ asset('assets/images/google-chrome.png') }}" alt="Google Chrome" height="30px" width="30px">
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
    <script src="{{ asset('assets/core-ui/js/coreui.bundle.min.js') }}" 
     crossorigin="anonymous"></script>

    <script src="{{ asset('assets/core-ui/js/simplebar.min.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('assets/core-ui/js/coreui-utils.js') }}" type="de208106593c1661e843c327-text/javascript"></script>
    
    <!-- <script src="js/main.js" type="de208106593c1661e843c327-text/javascript"></script>
    <script type="de208106593c1661e843c327-text/javascript">
    </script> -->

    <!-- Fontawesome Kit -->
    <!-- Create code to check internet availability before trying to link to load fontawesome kit -->
    <script>
      if(navigator.onLine) {
        var script = document.createElement('script');
        script.src = 'https://kit.fontawesome.com/63b4fcb6d3.js';
        script.crossOrigin = 'anonymous';

        document.body.appendChild(script);
        console.log("Internet Connection is available. Font Awesome kit loaded.");
      } else {
        console.log("No Internet Connection Available");
      }
    </script>
    <!-- <script src="https://kit.fontawesome.com/63b4fcb6d3.js" crossorigin="anonymous"></script> -->

    <script src="{{ asset('assets/core-ui/js/rocket-loader.min.js') }}" data-cf-settings="de208106593c1661e843c327-|49" defer=""></script>

    <!-- Toastify Js (For Notifications) -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js" defer></script>
    
  </body>
</html>