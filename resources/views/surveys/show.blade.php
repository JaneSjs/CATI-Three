@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h5 class="float-start">
            {{ $survey->survey_name }}
            @can('admin')
             @if($survey->updated_by)
              was last scripted by : <span>{{ $survey->updated_by }}</span>
             @endif
            @endcan
          </h5>
          @canany(['admin','ceo','head','manager','scripter'])
          <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-warning" target="_blank" rel="noreferrer">
              Script
            </a>
            <a href="" class="btn btn-outline-primary" title="Change The Survey Stage">
              Staging
            </a>
            <a href="" class="btn btn-outline-primary" title="View Tool">
              Tool
            </a>
            <a href="" class="btn btn-outline-primary" title="Generate PDF">
              PDF
            </a>
            <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results" title="Survey Results Actions">
              Results
            </button>
            <a href="" class="btn btn-outline-primary" title="View Analytics" rel="noopener">
              Analytics
            </a>
          </div>
          @endcan

          <div class="btn-group float-end" role="group" aria-label="Project Actions">
                
          </div>
        </div>
        <div class="col text-end">
          @include('partials.alerts')
          <button type="button" class="btn btn-primary text-light text-end">
              Version 
              <span class="badge text-bg-secondary">
                {{ $survey->version ?? 0 }}
              </span>
            </button>
        </div>
      </div>
    </div>
    @canany(['admin', 'agent', 'respondent',])
    <div class="card-body">
      <!-- For Survey Model-->
      <p id="survey-url" style="display: none;">
        {{ url("api/surveys/$survey->id") }}
      </p>
      <p id="survey_id" style="display: none;">
        {{ $survey->id }}
      </p>
      <!-- End Survey Model-->


      <!-- For Survey Results-->
      <p id="result-url" style="display: none;">
        {{ route('api.results.store') }}
      </p>
      <p id="user_id" style="display: none;">
        {{ auth()->user()->id }}
      </p>
      <p id="schema_id" style="display: none;">
        {{ route('api.results.store') }}
      </p>
      <!-- Survey Results-->

      <survey params="survey: model"></survey>

    </div>
    @endcan
  </div>
</div>

<!-- Survey Results Modal -->

<div class="modal fade" id="results" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Available Data Formats For Download
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
            <a href="{{ url('csv_export', $survey->id) }}" class="btn btn-outline-warning" title="CSV Format">
              <i class="fas fa-download"></i>
              CSV
            </a>
            <a href="{{ url('xlsx_export', $survey->id) }}" class="btn btn-outline-dark" title="Excel Format">
              <i class="fas fa-download"></i>
              Excel
            </a>
            <a href="" class="btn btn-outline-primary" title="JSON Format">
              <i class="fas fa-download"></i>
              JSON
            </a>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- End Survey Results Modal -->


<script type="text/javascript" src="{{ asset('assets/survey_js/model.js') }}" defer></script>

@endsection