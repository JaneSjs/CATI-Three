@extends('layouts.main')

@section('content')

<div class="container">
	<p id="result_url" style="display: none;">
        {{ route("api.results.show", $result->id) }}
    </p>

    <p id="survey_url" style="display: none;">
        {{ route("api.surveys.show", $result->schema_id) }}
    </p>

    <p id="survey_id" style="display: none;">
        {{ $result->schema_id }}
    </p>

    <div id="surveyVizPanel"></div>
</div>

<script type="text/javascript" src="{{ asset('assets/survey_js/analytics.js') }}" defer></script>

@endsection