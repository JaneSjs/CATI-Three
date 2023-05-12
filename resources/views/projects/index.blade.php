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
              <caption class="text-danger">
               Active Projects
              </caption>
              <thead class="table-warning">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                @foreach($projects as $project)
                <tr>
                  <th scope="row">
                    {{ $project->id }}
                  </th>
                  <td>
                    <a href="{{ route('projects.show', $project->id) }}">
                      {{ $project->name }}
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $projects->links() }}
              </tfoot>
            </table>
          </div>
        </div>

        <div class="col">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <caption class="text-success">
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