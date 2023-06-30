@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  @foreach($surveys as $survey)
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>Pick A Survey To Proceed</h2>
        </div>
        <div class="col text-end">
          @include('partials.alerts')
        </div>
    </div>
          
    </div>
    <div class="card-body">
      <form method="post" action="{{ url('search_respondent') }}">
        @csrf
        
        <div class="d-none">
          <input type="hidden" name="project_id" value="{{ $survey->project_id }}">
        </div>

        <div class="mb-3 mt-3">
          <label for="choose_survey">
            Choose Survey
          </label>
          <select id="choose_survey" name="survey_id" class="form-control" >
            @foreach($surveys as $survey)
            <option value="{{$survey->survey_id}}">
              {{ $survey->survey_name }}
            </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-outline-info">
          Find New Respondent
        </button>
      </form>
      
    </div>
  </div>
  @endforeach
</div>


@endsection