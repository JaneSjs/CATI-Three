@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>
            Edit {{ $project->name }}
          </h2>
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
        <div class="col">
          @canany(['admin','manager'])
            <button type="button" class="btn btn-outline-success btn-sm" data-coreui-toggle="modal" data-coreui-target="#assignMoreMembers">
              Assign Other Members
            </button>
            @include('projects.partials.assign_more_members')
          @endcan
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
                {{ $project->type ?? 'Select Type'}}
              </option>
              <option value="CATI">CATI</option>
              <option value="CAWI">CAWI</option>
              <option value="CAPI">CAPI</option>
            </select>
            <div id="projectType" class="form-text">
              Type of the project
            </div>
          </div>
        </div>

        <!--<div class="mb-3">
          <label for="users" class="form-label">
            Assign Someone
          </label>
          <select class="form-select" id="users" name="users[]" multiple>
            @if($users)
              @foreach($users as $user)
              <option value="{{ $user->id }}" @if($project->user) {{ $project->user->id == $user->id ? 'selected' : '' }} @endif >
                {{ $user->first_name . ' ' . $user->last_name }}
              </option>
              @endforeach
            @endif
          </select>
          <div id="user" class="form-text">Assign Someone</div>
        </div>-->

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