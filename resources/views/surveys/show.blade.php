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
            <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results" title="Survey Results Actions">
              Results
            </button>
            <a href="" class="btn btn-outline-primary" title="View Analytics" rel="noopener">
              Analytics
            </a>
          </div>
          @endcan

          <div class="btn-group btn-sm float-end" role="group" aria-label="Project Actions">
            @can(['agent'])
            <button type="button" class="btn btn-warning btn-sm" data-coreui-toggle="modal" data-coreui-target="#interview_schedule">
              Schedule Interview
              <i class="fa-regular fa-clock"></i>
            </button>
            <button type="button" class="btn btn-info btn-sm" data-coreui-toggle="modal" data-coreui-target="#interview_feedback">
              Interview Feedback
              <i class="fa-regular fa-comment-dots"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#respondent_feedback">
              Respondent Feedback
              <i class="fa-regular fa-comment-dots"></i>
            </button>
            @include('interviews/modals')
            @endcan
          </div>
        </div>
        <div class="col text-end">
          @include('partials.alerts')

          @if($survey->iframe_url == null)
          <button type="button" class="btn btn-primary text-light text-end">
            Version 
            <span class="badge text-bg-secondary">
              {{ $survey->version ?? 0 }}
            </span>
          </button>
          @endif
          
          <hr>
          @canany(['admin'])
            <div class="alert alert-info">
              <p> 
                <strong>API Survey url: </strong> {{ route("api.surveys.show", $survey->id) }}
              </p>
              <p> 
                <strong>Survey Id: </strong> {{ $survey->id }}
              </p>
            </div>
          @endcan
        </div>
      </div>
    </div>
    
    @if($survey->iframe_url)
      <!-- Iframe -->
        @canany(['admin', 'agent', 'respondent'])
          @include('surveys.iframe')
        @endcan
      <!-- End Iframe -->
    @else
      <!-- Survey Schema -->
      @canany(['admin', 'agent', 'respondent'])
        @include('surveys.schema')
      @endcan
      <!-- End Survey Schema -->
    @endif

    @canany(['admin', 'qc'])
      @include('surveys.qc')
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
              <i class="fas fa-file-csv"></i>
              CSV
            </a>
            <a href="{{ url('xlsx_export', $survey->id) }}" class="btn btn-outline-dark" title="Excel Format">
              <i class="far fa-file-spreadsheet" style="color: #3d3846;"></i>
              Excel
            </a>
            <a href="{{ url('pdf_export', $survey->id) }}" class="btn btn-outline-dark" title="Portable Document Format">
              <i class="fas fa-file-pdf" style="color: #ef2929;"></i>
              PDF
            </a>
            <a href="" class="btn btn-outline-primary" title="JSON Format">
              <i class="fas fa-brackets-curly"></i>
              JSON
            </a>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- End Survey Results Modal -->

@can(['agent'])
<!-- Feedback Modal -->
<div class="modal fade" id="interview_feedback" tabindex="-1" aria-labelledby="interview_feedback" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="interview_feedback">
          Interview Feedback
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('interview_feedback') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="interview_id" value="{{ $interview->id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="feedback_input" class="form-label">
                
            </label>
            <textarea class="form-control" name="feedback" id="feedback_input" rows="7"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Submit feedback
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Feedback Modal -->
@endcan


@endsection