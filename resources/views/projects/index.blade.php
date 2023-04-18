@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Projects
        </div>
        <div class="col text-end">
          <a href="{{ route('projects.create') }}" class="btn btn-outline-success">
            Create Project
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col">
          <div class="table-responsive">
            <table class="table table-striped-columns table-hover table-sm caption-top">
              <caption>
               Active Projects
              </caption>
              <thead class="table-warning">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <caption>
               Closed Projects
              </caption>
              <thead class="table-success">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


@endsection