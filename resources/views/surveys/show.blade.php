@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
          <div class="row">
            <div class="col">
              <h5 class="card-title float-start">
                {{ $survey->survey_name }}
              </h5>

              @can('scripter')
              <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-warning float-end" target="_blank">
                Script
              </a>
              @endcan

              <div class="btn-group float-end" role="group" aria-label="Project Actions">
                
                
              </div>
            </div>
            <div class="col text-end">
              @include('partials.alerts')
            </div>
          </div>
          
    </div>
    @canany(['admin', 'agent', 'respondent',])
    <div class="card-body">
      <!-- Survey Model-->
      <p id="survey-url" style="display: none;">
        {{ url("api/surveys/$survey->id") }}
      </p>
      <p id="survey_id" style="display: none;">
        {{ $survey->id }}
      </p>
      <!-- End Survey Model-->


      <!-- Survey Results-->
      <p id="result-url" style="display: none;">
        {{ route('results.update', $survey->id) }}
      </p>
      <!-- Survey Results-->

      <!-- <div id="surveyContainer"></div> -->
      <survey params="survey: model"></survey>

    </div>
    @endcan
  </div>
</div>

<script type="text/javascript" src="{{ asset('assets/survey_js/model.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('assets/survey_js/results.js') }}" defer></script>
@endsection