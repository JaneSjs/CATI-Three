@extends('layouts.main')
    
@section('content')


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
            <div class="btn-group float-end" role="group" aria-label="Project Actions">
              @can(['agent'])
              <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#respondent_feedback">
                Respondent Feedback
                <i class="fa-regular fa-comment-dots"></i>
              </button>
              @endcan
            </div>
            @include('interviews/modals')
          @else
            <div class="btn-group float-end" role="group" aria-label="Project Actions">
              @can(['agent'])
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
        
        <div class="col">
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

              <button type="submit" class="btn btn-success">
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

            
            <!--<button type="button" onclick="call()" class="btn btn-outline-info" title="Call {{ $respondent->name ?? '' }}">
              <i class="fas fa-phone fa-bounce"></i>
              {{ auth()->user()->ext_no }}
            </button>-->

            @endif

        </div>
        
        <div class="col">

          <form action="{{ url('search_respondent') }}" method="GET">
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

          @if($respondent)
            <div class="row mt-3">
              <div class="col-9">
                <ul class="list-group">
                  <li class="list-group-item">
                    <strong>
                      {{ $respondent->name ?? 'Database is Probably Empty' }}
                    </strong> | {{ $respondent->gender ?? '' }}
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
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->gender ?? 'Gender is Undefined' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->region ?? '' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->county ?? '' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->sub_county ?? '' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->ward ?? '' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->setting ?? '' }}
                  </li>
                </ul>
              </div>
              <div class="col-3">
                <div class="btn-group">
                  <button type="reset" class="btn btn-danger btn-sm">
                    Reset Search
                  </button>
                </div>
              </div>
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
            text: "Check Your Internet Connection",
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