<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analytics</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>


<body>

   
    <div class="container">
        <h3 class="text-info text-center">
            {{-- Survey Results Analytics --}}
        </h3>

        @php
            // dd( json_encode($survey->toArray()))
            $survey = $survey->content;
            // dd(json_encode($results));
        @endphp

        <div id="app">
            <dashboard :survey='{{ json_encode($survey) }}' :results='{!! json_encode($results) !!}' />
        </div>
    </div>
</body>

</html>
