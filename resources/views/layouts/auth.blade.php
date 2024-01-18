<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
      TIFA Surveys
    </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/core-ui/css/coreui.min.css') }}">

    <!--Favicon-->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('favicon.jpeg') }}"/>
  </head>
  <body class="bg-warning">
    @yield('content')

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
    <script src="{{ asset('assets/core-ui/js/coreui.bundle.min.js') }}"></script>

    <!-- Fontawesome Kit -->
    <!-- Check internet availability before trying to load fontawesome kit -->
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
  </body>
</html>