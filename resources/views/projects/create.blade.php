@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h2>Create New Project</h2>
        </div>
        <div class="col-12">
          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <div class="row mb-3">
          <div class="col">
            <label for="project_name" class="form-label">
              Project Name
            </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="project_name" aria-describedby="projectName">
            @error('name')
              <p class="text-danger">{{ $message }}</p>
            @else
              <div id="projectName" class="form-text">
                Name of the project
              </div>
            @enderror
          </div>

          
        </div>

        <div class="row">
          <div class="col mb-3">
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
          </div>

          <div class="col mb-3">
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
          </div>
        </div>

        <div class="row">
          <div class="col mb-3">
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
          </div>

          
        </div>

            <div class="row mb-3">
              <div class="col">
                <label class="form-label">
                  Expected Start Date
                </label>
                
                <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" aria-labelledby="start_date">
                @error('start_date')
                  <p class="text-danger">{{ $message }}</p>
                @else
                  <div id="start_date" class="form-text">
                      Project Start Date
                    </div>
                @enderror
              </div>
              <div class="col">
                <label class="form-label">
                  Expected End Date
                </label>
                
                <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" aria-labelledby="end_date">
                @error('end_date')
                  <p class="text-danger">{{ $message }}</p>
                @else
                  <div id="end_date" class="form-text">
                    Project Start Date
                  </div>
                @enderror
              </div>
              
            </div>
        
        
        <button type="submit" class="btn btn-primary">Create</button>
        <button type="reset" class="btn btn-warning">Reset</button>
      </form>
    </div>
  </div>
</div>


@endsection