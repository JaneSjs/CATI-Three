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
          <h6 class="float-start text-primary">
            <?php
                $interview_date = Carbon::parse($interview->created_at)
              ?> 

            {{ $interview->user->first_name . ' ' . $interview->user->last_name }}'s Interview with {{ $interview->respondent->name . ' ' . $interview_date->diffForHumans() }}. 
          </h6>
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
          <ul class="list-group">
            <li class="list-group-item">
              Gender: {{ $interview->respondent->gender }}
            </li>
            <li class="list-group-item">
              Phone Called : {{ $interview->phone_called }}
            </li>
            <li class="list-group-item">
              Start Time : {{ $interview->respondent->pho }}
            </li>
            <li class="list-group-item">
              End Time : {{ $interview->respondent->name }}
            </li>
            <li class="list-group-item">
              Respondent comes from : {{ $interview->respondent->region . ' ' . $interview->respondent->county . ' ' . $interview->respondent->sub_county . ' ' . $interview->respondent->ward }}
            </li>
            <li class="list-group-item">
              Setting: {{ $interview->respondent->setting }}
            </li>
          </ul>
        </div>
        <div class="col">
          
        </div>
      </div>
    </div>
    <!-- Survey Schema -->
    @canany(['admin', 'agent', 'respondent',])
      @include('surveys.schema')
    @endcan
    <!-- End Survey Schema -->

   
  </div>
</div>


@canany(['admin', 'agent', 'respondent',])
<script type="text/javascript" src="{{ asset('assets/survey_js/survey.js') }}" defer></script>
@endcan

@endsection