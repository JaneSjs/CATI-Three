@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Projects
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
        <div class="col text-end">
          @canany(['admin','manager'])
          <a href="{{ route('projects.create') }}" class="btn btn-outline-success">
            Create Project
          </a>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-danger">
           Active Projects
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Actions</th>
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
              <td>
                <div class="btn-group btn-xs" role="group" aria-label="Project Actions">
                  <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-info">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <button type="button" class="btn btn-outline-danger" data-coreui-toggle="modal" data-coreui-target="#delete_project-{{ $project->id }}" title="Delete {{ $project->name }}">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>

                <!-- Delete Project Modal -->
                <div class="modal fade" id="delete_project-{{ $project->id }}" tabindex="-1" data-coreui-backdrop="static">
                  <div class="modal-dialog modal-sm bg-danger">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">
                          Delete {{ $project->name }}
                        </h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Modal body text goes here.</p>
                      </div>
                      <div class="modal-footer">
                        <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger">
                            Delete
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Delete Modal -->
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
  </div>
</div>


@endsection