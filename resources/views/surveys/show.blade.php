@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  @canany(['ceo','client','interviewer'])
  <button type="button" class="btn btn-primary mb-2 mt-2" data-coreui-toggle="modal" data-coreui-target="#interview_termination_feedback" title="Go Back" id="terminateInterviewButton1">
    <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
  </button>
  @endcan
  <div class="card">
    <div class="card-header">

      <div class="row">
        <div class="col">
          <p class="float-start">
            <strong class="text-primary">
              {{ $survey->survey_name }}.
            </strong>
            @canany(['ceo','client','interviewer'])
             You are interviewing 
             <strong class="text-info">
               {{ $respondent->name }}
             </strong>
            @endcan
          </p>
          
          <div class="btn-group btn-sm float-end" role="group" aria-label="Interview Actions" id="interviewActionButtons">
            @canany(['interviewer'])
            <button type="button" class="btn btn-warning btn-sm" data-coreui-toggle="modal" data-coreui-target="#interview_schedule">
              Schedule Interview
              <i class="fa-regular fa-clock"></i>
            </button>
           
            <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#interview_termination_feedback" >
              Terminate Interview
              <i class="fa-solid fa-xmark" style="color: #ffffff;"></i>
            </button>
            @include('interviews/modals')
            

            <p id="call_route" class="d-none">
              {{ route('call') }}
            </p>
            <p id="exten" class="d-none">
              IAX2/{{ auth()->user()->ext_no }}
            </p>
            <p id="respondent_number" class="d-none">
              890{{ $respondent->phone_1 ?? 0 }}
            </p>

            <button type="button" onclick="call()" class="btn btn-outline-info">
              <i class="fas fa-phone fa-bounce"></i>
              {{ auth()->user()->ext_no }}
            </button>

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
                        text: "Answer The Call",
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
                    
                    const errorMessage = await response.text();

                    // Toastify Notifications
                      Toastify({
                        text: errorMessage,
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
            @include('interviews/modals')
            @endcan
          </div>
        </div>
        <div class="col text-end">
          @include('partials.alerts')

          @canany(['admin','ceo','head'])
            @if($survey->iframe_url == null)
              <div class="toast show">
                <div class="toast-header">
                  <strong class="me-auto">
                    Survey Version
                    <span class="badge text-light text-bg-primary">
                      {{ $survey->version ?? 0 }}
                    </span>
                  </strong>
                </div>
                <div class="toast-body text-start text-primary">
                  Last Scripted By: @if($survey->updated_by) {{ $survey->updated_by }} at {{ $survey->updated_at }} @endif
                </div>
              </div>
            @endif
          @endcan
          
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
        @canany(['admin','ceo','client','interviewer','respondent'])
          @include('surveys.iframe')
        @endcan
      <!-- End Iframe -->
    @else
      <!-- Survey Schema -->
      @canany(['admin','ceo','client','interviewer','respondent'])
        @include('surveys.schema')
      @endcan
      <!-- End Survey Schema -->
    @endif

    @canany(['qc'])
      @include('surveys.qc')
    @endcan
    

    <div class="card-footer">
      @canany(['ceo','client','interviewer'])
      <button type="button" class="btn btn-danger" data-coreui-toggle="modal" data-coreui-target="#interview_termination_feedback" id="terminateInterviewButton2">
        Terminate Interview
        <i class="fa-solid fa-xmark" style="color: #ffffff;"></i>
      </button>

      <div class="d-grid">
        <button type="button" class="btn btn-success btn-lg btn-block p-4 invisible" data-coreui-toggle="modal" data-coreui-target="#complete_interview" id="completeInterview" title="Click To Complete The Interview">
          Complete Interview
          <i class="fa-solid fa-check" style="color: #ffffff;"></i>
        </button>
      </div>
      @endcan
    </div>
  </div>
</div>

@canany(['ceo','client','interviewer'])
<!-- Complete Interview Modal -->
<div class="modal fade" id="complete_interview" tabindex="-1" aria-labelledby="complete_interview" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="complete_interview">
          Are you Sure ?
        </h5>
        
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col">
            <button type="button" class="btn btn-outline-danger float-start" data-coreui-dismiss="modal" aria-label="Close">
              No
            </button>
          </div>
          <div class="col">
            <form action="{{ route('update_interview_status') }}" method="post">
              @csrf
              @method('PATCH')
              <input type="hidden" name="respondent_id" value="{{ $respondent_id }}">
              <input type="hidden" name="survey_id" value="{{ $survey->id }}">
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              <input type="hidden" name="interview_id" value="{{ $interview->id }}">
              <input type="hidden" name="iframe_url" value="{{ $iframe_url  }}">
              <input type="hidden" name="interview_status" value="Interview Completed">

              <button type="submit" class="btn btn-outline-success">
                Yes
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Complete Interview Modal -->
@endcan

@endsection