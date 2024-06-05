@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h5>
            #{{ $project->id }}
          </h5>
          <h2 class="text-primary">{{ $project->name }}</h2>
          @canany(['admin','interviewer'])
            <button type="button" class="btn btn-outline-primary float-end" id="dpiaBtn">
              <i class="fa-solid fa-gauge nav-icon"></i>
              Dashboard
            </button>
          @endcan
          @canany(['admin','manager','coordinator','client'])
            <!-- <button type="button" class="btn btn-primary" id="dpiaBtn">
              DPIA
            </button> -->

            <div class="toast show">
              <div class="toast-header bg-info text-light">
                <strong>
                  {{ $project->dpia->dpia_approval ?? 'Pending DPIA Approval' }}
                </strong>
                <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                <i class="fa-solid fa-database text-warning"></i>
                {{ $project->database ?? 'Pending Respondents Database To Be Used' }}
              </div>
            </div>
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
        <div class="col-8">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <thead class="table-success">
                <tr>
                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  @endcan
                  <th scope="col">Project Duration</th>
                  @canany(['admin','ceo','finance'])
                  <th scope="col">Reports</th>
                  @endcan
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
                  @canany(['admin','ceo','finance'])
                  <td>
                    <a href="{{ route('interviewers_report', $project->id) }}" class="btn btn-outline-primary btn-sm">
                      Interviewers
                    </a>
                    <a href="" class="btn btn-outline-info btn-sm">
                      QC's
                    </a>
                    <a href="" class="btn btn-secondary btn-sm">
                      Supervisors
                    </a>
                  </td>
                  @endcan
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-4">
          <div class="btn-group" role="group" aria-label="Create Survey and Assign Members to Projects Button">
          @canany(['admin','head','manager','coordinator'])
            <a href="{{ route('interviewers', $project->id) }}" class="btn btn-outline-primary btn-sm" title="Project Interviewers">
              Interviewers List
            </a>
            <a href="" class="btn btn-outline-success btn-sm" title="Project Recordings">
              Recordings
            </a>
          @endcan
          </div>
          <div class="btn-group mt-2" role="group" aria-label="Create Survey and Assign Members to Projects Button">
            @canany(['admin','head','manager','coordinator','scripter','supervisor'])
              <!-- Trigger Members Assignment Modal -->
              <button type="button" class="btn btn-outline-success btn-sm" data-coreui-toggle="modal" data-coreui-target="#assignMembers">
                Assign Members
              </button>
            @endcan

            @canany(['admin','head','manager','scripter'])
              <!-- Trigger Survey Modal -->
              <button type="button" class="btn btn-warning btn-sm" data-coreui-toggle="modal" data-coreui-target="#createSurvey">
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
        <div class="col-3">
          <ul class="list-group">
              <li class="list-group-item list-group-item-action active" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">
                      {{ count($members) }} Project Team Members
                  </h6>
                </div>
              </li>

            <dl class="list-group-item">
              @foreach($members as $member)
              <dt title="{{ $member->first_name . ' ' . $member->last_name }}">
                <small>
                  {{ $member->first_name . ' ' . $member->last_name }}
                </small>
              </dt>
              <dd>
                @foreach($member->roles as $role)
                  <span class="badge text-light text-bg-info small">
                    <small>{{ $role->name }}</small>
                  </span>
                @endforeach
              </dd>
              @endforeach

              {{ $members->links() }}
            </dl>

          </ul>
        </div>
        @endcan
        <div class="col-9">
          <hr>

          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th title="Survey Id">Id</th>
                  <th>Surveys</th>
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

                  <td title="Survey {{ $survey->survey_name }} Id" class="bg-primary text-light">
                    <strong>
                      {{ $survey->id }}
                    </strong>
                  </td>

                  @canany(['qc'])
                  <td>
                    <a href="{{ route('surveys.show', $survey->id) }}">
                      {{ $survey->survey_name }}
                    </a>
                  </td>
                  @else
                  <td title="@canany(['admin','ceo','head','manager']) {{ $survey->type }} @endcan">
                    {{ $survey->survey_name }}
                  </td>
                  @endcan
                  
                  @canany(['admin','head','manager','coordinator','scripter'])
                  <td>
                    <span class="badge bg-dark">
                      {{ $survey->stage }}
                    </span>
                  </td>
                  @endcan

                  <td>
                    
                    <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
                      @canany(['interviewer'])
                        @if($survey->stage == 'Production')
                        <a href="{{ route('begin_interview', [$project->id, $survey->id, 1]) }}" class="btn btn-outline-dark">
                          Begin Interview
                        </a>
                        @elseif($survey->stage == 'Draft')
                          <span class="badge bg-info">
                            Draft Stage
                          </span>
                        @elseif($survey->stage == 'Pilot')
                          <span class="badge bg-primary">
                            Pilot Stage
                          </span>
                        @elseif($survey->stage == 'Closed')
                          <span class="badge bg-danger">
                            Survey Closed
                          </span>
                        @endif
                      @endcan

                      @canany(['admin','scripter'])
                        <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-dark" target="_blank">
                          Script
                        </a>
                      @endcan

                      @canany(['admin','manager','scripter'])
                      <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#edit-survey-{{ $survey->id }}" title="Edit Survey Name or Change Survey Stage">
                        <i class="fas fa-pen"></i>
                      </button>
                      @endcan
                      
                      @canany(['admin','ceo','head','manager','scripter'])
                      <a href="" class="btn btn-outline-primary" title="Pending SurveyJs Developer Licence">
                        Tool
                      </a>
                      @endcan

                      @canany(['admin','ceo','head','manager'])
                      <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#results-{{ $survey->id }}" title="Survey Results Actions">
                        Results
                      </button>
                      @endcan

                      @canany(['admin','ceo','head','manager','coordinator'])
                      <button type="button" class="btn btn-outline-danger" data-coreui-toggle="modal" data-coreui-target="#quotas-{{ $survey->id }}" title="Set Quota Criteria">
                        Set Quotas
                      </button>
                      <a href="{{ route('operations', $survey->id) }}" class="btn btn-outline-dark" title="Monitor Survey Progress">
                        Operations
                      </a>

                      <a href="{{ route('analytics.show', $survey->id) }}" class="btn btn-outline-success" title="View Analytics" rel="noopener" target="_blank">
                        Analytics
                      </a>
                      @endcan

                      @canany(['admin','ceo','head','manager','coding'])
                      <a href="{{ route('coding', $interview->id ?? 1) }}" class="btn btn-outline-dark" title="Coding ">
                        <i class="fa-solid fa-arrow-up-a-z fa-bounce"></i>
                      </a>
                      <a href="{{ route('project_survey_respondents', [$project->id, $survey->id]) }}" class="btn btn-outline-info btn-sm" title="Survey Respondents">
                        Respondents
                      </a>
                      @endcan
                    </div>

                    <!--  Script Modal -->
                      @include('projects.partials.script_modal')
                    <!--  Script Modal -->

                    <!-- Survey Edit Modal -->
                      @include('projects.partials.edit_survey')
                    <!-- End Survey Edit Modal -->

                    <!-- Survey Results Modal -->
                      @include('projects.partials.results_modal')
                    <!-- End Survey Results Modal -->

                    <!-- Set Survey Quotas Modal -->
                      @include('projects.partials.quotas_modal')
                    <!-- End Set Survey Quotas Modal -->
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