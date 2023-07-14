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
            {{ $interview->survey->survey_name  }}
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
    

   
  </div>
</div>


<div class="d-none">
  <p id="survey_id">{{ $interview->survey->id  }}</p>
  <p id="interview_id">{{ $interview->id  }}</p>
  <p id="result_url">{{ route('api.results.show', $interview->id)  }}</p>
</div>

<div class="container">

  	<div class="table-responsive">
	  <table class="table table-bordered">
	  	<thead>
	  		<tr>
	  			<th>
	  				Survey Results
	  			</th>
	  		</tr>
	  	</thead>
	    <tbody id="json-data"></tbody>
	  </table>
	</div>

</div>

<script type="text/javascript" src="{{ asset('assets/custom/coding.js') }}" defer></script>

@endsection
