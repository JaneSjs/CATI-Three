<?php
  use Carbon\Carbon;
?>
@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  @include('partials/errors')
  <div class="card mb-4">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <?php
            $interview_date = Carbon::parse($interview->created_at)
          ?>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead class="table-dark">
                <tr>
                  <th>
                    {{ $interview->project->name }}
                  </th>
                  <th>
                    {{ $interview->survey->survey_name }}
                  </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <strong>
                      Interviewer:
                    </strong> {{ $interview->user->first_name . ' ' . $interview->user->last_name }}
                  </td>
                  <td>
                    <strong>
                      Respondent:
                    </strong> {{ $interview->respondent->name ?? '('. $interview->respondent_name . ') was deleted from the System' }}
                  </td>
                  <td>
                    This Interview was conducted {{ $interview_date->diffForHumans() }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col float-end">
          @canany(['admin','ceo','head','manager','scripter','qc'])
            <button type="button" class="btn btn-outline-danger" data-coreui-toggle="modal" data-coreui-target="#results" title="Download This Interview">
              <i class="fa-solid fa-file-pdf"></i>
            </button>
          @endcan
          @if($interview->feedback)
            <div class="callout callout-info">
              {{ $interview->feedback }}
            </div>
          @endif
        </div>
        <figure>
          <figcaption>Interview Recording(s)</figcaption>
          <audio controls>
            <source src="{{ asset('assets/audios/sample-audio.wav') }}" type="audio/wav">
            <track kind="subtitles" src="not_available_at_the_moment.vtt" srclang="en" label="English">
            <track kind="subtitles" src="not_available_at_the_moment.vtt" srclang="sw" label="Kiswahili">
            Your browser is not able to play audio recordings.
          </audio>
        </figure>
      </div>
      <div class="row">
        <div class="col">
          @if($interview->respondent)
          <div class="container">
            <ul class="list-group list-group-horizontal">
              <li class="list-group-item list-group-item-primary">
                <div class="fw-bold">
                  Gender
                </div>
                {{ $interview->respondent->gender }}
              </li>
              <li class="list-group-item">
                <div class="fw-bold">
                  Phone Called
                </div>
                {{ $interview->phone_called }}
              </li>
              <?php
                $start_time = Carbon::parse($interview->start_time);
                $end_time   = Carbon::parse($interview->end_time);
              ?>
              
              <li class="list-group-item">
                <div class="fw-bold">
                  Interview Duration
                </div>
                <span class="badge bg-primary">
                  {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }} 
                </span>
              </li>
              <li class="list-group-item">
                <div class="fw-bold">
                  Region
                </div>
                {{ $interview->respondent->region . ' - ' . $interview->respondent->county . ' - ' . $interview->respondent->sub_county . ' - ' . $interview->respondent->ward }}
              </li>
              <li class="list-group-item list-group-item-primary">
                <div class="fw-bold">
                  Setting
                </div>
                {{ $interview->respondent->setting }}
              </li>
          </ul>
          </div>
          @endif
        </div>
      </div> 
    </div>
    <div class="card-body">
      @canany(['qc'])
        @if(!$interview->survey_url === null)
          <!-- Iframe -->
            @canany(['admin', 'interviewer', 'respondent'])
              <?php $encoded_iframe_url = urlencode($iframe_url) ?>
              <iframe src="{{ $interview->survey_url }}" style="height:700px;width:100%;" title="Survey Loading Within The Iframe"></iframe>
            @endcan
          <!-- End Iframe -->
        @else
          @include('interviews/survey_results')
        @endif
      @endcan
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col">
          <button type="button" class="btn btn-outline-success floar-start" data-coreui-toggle="modal" data-coreui-target="#qc_interview_approval">
            Approve This Interview
            <i class="fas fa-check"></i>
          </button>
        </div>
        <div class="col">
          <button type="button" class="btn btn-outline-danger float-end" data-coreui-toggle="modal" data-coreui-target="#qc_interview_cancellation">
            Cancel This Interview
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>  
      
    </div>
   
  </div>
</div>


<div class="d-none">
  <p id="survey_id">{{ $interview->survey->id  }}</p>
  <p id="interview_id">{{ $interview->id  }}</p>
  <p id="result_url">{{ route('api.results.show', $interview->id)  }}</p>
</div>

@include('interviews/modals')

<script type="text/javascript" src="{{ asset('assets/survey_js/survey_results.js') }}" defer></script>

@endsection