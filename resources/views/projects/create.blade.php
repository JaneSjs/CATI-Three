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
          <label for="ms1" class="form-label">
            Assign Supervisors
          </label>
          <select class="form-multi-select" id="ms1" name="supervisors[]" multiple data-coreui-search="true">
            <option value="0">Supervisor 1</option>
            <option value="1">Supervisor 2</option>
            <option value="2">Supervisor 3</option>
            <option value="3">Supervisor 4</option>
          </select>
          <div id="supervisor" class="form-text">Assign Supervisors</div>
        </div>

        <div class="mb-3">
          <label for="ms1" class="form-label">
            Assign Scriptors
          </label>
          <select class="form-multi-select" id="ms1" name="scriptors[]" multiple data-coreui-search="true">
            <option value="0">Scriptor 1</option>
            <option value="1">Scriptor 2</option>
            <option value="2">Scriptor 3</option>
            <option value="3">Scriptor 4</option>
          </select>
          <div id="supervisor" class="form-text">Assign Scriptor</div>
        </div>

        <div class="mb-3">
          <label for="ms1" class="form-label">
            Assign QCs
          </label>
          <select class="form-multi-select" id="ms1" name="qcs[]" multiple data-coreui-search="true">
            <option value="0">Qc 1</option>
            <option value="1">Qc 2</option>
            <option value="2">Qc 3</option>
            <option value="3">Qc 4</option>
          </select>
          <div id="supervisor" class="form-text">Assign QCs</div>
        </div>

        <div class="mb-3">
          <label for="ms1" class="form-label">
            Data Protection Module
          </label>
          <select class="form-select" name="database" aria-label="Select Database">
            <option selected>Choose Database</option>
            <option value="0" title="Controlled">
              RDMS
            </option>
            <option value="1" title="Processed">
              Client's Database
            </option>
          </select>
          <div id="supervisor" class="form-text">Choose Database</div>
        </div>

        <div class="mb-3">
            <div class="row">
              <div class="col-lg-4">
                <label>Expected Start Date</label>
                <div data-coreui-locale="en-GB" data-coreui-toggle="date-picker"></div>
              </div>
              <div class="col-lg-4">
                <label>Expected End Date</label>
                <div data-coreui-locale="en-GB" data-coreui-toggle="date-picker"></div>
              </div>
            </div>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</div>


@endsection