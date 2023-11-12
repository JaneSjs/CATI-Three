@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h2>
            Edit {{ $project->name }}
          </h2>
        </div>
        <div class="col-12">
          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('projects.update', $project->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row mb-3">        
          <div class="col">
            <label for="project_name" class="form-label">
              Project Name
            </label>
            <input type="text" class="form-control" name="name" id="project_name" aria-describedby="projectName" value="{{ $project->name }}">
            <div id="projectName" class="form-text">
              Edit project Name
            </div>
          </div>

          <div class="col">
            <label for="project_type" class="form-label">
              Project Type
            </label>
            <select class="form-select" id="project_type" name="type">
              <option value="{{ $project->type }}" selected>
                {{ $project->type }}
              </option>
              <option value="CATI">CATI</option>
              <option value="CAWI">CAWI</option>
              <option value="CAPI">CAPI</option>
            </select>
            <div id="projectType" class="form-text">Type of the project</div>
          </div>
        </div>

        <!-- <div class="mb-3">
          <label for="supervisors" class="form-label">
            Assign Supervisors
          </label>
          <select class="form-select" id="supervisors" name="supervisors[]" multiple>
            @foreach($supervisors as $supervisor)
            <option value="{{ $supervisor->id }}">
              {{ $supervisor->last_name }}
            </option>
            @endforeach
          </select>
          <div id="supervisor" class="form-text">Assign Supervisors</div>
        </div> -->

        <!-- <div class="mb-3">
          <label for="scriptors" class="form-label">
            Assign Scriptors
          </label>
          <select class="form-select" id="scriptors" name="scriptors[]" multiple>
            @foreach($scriptors as $scriptor)
            <option value="{{ $scriptor->id }}">
              {{ $scriptor->last_name }}
            </option>
            @endforeach
          </select>
          <div id="scriptors" class="form-text">Assign Scriptors</div>
        </div> -->

        <!-- <div class="mb-3">
          <label for="qcs" class="form-label">
            Assign QCs
          </label>
          <select class="form-select" id="qcs" name="qcs[]" multiple>
            @foreach($qcs as $qc)
            <option value="{{ $qc->id }}">
              {{ $qc->last_name }}
            </option>
            @endforeach
          </select>
          <div id="qcs" class="form-text">Assign QCs</div>
        </div> -->

        <div class="mb-3">
          <label for="database" class="form-label">
            Change Respondents Database
          </label>
          <select class="form-select" name="database" aria-label="Select Database">
            <option value="{{ $project->database }}" selected>
                {{ $project->database }}
              </option>
            <option value="Controller" title="Controlled Database">
              Controller
            </option>
            <option value="Processor" title="Processed Database">
              Processor
            </option>
          </select>
          <div id="database" class="form-text">
            Change Database
          </div>
        </div>

        <div class="row mb-3">
          <div class="col">
            <label class="form-label">
              Change Start Date
            </label>
                
            <input class="form-control" type="date" name="start_date" aria-labelledby="start_date" value="{{ $project->start_date }}">
            <div id="start_date" class="form-text">
              Change Start Date
            </div>
          </div>
          <div class="col">
            <label class="form-label">
              Change End Date
            </label>
                
            <input class="form-control" type="date" name="end_date" aria-labelledby="end_date" value="{{ $project->end_date }}">
            <div id="end_date" class="form-text">
                Change End Date
            </div>
          </div>
        </div>
        
        
        <button type="submit" class="btn btn-primary">
          Update
        </button>
      </form>
    </div>
    <div class="card-footer"></div>
  </div>
</div>


@endsection