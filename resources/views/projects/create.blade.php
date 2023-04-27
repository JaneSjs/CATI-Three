@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <h2>Create New Project</h2>
    </div>
    <div class="card-body">
      <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="project_name" class="form-label">
            Project Name
          </label>
          <input type="text" class="form-control" name="name" id="project_name" aria-describedby="projectName">
          <div id="projectName" class="form-text">Name of the project</div>
        </div>

        <div class="mb-3">
          <label for="supervisors" class="form-label">
            Assign Supervisors
          </label>
          <select class="form-multi-select" id="supervisors" name="supervisors[]" multiple data-coreui-search="true">
            <option value="Supervisor 1">Supervisor 1</option>
            <option value="Supervisor 2">Supervisor 2</option>
            <option value="Supervisor 3">Supervisor 3</option>
            <option value="Supervisor 4">Supervisor 4</option>
          </select>
          <div id="supervisor" class="form-text">Assign Supervisors</div>
        </div>

        <div class="mb-3">
          <label for="scriptors" class="form-label">
            Assign Scriptors
          </label>
          <select class="form-multi-select" id="scriptors" name="scriptors[]" multiple data-coreui-search="true">
            <option value="Scriptor 1">Scriptor 1</option>
            <option value="Scriptor 2">Scriptor 2</option>
            <option value="Scriptor 3">Scriptor 3</option>
            <option value="Scriptor 4">Scriptor 4</option>
          </select>
          <div id="scriptors" class="form-text">Assign Scriptor</div>
        </div>

        <div class="mb-3">
          <label for="qcs" class="form-label">
            Assign QCs
          </label>
          <select class="form-multi-select" id="qcs" name="qcs[]" multiple data-coreui-search="true">
            <option value="Qc 1">Qc 1</option>
            <option value="Qc 2">Qc 2</option>
            <option value="Qc 3">Qc 3</option>
            <option value="Qc 4">Qc 4</option>
          </select>
          <div id="qcs" class="form-text">Assign QCs</div>
        </div>

        <div class="mb-3">
          <label for="database" class="form-label">
            Data Protection Module
          </label>
          <select class="form-select" name="database" aria-label="Select Database">
            <option selected>Choose Database</option>
            <option value="controller" title="Controlled">
              RDMS
            </option>
            <option value="processor" title="Processed">
              Client's Database
            </option>
          </select>
          <div id="database" class="form-text">Choose Database</div>
        </div>

        <div class="mb-3">
            <div class="row">
              <div class="col-lg-4">
                <label class="form-label">
                  Expected Start Date
                </label>
                
                <input class="form-control" type="date" name="start_date" aria-labelledby="start_date">
                <div id="start_date" class="form-text">
                  Project Start Date
                </div>
              </div>
              <div class="col-lg-4">
                <label class="form-label">
                  Expected End Date
                </label>
                
                <input class="form-control" type="date" name="end_date" aria-labelledby="end_date">
                <div id="end_date" class="form-text">
                  Project End Date
                </div>
              </div>
              
            </div>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Create</button>
        <button type="reset" class="btn btn-warning">Reset</button>
      </form>
    </div>
  </div>
</div>


@endsection