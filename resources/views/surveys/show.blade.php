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

              <div class="dropdown float-end">
                <button class="btn btn-warning dropdown-toggle" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                  Script
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('surveys.edit', $survey->id) }}" class="dropdown-item">
                     Here
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('surveys.edit', $survey->id) }}" class="dropdown-item" target="_blank">
                     New Tab
                    </a>
                  </li>
                </ul>
              </div>

              <div class="btn-group float-end" role="group" aria-label="Project Actions">
                
                
              </div>
            </div>
            <div class="col text-end">
              @include('partials.alerts')
            </div>
          </div>
          
    </div>
    <div class="card-body">

      <p id="url" style="display: none;">
        {{ url("api/surveys/$survey->id") }}
      </p>

      <div id="surveyContainer"></div>
      <survey params="survey: model"></survey>

    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('assets/survey_js/model.js') }}"></script>

@endsection