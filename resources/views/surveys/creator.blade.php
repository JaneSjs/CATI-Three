@extends('layouts.main')
<!-- ... -->
    <!-- Localization (Translations)-->
    <script src="https://unpkg.com/survey-creator-core/survey-creator-core.i18n.min.js"></script>

    <!-- Supported Languages -->
      <script src="https://unpkg.com/survey-creator-core/i18n/french.js"></script>
      <script src="https://unpkg.com/survey-creator-core/i18n/german.js"></script>
      <script src="https://unpkg.com/survey-creator-core/i18n/italian.js"></script>
    <!-- End Supported Languages -->


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
    <link  href="https://unpkg.com/survey-creator-core/survey-creator-core.min.css" type="text/css" rel="stylesheet">
    <script src="https://unpkg.com/survey-creator-core/survey-creator-core.min.js"></script>
    <script src="https://unpkg.com/survey-creator-knockout/survey-creator-knockout.min.js"></script>
    <!-- ... -->
    
    <script src="{{ asset('assets/survey_js/creator.js') }}"></script>
@section('content')

<div class="body flex-grow-1 px-3">
  <div id="surveyCreator" style="height: 100vh;"></div>
</div>


@endsection