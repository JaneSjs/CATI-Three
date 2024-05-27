<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<script type="text/javascript" src="{{ asset('assets/web_rtc/jssip-3.4.2.min.js') }}"></script>

<!--<script src="{{ asset('assets/web_rtc/jsip.js') }}" defer></script>-->

<div class="body flex-grow-1 px-3">
  
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          @if($project)
            <h3 class="text-primary">
              {{ $project->name }}
            </h3>
            <hr>
            <h5 class="text-warning">
              {{ $survey->survey_name }}
            </h5>
          @else
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <i class="fas fa-circle-exclamation fa-lg me-2" style="color: #074411;"></i>
              <div>
                Something is wrong. 
                <a href="{{ route('projects.index') }}">
                  Go back To Projects
                </a>
              </div>
            </div>
          @endif
        </div>
        <div class="col text-end">
          @if($respondent)
            <button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#respondent_feedback">
              Respondent Feedback
              <i class="fa-solid fa-comment" style="color: #ffffff;"></i>
            </button>
            @include('interviews/modals')
          @else
            <div class="btn-group float-end" role="group" aria-label="Project Actions">
              @can(['interviewer'])
              <a href="{{ route('interview_schedules.index') }}" class="btn btn-warning">
                <i class="fa-solid fa-file-pen"></i>
                Scheduled Interviews
              </a>
              @endcan
            </div>
          @endif
          @include('partials.alerts')
        </div>
    </div>
          
    </div>
    <div class="card-body">

      <div class="row">
        
        <div class="col-3">
            @if($respondent)
            <form method="post" action="{{ route('interviews.store') }}">
              @csrf
              <div class="d-none">

                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                <input type="hidden" name="interview_id" value="{{ $interview_id }}">

                <input type="hidden" name="respondent_id" value="{{ $respondent->id ?? 0 }}">

                <input type="hidden" name="respondent_name" value="{{ $respondent->name ?? '' }}">

                <input type="hidden" name="ext_no" value="{{ auth()->user()->ext_no }}">

                <input type="hidden" name="phone_called" value="{{ $respondent->phone_1 ?? 0 }}">

              </div>

              <button type="submit" class="btn btn-success btn-sm">
                Begin Survey
              </button>
              
            </form>

            <p id="call_route" class="d-none">
              {{ route('call') }}
            </p>
            <p id="exten" class="d-none">
              IAX2/{{ auth()->user()->ext_no }}
            </p>
            <p id="respondent_number" class="d-none">
              890{{ $respondent->phone_1 ?? 0 }}
            </p>
            <!-- <p id="respondent_number" class="d-none">
              {{ $respondent->phone_1 ?? 0 }}
            </p> -->
            <p id="extension_number" class="d-none">
              {{ auth()->user()->ext_no }}
            </p>

            
            <button type="button" onclick="call()" class="btn btn-outline-info mt-3" title="Call {{ $respondent->name ?? '' }}">
              <i class="fas fa-phone fa-bounce"></i>
              {{ auth()->user()->ext_no }}
            </button>

            @canany(['admin'])
              <div class="btn-group btn-group-sm" role="group" aria-label="WebRTC">
                <button id="callButton" type="button" class="btn btn-primary">
                  Call
                </button>
                <button id="hungupButton" type="button" class="btn btn-danger">
                  Hung Up
                </button>
              </div>
            @endcan

            @endif

        </div>
        
        <div class="col-9">

          <div class="row">
            <div class="col">
              <form action="{{ url('search_respondent') }}" method="post">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                <input type="hidden" name="interview_id" value="{{ $interview_id }}">

                <div class="input-group">
                  <input type="search" name="query" class="form-control" placeholder="Search for a respondent..." value="{{ request()->get('query') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary text-light" title="Search">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col">
              <form action="{{ url('find_respondent') }}" method="GET" class="float-end">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                <input type="hidden" name="interview_id" value="{{ $interview_id }}">

                <div class="input-group">
                  <input type="hidden" name="query" class="form-control" placeholder="Find respondent" value="{{ request()->get('query') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-success btn-sm text-light" title="Beta Release">
                      Find Respondent
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          @if($respondent)
            <div class="mt-2">

              <?php if(!is_null($respondent->feedback)) : ?>
              <!-- Start => Idea: Shalom Eshuchi - (shalommary18@gmail.com) -->
              <?php 
                $last_called = Carbon::parse($respondent->updated_at);
               ?>
                <span class="bg-info text-light border border-info mx-2">
                  Last Called Approx {{ $last_called->diffForHumans() ?? '' }}
                </span>
              <!-- End => Idea: Shalom Eshuchi - (shalommary18@gmail.com) -->
                <span class="bg-warning border border-info mx-auto">
                  {{ $respondent->feedback ?? '' }}
                </span>
              <?php endif; ?>

              <ul class="list-group">
                <li class="list-group-item" title="Respondent's Name is Pseudonymised For Data Protection">
                  <strong>
                    {{ $respondent->name ?? 'Database is Probably Empty' }}
                  </strong>
                </li>
                @canany(['admin'])
                  <li class="list-group-item">
                    {{ $respondent->phone_1 }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->interview_date_time }}
                  </li>
                @endcan
                  
                <li class="list-group-item">
                  {{ $respondent->age ?? 'Age is Undefined'}}
                  <button class="btn btn-outline-info btn-sm float-end" title="Click To Update Respondent's Details">
                    Incorrect Respondent's Details ?
                  </button>
                </li>
                <li class="list-group-item">
                  {{ $respondent->ethnic_group . ', ' . $respondent->gender ?? 'Gender is Undefined' }}
                </li>
                <li class="list-group-item">
                  {{ $respondent->region ?? '' }}
                </li>
                <li class="list-group-item">
                  {{ $respondent->county . ',' ?? '' }}
                  {{ $respondent->sub_county . ',' ?? '' }}
                  {{ $respondent->constituency . ',' ?? '' }}
                  {{ $respondent->ward ?? '' }}
                </li>
                <li class="list-group-item">
                  {{ $respondent->setting ?? '' }}
                </li>
              </ul>
            </div>
          @else
            <p class="mt-3 text-primary pl-5">
              Search for a respondent.
            </p>
          @endif
        </div>
      </div>

      

      <div class="d-none">
        Project Id
        <input type="text" name="project_id" value="{{ $survey->project_id }}">
      </div>

      
      
    </div>
  </div>
  
</div>

<p class="list-group-item d-none" id="phone_1">
  {{ $respondent->phone_1 ?? '' }}
</p>
<p class="list-group-item d-none" id="ext_no">
  {{ auth()->user()->ext_no ?? '' }}
</p>

<script defer>

  let respondent_number = document.getElementById('respondent_number').innerHTML;
  let exten   = document.getElementById('exten').innerHTML;
  let call_route = document.getElementById('call_route').innerHTML;
  const csrf  = document.querySelector('meta[name="csrf-token"]').content;
    
  async function call() {
    try {
      
      data = {
        exten: exten,
        respondent_number: respondent_number,
      };

      // Create new Record
      const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json; charset=UTF-8",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrf,
        },
        credentials: "same-origin",
      };

      console.log(data);

      const response = await fetch(call_route, options);
      if (response.ok) {

        const serverFeedback = await response.json();
        console.log(serverFeedback);

        // Toastify Notifications
          Toastify({
            text: "Answer The Soft Phone",
            duration: 9000,
            destination: "https://cati.tifaresearch.com/projects",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #ff0000, #ff4d4d)",
            },
            onClick: function(){} // Callback after click
          }).showToast();
        // End Toastify Notifications
          
      } else {
        // Toastify Notifications
          Toastify({
            text: "Server Issues",
            duration: 9000,
            destination: "https://cati.tifaresearch.com/projects",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #ff0000, #ff4d4d)",
            },
            onClick: function(){} // Callback after click
          }).showToast();
        // End Toastify Notifications

        throw new Error('Server Error. Check Server Logs');
      }
    } catch (error) {
      console.log('Calling Error: ', error);

      
    }
  }
</script>


@endsection