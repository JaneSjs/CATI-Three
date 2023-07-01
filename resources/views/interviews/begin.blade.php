@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  @foreach($surveys as $survey)
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          @if($project)
            <h2>
              {{ $project->name }}
            </h2>
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

            <label for="choose_survey">
              Pick A Survey To Proceed
            </label>
            <select id="choose_survey" name="survey_id" class="form-control" >
              @foreach($surveys as $survey)
              <option value="{{$survey->survey_id}}">
                {{ $survey->survey_name }}
              </option>
              @endforeach
            </select>

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
            <h5>Respondent's Details</h5>
            <ul class="list-group">
              <li class="list-group-item">
                {{ $respondent->name }}
              </li>
              <li class="list-group-item">
                {{ $respondent->age }}
              </li>
              <li class="list-group-item">
                {{ $respondent->gender }}
              </li>
              <li class="list-group-item">
                {{ $respondent->region }}
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


@endsection