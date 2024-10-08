<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          @canany(['admin','head','manager'])
          <form action="{{ url('search_projects') }}" method="GET">
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search projects..." aria-label="Search project..." aria-describedby="search_projects" value="{{ request()->get('query') }}">
              <button type="submit" class="btn btn-outline-info" id="search_projects">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
          @endcan
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
        <div class="col text-end">
          @canany(['admin','head','manager'])
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
          @canany(['interviewer'])
          <caption class="text-danger">
           Active Projects
          </caption>
          @endcan
          <thead class="table-warning">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">
                Project
              </th>

              @canany(['admin','ceo','head','finance','dpo'])
                <th scope="col">
                 Manager
                </th>
              @endcan

              @canany(['admin','dpo'])
                <th scope="col" title="Data Protection Impact Assessment">
                  DPIA Control Panel
                </th>
              @endcan

              @canany(['admin','ceo','head','manager','dpo'])
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Actions</th>
              @endcan
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
              @canany(['admin','ceo','head','finance','dpo'])
                <td>
                  <!-- Display Project Manger's Name -->
                </td>
              @endcan

              @canany(['admin','dpo'])
              <td>
                <a href="{{ route('dpias.show', $project->id) }}">
                  DPIA Documents ({{ $project->dpia->dpia_approval ?? 'Not Approved' }})
                </a>
              </td>
              @endcan
              
              
              @canany(['admin','ceo','head','manager','dpo'])
              <?php
                $start_date = Carbon::parse($project->start_date);
                $end_date = Carbon::parse($project->end_date);
              ?>
              <td>
                {{ $start_date->format('d/m/Y') }}
              </td>
              <td>
                {{ $end_date->format('d/m/Y') }}
              </td>
              <td>
                <div class="btn-group btn-xs" role="group" aria-label="Project Actions">
                  @canany(['admin','ceo','head','manager'])
                  <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-info">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  @endcan
                  
                  @canany(['admin','ceo','head'])
                  <button type="button" class="btn btn-outline-danger" data-coreui-toggle="modal" data-coreui-target="#delete_project-{{ $project->id }}" title="Delete {{ $project->name }}">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                  @endcan
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
                        <p>
                          You are about to perform a sensitive operation. Are you sure about this ?
                        </p>
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
              @endcan
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