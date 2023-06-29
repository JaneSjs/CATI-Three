@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>
            {{ $project->name }}
          </h2>
          @can('coordinator', 'admin', 'manager', 'client')
            <button type="button" class="btn btn-success btn-sm" data-coreui-container="" data-coreui-toggle="popover" data-coreui-placement="top" data-coreui-content="Data {{ $project->database }}">
              {{ $project->database }}
            </button>
          @endcan
        </div>
        <div class="col text-end">
          @include('partials.alerts')
          @include('partials.errors')
        </div>
      </div>
          
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-9">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <thead class="table-success">
                <tr>
                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  @endcan
                  <th scope="col">Project Duration</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
                  <td>{{ $project->start_date }}</td>
                  <td>{{ $project->end_date }}</td>
                  @endcan
                  <td>
                    <?php
                      use Illuminate\Support\Carbon;
                      $start_date = Carbon::parse($project->start_date);
                      $end_date = Carbon::parse($project->end_date);

                      echo $start_date->diffInDays($end_date) . ' days';
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-3">
          <div class="btn-group" role="group" aria-label="Create Survey and Assign Members to Projects Button">
            @canany(['admin','head','manager','coordinator','scripter','supervisor'])
              <!-- Trigger Members Assignment Modal -->
              <button type="button" class="btn btn-outline-success btn-sm" data-coreui-toggle="modal" data-coreui-target="#assignMembers">
                Assign Members
              </button>
            @endcan

            @canany(['admin','head','manager','coordinator','scripter'])
              <!-- Trigger Survey Modal -->
              <button type="button" class="btn btn-outline-warning btn-sm" data-coreui-toggle="modal" data-coreui-target="#createSurvey">
                Create Survey
              </button>
            @endcan
          </div>

          <!-- Assign Members Modal -->
          <div class="modal fade" id="assignMembers" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="surveyLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
              <form method="post" action="{{ route('projects.update', $project->id) }}">
                  @csrf
                  @method('PATCH')
                <div class="modal-header">
                  <h5 class="modal-title" id="surveyLabel">
                    Assign Member To {{ $project->name }}
                  </h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                  <div class="mb-3">
                    <label for="name" class="form-label">
                      Update Project Name
                    </label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameDescription" value="{{  $project->name ?? old('name') }}">
                    @error('name')
                    <p class="text-danger">
                      {{ $message }}
                    </p>
                    @else
                    <div id="nameDescription" class="form-text">
                      Name of the Project
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="project_id" value="{{ $project->id }}">

                  <!-- Members Input -->
                  <div class="col mt-3 mb-4">
                    @foreach($users as $user)
                      <div class="form-check form-check-inline">
                        <input type="checkbox" name="users[]" class="form-check-input @error('users') is-invalid @enderror" id="{{ $user->first_name }}" value="{{ $user->id }}">
                        <label class="form-check-label" for="{{ $user->first_name }}">
                          {{ $user->first_name . ' ' . $user->last_name }}
                        </label>

                        @error('users')
                          <div class="invalid-feedback bg-light rounded text-center" role="alert">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    @endforeach
                  </div>
                  <!-- End Members Input -->  
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    Update
                  </button>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!-- End Assign Members Modal -->

          <!-- Create Survey Modal -->
          <div class="modal fade" id="createSurvey" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="surveyLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
              <form method="post" action="{{ route('surveys.store') }}">
                    @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="surveyLabel">
                    Create A New Survey For This Project
                  </h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                  <div class="mb-3">
                    <label for="survey_name" class="form-label">
                      Survey Name
                    </label>
                    <input type="text" class="form-control" name="survey_name" id="survey_name" aria-describedby="nameDescription" value="{{ old('survey_name') }}">
                    @error('survey_name')
                    <p class="text-danger">
                      {{ $message }}
                    </p>
                    @else
                    <div id="nameDescription" class="form-text">
                      Name of the Survey
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    Create
                  </button>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!-- End Create Survey Modal -->
        </div>
      </div>

      <div class="row">
        @canany(['admin','head','ceo','manager','coordinator','client'])
        <div class="col-4">
          <ul class="list-group">
              <li class="list-group-item list-group-item-action active" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">
                      {{ count($members) }} Project Team Members
                  </h5>
                </div>
              </li>

            @foreach($members as $member)
            <dl class="list-group-item">
              <dt>
                {{ $member->first_name . ' ' . $member->last_name }}
              </dt>
              <dd>
                User Role Here
              </dd>
            </dl>
            @endforeach
          </ul>
        </div>
        @endcan
        <div class="col-8">
          <hr>

          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Survey</th>
                  @canany(['admin','ceo','head','manager','scripter'])
                    <th>
                      Stage
                    </th>
                    <th>
                      Actions
                    </th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                @foreach($surveys as $survey)
                <tr>
                  <td>
                    {{ $survey->id }}
                  </td>
                  <td>
                    @canany(['scripter','coordinator'])
                      {{ $survey->survey_name }}
                    @endcan

                    @canany(['admin','supervisor','agent'])
                      <a href="{{ route('surveys.show', $survey->id) }}">
                        {{ $survey->survey_name }}
                      </a>
                    @endcan

                    @canany(['qc'])
                      <a href="{{ route('results.show', $survey->id) }}">
                        {{ $survey->survey_name }}
                      </a>
                    @endcan
                  </td>
                  @canany(['head','manager','scripter'])
                  <td>
                    {{ $survey->stage }}
                  </td>
                  <td>
                    

                    <!-- Survey Edit Modal -->
                    <div class="modal fade" id="edit-survey-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="stageLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="stageLabel">
                             Edit {{ $survey->survey_name }}
                            </h5>
                            <button type="button" class="btn btn-outline-info btn-sm float-end" data-coreui-dismiss="modal">
                              x
                            </button>
                          </div>
                          <div class="modal-body"> 
                            <form action="{{ route('surveys.update', $survey->id) }}" method="post">
                              @csrf
                              @method('PATCH')

                              <div class="mb-3">
                                <label for="survey_name" class="form-label">
                                  Edit Survey Name
                                </label>
                                <input type="text" name="survey_name" class="form-control" id="survey_name" value="{{ $survey->survey_name }}">
                              </div>

                              <div class="mb-3">
                                <label for="stage" class="form-label">
                                  Change Stage
                                </label>
                                <select name="stage" class="form-select" aria-label="Default select example">
                                <option value="Draft" selected>
                                  Draft
                                </option>
                                <option value="Test">
                                  Test
                                </option>
                                <option value="Production">
                                  Production
                                </option>
                                <option value="Closed">
                                  Closed
                                </option>
                              </select>
                              </div>

                              <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                  Update
                                </button>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Survey Edit Modal -->
                  
                    @canany(['admin','ceo','head','manager','scripter'])
                    <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
                      <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-warning" target="_blank" rel="noreferrer">
                        Script
                      </a>

                      <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#edit-survey-{{ $survey->id }}" title="Edit Survey Name or Change Survey Stage">
                        <i class="fas fa-pen"></i>
                      </button>
                      
                      <a href="" class="btn btn-outline-primary" title="View Tool">
                        Tool
                      </a>

                      <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results-{{ $survey->id }}" title="Survey Results Actions">
                        Results
                      </button>

                      <a href="{{ route('results.show', $survey->id) }}" class="btn btn-outline-success" title="View Analytics" rel="noopener" target="_blank">
                        Analytics
                      </a>
                    </div>
                    @endcan

                    <!-- Survey Results Modal -->

                    <div class="modal fade" id="results-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                              Available Data Formats For Download
                            </h5>
                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="table-responsive">

                              <table class="table table-sm align-middle">
                                <thead>
                                  <tr>
                                    <th scope="col">
                                      Survey Results 
                                    </th>
                                  </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                  <tr>
                                    <td>
                                      <div class="btn-group btn-group-sm" role="group" aria-label="Scripter Actions">
                                        <a href="{{ url('csv_export', $survey->id) }}" class="btn btn-outline-warning" title="CSV Format">
                                          <i class="fas fa-file-csv"></i>
                                          CSV
                                        </a>
                                        <a href="{{ url('xlsx_export', $survey->id) }}" class="btn btn-outline-dark" title="Excel Format">
                                          <i class="far fa-file-spreadsheet" style="color: #3d3846;"></i>
                                          Excel Sheets
                                        </a>
                                        <a href="{{ url('pdf_export', $survey->id) }}" class="btn btn-outline-dark" title="Portable Document Format">
                                          <i class="fas fa-file-pdf" style="color: #ef2929;"></i>
                                          PDF
                                        </a>
                                        <a href="!#" class="btn btn-outline-primary" title="JSON Format" title="Curre">
                                          <i class="fas fa-brackets-curly"></i>
                                          JSON
                                        </a>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- End Survey Results Modal -->
                  </td>
                  @endcan
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection