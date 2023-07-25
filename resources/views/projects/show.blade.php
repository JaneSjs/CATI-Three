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
          @include('projects.partials.assign_members')
          <!-- End Assign Members Modal -->

          <!-- Create Survey Modal -->
          @include('projects.partials.create_survey')
          <!-- End Create Survey Modal -->
        </div>
      </div>

      <div class="row">
        @canany(['admin','head','ceo','manager'])
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
                @foreach($member->roles as $role)
                  <span class="badge text-light text-bg-info">
                    {{ $role->name }}
                  </span>
                @endforeach
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
                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
                    <th>
                      Stage
                    </th>
                  @endcan

                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
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

                  @canany(['qc'])
                  <td>
                      <a href="{{ route('surveys.show', $survey->id) }}">
                        {{ $survey->survey_name }}
                      </a>
                  </td>
                  @else
                  <td>
                    {{ $survey->survey_name }}
                  </td>
                  @endcan
                  
                  @canany(['admin','head','manager','coordinator','scripter'])
                  <td>
                    {{ $survey->stage }}
                  </td>
                  @endcan

                  <td>
                    
                    <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
                      @canany(['agent'])
                        <a href="{{ route('begin_interview', [$project->id, $survey->id, 1]) }}" class="btn btn-outline-dark">
                          Begin Interview
                        </a>
                      @endcan

                      @canany(['admin','scripter'])
                      <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-warning" target="_blank" rel="noreferrer">
                        Script
                      </a>
                      @endcan

                      @canany(['admin','manager'])
                      <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#edit-survey-{{ $survey->id }}" title="Edit Survey Name or Change Survey Stage">
                        <i class="fas fa-pen"></i>
                      </button>
                      @endcan
                      
                      @canany(['admin','manager','scripter'])
                      <a href="" class="btn btn-outline-primary" title="View Tool">
                        Tool
                      </a>
                      @endcan

                      @canany(['admin','coordinator'])
                      <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results-{{ $survey->id }}" title="Survey Results Actions">
                        Results
                      </button>
                      @endcan

                      @canany(['admin','ceo','head','manager','coordinator','client'])
                      <a href="{{ route('analytics.show', $survey->id) }}" class="btn btn-outline-dark" title="Manage Quotas" rel="noopener">
                        Manage Quotas
                      </a>
                      <a href="{{ route('analytics.show', $survey->id) }}" class="btn btn-outline-success" title="View Analytics" rel="noopener" target="_blank">
                        Analytics
                      </a>
                      @endcan

                      @canany(['admin','ceo','head','manager','coding'])
                      <a href="{{ route('coding', $interview->id ?? 1) }}" class="btn btn-outline-dark" title="View Analytics" rel="noopener" target="_blank">
                        Coding
                      </a>
                      @endcan
                    </div>

                    <!-- Survey Edit Modal -->
                      @include('projects.partials.edit_survey')
                    <!-- End Survey Edit Modal -->

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