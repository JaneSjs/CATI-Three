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

            <form action="{{ route('call') }}" method="post">
              @csrf
              <input type="hidden" name="exten" value="IAX2/{{ auth()->user()->ext_no }}">
              <input type="hidden" name="respondent_number" value="890{{ $respondent->phone_1 }}">
              <button type="submit" class="btn btn-outline-info" title="Call {{ $respondent->name ?? '' }}">
                <i class="fas fa-phone fa-bounce"></i>
                {{ auth()->user()->ext_no }}
              </button>
            </form>
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
                <button type="submit" class="btn btn-primary" title="Search">
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
                      {{ $respondent->name }}
                    </strong> | {{ $respondent->gender }}
                  </li>
                  @canany(['admin'])
                    <li class="list-group-item">
                      {{ $respondent->phone_1 }}
                    </li>
                  @endcan
                  
                  <li class="list-group-item">
                    {{ $respondent->age ?? 'Age is Undefined'}}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->gender ?? 'Gender is Undefined' }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->region }} | {{ $respondent->county }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->county }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->sub_county }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->ward }}
                  </li>
                  <li class="list-group-item">
                    {{ $respondent->setting }}
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

<script>

  let phone_1 = document.getElementById('phone_1').innerHTML;
  let ext_no = document.getElementById('ext_no').innerHTML;

  console.log(phone_1);
  console.log(ext_no);

  function launchZoiper() {
  let phone_1 = document.getElementById('phone_1').innerHTML;
  let ext_no = document.getElementById('ext_no').innerHTML;

    let zoiperURI = `zoiper:call?number=890${encodeURIComponent(phone_1)}&extension=IAX2/${encodeURIComponent(ext_no)}`;
    let request = new XMLHttpRequest();

    request.open('GET', `/calls.php?exten=IAX2/${encodeURIComponent(ext_no)}&number=890${encodeURIComponent(phone_1)}`, true);

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        console.log(request.responseText);
        window.open(zoiperURI);
        //toastr["success"]("Call Initiated Successfully, you should receive a call on your Zoiper Extension");
      } else {
        console.error(request.status);
      }
    };

    request.onerror = function() {
      console.error("Request failed");
    };

    request.send();
}



</script>


@endsection