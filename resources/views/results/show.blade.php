@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h5 class="float-start">
            {{ $result->id ?? '' }}
          </h5>
          @canany(['admin','ceo','head','manager','scripter'])
          <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
            
            
            <a href="" class="btn btn-outline-primary" title="View Tool">
              Tool
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
              1
            </span>
          </button>
          <hr>
          @canany(['admin'])
            <div class="alert alert-info">
              <p> 
                <strong>API Survey url: </strong> {{ route("api.results.show", $result->id) }}
              </p>
              <p> 
                <strong>Survey Id: </strong> {{ $result->schema_id }}
              </p>
            </div>
          @endcan
        </div>
      </div>
    </div>
    @canany(['admin', 'agent', 'respondent',])
    <div class="card-body">
      <!-- For Survey Model-->
      <p id="survey_url" style="display: none;">
        {{ route("api.results.show", $result->id) }}
      </p>
      <p id="survey_id" style="display: none;">
        {{ $result->schema_id }}
      </p>
      <p id="user_id" style="display: none;">
        {{ auth()->user()->id }}
      </p>
      <!-- End Survey Model-->

      <survey params="survey: model"></survey>

    </div>
    @endcan
  </div>
</div>


<script type="text/javascript" src="{{ asset('assets/survey_js/survey_results.js') }}" defer></script>

@endsection