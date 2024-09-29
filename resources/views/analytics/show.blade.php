@extends('layouts.main')

@section('content')

<div class="container">
    <h2 class="text-info text-center">
        {{ $survey->project->name . ' ' . $survey->survey_name }} Analytics
    </h2>
    <p id="dev_licence" class="d-none">{{ config('app.dev_licence') }}</p>
	<p id="result_url" class="d-none">
        {{ route("api.results.show", $result->id ?? '') }}
    </p>

    <p id="survey_url" class="d-none">
        {{ route("api.surveys.show", $result->schema_id ?? '') }}
    </p>

    <p id="survey_id" class="d-none">
        {{ $result->schema_id ?? '' }}
    </p>

    <div id="surveyVizPanel"></div>
</div>

<script type="text/javascript" src="{{ asset('assets/survey_js/analytics.js') }}" defer></script>

@endsection