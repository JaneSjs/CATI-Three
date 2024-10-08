<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="id" content="{{ $survey->id }}">
    <meta name="url" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('favicon.jpeg') }}"/>
    <!-- End Favicon -->
    
    <title> 
        {{ $survey->survey_name ?? ' ' }} Questionnaire Designer
    </title>

    <!-- ... -->
    <!-- <script type="text/javascript" src="https://unpkg.com/knockout/build/output/knockout-latest.js"></script> -->
     <script type="text/javascript" src="{{ asset('assets/survey_js/resources/knockout-latest.js') }}"></script>

    <!-- SurveyJS resources -->
    <!-- <link  href="https://unpkg.com/survey-core/defaultV2.min.css" type="text/css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/survey_js/resources/defaultV2.min.css') }}">

    <!-- <script src="https://unpkg.com/survey-core/survey.core.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('assets/survey_js/resources/survey.core.min.js') }}"></script>

    <!-- <script src="https://unpkg.com/survey-knockout-ui/survey-knockout-ui.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('assets/survey_js/resources/survey-knockout-ui.min.js') }}"></script>
    
    <!-- Survey Creator resources -->
    <!-- <link  href="https://unpkg.com/survey-creator-core/survey-creator-core.min.css" type="text/css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/survey_js/resources/survey-creator-core.min.css') }}">

    <!-- <script src="https://unpkg.com/survey-creator-core/survey-creator-core.min.js"></script> -->
    <script src="{{ asset('assets/survey_js/resources/survey-creator-core.min.js') }}"></script>

    <!-- <script src="https://unpkg.com/survey-creator-knockout/survey-creator-knockout.min.js"></script> -->
    <script src="{{ asset('assets/survey_js/resources/survey-creator-knockout.min.js') }}"></script>
    

    <!-- Toastify CSS (For Notifications) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastify/toastify.min.css') }}">
    
</head>
<body>
    <p id="dev_licence" style="display: none;">{{ config('app.dev_licence') }}</p>
    <p id="patch_url" style="display: none;">
        {{ route('api.surveys.update', $survey->id) }}
    </p>
    <p id="results_url" style="display: none;">
        {{ route('api.results.show', $survey->id) }}
    </p>
    <p id="schema_url" style="display: none;">
        {{ route('api.surveys.show', $survey->id) }}
    </p>
    <p id="survey_id" style="display: none;">
        {{ $survey->id }}
    </p>
    <p id="user" style="display: none;">
        {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
    </p>
    <div id="surveyCreator" style="height: 100vh;"></div>

    <!-- Survey Creator -->
    <script src="{{ asset('assets/survey_js/creator.js') }}"></script>

    <!-- Toastify Js (For Notifications) -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js" defer></script>
</body>
</html>