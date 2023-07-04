@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  @foreach($surveys as $survey)
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          @if($project)
            <h2 class="text-primary">
              {{ $project->name }}
            </h2>
            <hr>
            <h4 class="text-warning">
              {{ $survey->survey_name }}
            </h4>
          @else
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <i class="fas fa-circle-exclamation fa-lg me-2" style="color: #074411;"></i>
              <div>
                Something is wrong. 
                <a href="{{ route('projects.index') }}">
                  Go back to Your assigned Projects Page
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

            <form method="post" action="{{ route('interviews.store') }}">
              @csrf
              <div class="d-none">

                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                <input type="hidden" name="respondent_id" value="{{ $respondent->id ?? 0 }}">

                <input type="hidden" name="respondent_name" value="{{ $respondent->name ?? '' }}">

                <input type="hidden" name="ext_no" value="{{ auth()->user()->ext_no }}">

                <input type="hidden" name="phone_called" value="{{ $respondent->phone_1 ?? 0 }}">

              </div>

              <div class="row mb-3">
                <div class="col">
                  <button type="submit" class="btn btn-success">
                    Start Survey
                  </button>
                </div>
                <div class="col">
                  @if($respondent)
                  <a href="javascript:void(0)" onclick='launchZoiper()' class="btn btn-outline-info" title="Call Respondent">
                    <i class="fas fa-phone fa-bounce"></i>
                    {{ auth()->user()->ext_no }}
                  </a>
                  @endif
                </div>
              </div>
            </form>

        </div>
        <div class="col">

          <form action="{{ url('search_respondent') }}" method="GET">
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">

            <div class="input-group">
              <input type="search" name="query" class="form-control form-control" placeholder="Search for respondents..." value="{{ request()->get('query') }}">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>

          @if($respondent)
            <!-- <h5>Respondent's Details</h5> -->
            <ul class="list-group mt-3">
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
          @else
            <p>No respondent found.</p>
          @endif
        </div>
      </div>

      

      <div class="d-none">
        Project Id
        <input type="text" name="project_id" value="{{ $survey->project_id }}">
      </div>

      
      
    </div>
  </div>
  @endforeach
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