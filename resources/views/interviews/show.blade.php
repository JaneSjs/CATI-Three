<?php
  use Carbon\Carbon;
?>
@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h6>
            {{ $interview->project->name . ' (' . $interview->survey->survey_name . ')'  }}
          </h6>
          <hr>
          <p class="float-start text-primary">
            <?php
              $interview_date = Carbon::parse($interview->created_at)
            ?> 

            <strong>
              {{ $interview->user->first_name . ' ' . $interview->user->last_name }}'s
            </strong> 
            Interview with 
            <strong>
              {{ $interview->respondent->name . ' ' . $interview_date->diffForHumans() }}
            </strong>. 
          </p>
          @canany(['admin','ceo','head','manager','scripter'])
          <div class="btn-group btn-group-sm float-end" role="group" aria-label="Interview Actions">
            <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results" title="Survey Results Actions">
              Download This Interview
            </button>
          </div>
          @endcan
        </div>
        <div class="col-3 text-end">

          @include('partials.alerts')
          
        </div>
      </div>
      <div class="row">
        <div class="col">
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
            <li class="list-group-item list-group-item-primary">
            <?php
              $start_time = Carbon::parse($interview->start_time);
              $end_time   = Carbon::parse($interview->end_time);
            ?> 
              <div class="fw-bold">
                Start Time
              </div>
               <span class="badge bg-primary">
                {{ $start_time->format('D d/M/Y, h:i:s') }}
               </span>
            </li>
            <li class="list-group-item">
              <div class="fw-bold">
                End Time
              </div>
              <span class="badge bg-primary">
                {{ $end_time->format('D d/M/Y, h:i:s') }}
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
        <div class="col">
          <audio controls>
            <source src="{{ asset('assets/audios/sample-audio.wav') }}" type="audio/wav">
            Your browser is not able to play audio recordings.
          </audio>
        </div>
      </div> 
    </div>
    <div class="card-body">
      @canany(['coding'])
        @include('interviews/coding')
      @endcan

      @canany(['qc'])

        @if(!$interview->survey_url === null)
          <!-- Iframe -->
            @canany(['admin', 'agent', 'respondent'])
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
          <form method="post" action="{{ route('interviews.update', $interview->id) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="quality_control" value="Approved">
            <input type="hidden" name="survey_id" value="{{ $interview->survey->id }}">

            <button type="submit" class="btn btn-outline-success floar-start">
              Approve This Interview
              <i class="fas fa-check"></i>
            </button>
          </form>
        </div>
        <div class="col">
          <form method="post" action="{{ route('interviews.update', $interview->id) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="quality_control" value="Cancelled">
            <input type="hidden" name="survey_id" value="{{ $interview->survey->id }}">

            <button type="submit" class="btn btn-outline-danger float-end">
              Cancel This Interview
              <i class="fas fa-times"></i>
            </button>
          </form>
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
  
  

</div>


<script type="text/javascript" src="{{ asset('assets/survey_js/survey_results.js') }}" defer></script>

@endsection