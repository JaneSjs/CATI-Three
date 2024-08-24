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
            <a href="{{ route('interviews_dashboard', $project->id) }}" class="btn btn-outline-primary float-end" id="dpiaBtn">
              <i class="fa-solid fa-gauge nav-icon"></i>
              Dashboard
            </a>
          @endcan
          @canany(['admin','manager','coordinator','client'])
            <div class="toast show">
              <div class="toast-header bg-info text-light">
                <strong>
                  {{ $project->dpia->dpia_approval ?? 'Pending DPIA Approval' }}
                </strong>
                <button type="button" class="btn-close" data-coreui-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                <i class="fa-solid fa-database text-warning"></i>
                {{ $project->database ?? 'Feature Coming Soon' }}
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
                  @canany(['admin','ceo','head','manager','finance','coordinator','scripter','dpo'])
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  @endcan
                  <th scope="col">Project Duration</th>
                  @canany(['admin','ceo','head','manager','finance'])
                  <th scope="col">
                    Performance Reports
                  </th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php
                  use Illuminate\Support\Carbon;

                  $start_date = Carbon::parse($project->start_date);
                  $end_date = Carbon::parse($project->end_date);
                ?>
                <tr>
                  @canany(['admin','ceo','head','manager','finance','coordinator','scripter','dpo'])
                  <td>{{ $start_date->format('d/m/Y') }}</td>
                  <td>{{ $end_date->format('d/m/Y') }}</td>
                  @endcan
                  <td>
                    {{ $start_date->diffInDays($end_date) . ' days' }}
                  </td>
                  @canany(['admin','ceo','head','manager','finance'])
                  <td>
                    <a href="{{ route('interviewers_project_report', $project->id) }}" class="btn btn-outline-primary btn-sm">
                      Interviewers
                    </a>
                    <a href="{{ route('qcs_project_report', $project->id) }}" class="btn btn-outline-info btn-sm">
                      QC's
                    </a>
                    <a href="javascript:void" class="btn btn-secondary btn-sm" title="Coming Soon">
                      Supervisors
                    </a>
                  </td>
                  @endcan
                </tr>
              </tbody>
            </table>
            <table class="table table-sm caption-top">

              <tbody>
                <tr>
                  @canany(['admin','ceo','head','manager','coordinator','scripter'])
                  <td>
                    <form action="{{ route('interview_schedules.index') }}">
                      <input type="hidden" name="project_id" value="{{ $project->id }}">
                      
                      <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-file-pen"></i>
                        Scheduled Interviews
                      </button>
                    </form>
                  </td>
                  @endcan
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-4">
          <div class="btn-group" role="group" aria-label="Create Survey and Assign Members to Projects Button">
          @canany(['admin','ceo','head','manager','coordinator','dpo','finance'])
            <a href="{{ route('attendanceList', $project->id) }}" class="btn btn-outline-primary btn-sm" title="Project Attendance List">
              Attendance List
            </a>
          @endcan
          @canany(['admin','ceo','head','manager'])
            <a href="javascript:void(0)" class="btn btn-outline-success btn-sm" title="Project Recordings (Coming Soon!)" onclick="event.preventDefault();">
                Recordings
            </a>
          @endcan
          </div>
          <div class="btn-group btn-group-sm mt-2" role="group" aria-label="Create Survey and Assign Members To The Projects">
            @canany(['admin','manager','coordinator','supervisor'])
              <button type="button" class="btn btn-outline-success" data-coreui-toggle="modal" data-coreui-target="#assignMoreMembers">
                Assign More Members
              </button>
              @include('projects.partials.assign_more_members')
            @endcan

            @canany(['admin'])
              <button type="button" class="btn btn-secondary" data-coreui-toggle="modal" data-coreui-target="#assignSpecificMembers">
                Assign Specific Members
              </button>
              @include('projects.partials.assign_specific_members')
            @endcan

            @canany(['admin','ceo','head','manager','scripter'])
              @if(count($surveys) == 7)
                <!-- Prevent Many Surveys Under A Single Project (Temporary Measure) -->
                <button type="button" class="btn btn-warning" onclick="alert('Browser Limit Exceeded.(Heavy JSON may Slow Down Your Browser)')">
                  Create Survey
                </button>
              @else
                <!-- Trigger Survey Modal -->
                <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#createSurvey">
                  Create Survey
                </button>
              @endif
            @endcan
           
          </div>
          <!-- Create Survey Modal -->
          @include('projects.partials.create_survey')
          <!-- End Create Survey Modal -->
        </div>
      </div>

      <div class="row m-3">
        @canany(['admin','ceo','head','manager'])
        <div class="col">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead class="table-dark">
                <tr>
                  <th>
                    {{ count($all_members) }} Members
                  </th>
                  <th>Roles</th>
                </tr>
              </thead>
              <tbody>
                @foreach($members as $member)
                <tr title="{{ $member->first_name . ' ' . $member->last_name }}">
                  <td>
                    {{ $member->first_name . ' ' . $member->last_name }}
                  </td>
                  <td>
                    @foreach($member->roles as $role)
                      <span class="badge text-light text-bg-info">
                        <small>{{ $role->name }}</small>
                      </span>
                    @endforeach
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $members->links() }}
              </tfoot>
            </table>
          </div>
          
        </div>
        @endcan
        <div class="col">
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
                    @if(auth()->user()->national_id)
                      <td>
                        <a href="{{ route('surveys.show', $survey->id) }}">
                          {{ $survey->survey_name }}
                        </a>
                      </td>
                    @else
                      <div class="alert alert-warning">
                        <h6>
                          Please Update The Following To Proceed:
                        </h6>
                        <ul class="list-group">
                          <li class="list-group-item">
                            Your National Id Number
                          </li>
                          <li class="list-group-item">
                            Your Phone Number
                          </li>
                          <li class="list-group-item">
                            <a href="{{ route('profiles.show', auth()->user()->id) }}">
                              Click Here To Update
                            </a>
                          </li>
                        </ul>
                      </div>
                    @endif
                  @else
                  <td title="@canany(['admin','ceo','head','manager','coordinator','dpo']) {{ $survey->type }} @endcan">
                    {{ $survey->survey_name }}
                  </td>
                  @endcan
                  
                  @canany(['admin','ceo','head','manager','coordinator','scripter','dpo','client'])
                  <td>
                    @if($survey->stage == 'Draft')
                      <span class="badge bg-warning">
                        Draft Stage
                      </span>
                    @elseif($survey->stage == 'Pilot')
                      <span class="badge bg-primary">
                        Pilot Stage
                      </span>
                    @elseif($survey->stage == 'Production')
                      <span class="badge bg-success">
                        Production
                      </span>
                    @elseif($survey->stage == 'Closed')
                      <span class="badge bg-danger">
                        Survey Closed
                      </span>
                    @endif
                  </td>
                  @endcan

                  <td>
                    
                    <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
                      @canany(['admin','ceo','client'])
                        <a href="{{ route('begin_interview', [$project->id, $survey->id, 1]) }}" class="btn btn-outline-dark">
                          Preview Survey
                        </a>
                      @endcan

                      @canany(['interviewer'])
                        @if($survey->stage == 'Production')
                        <a href="{{ route('begin_interview', [$project->id, $survey->id, 1]) }}" class="btn btn-outline-dark">
                          Begin Interview
                        </a>
                        @elseif($survey->stage == 'Draft')
                          <span class="badge bg-warning">
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
                        @if($survey->stage != 'Production')
                          <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-dark" target="_blank">
                            Script
                          </a>
                        @endif
                      @endcan

                      @canany(['admin','manager','scripter'])
                      <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#edit-survey-{{ $survey->id }}" title="Edit Survey Name or Change Survey Stage">
                        <i class="fas fa-pen"></i>
                      </button>
                      @endcan
                      
                      @canany(['admin','ceo','head','manager','scripter'])
                      <!--<a href="" class="btn btn-outline-primary" title="Pending SurveyJs Developer Licence">
                        Tool
                      </a>-->
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

                      @canany(['admin','ceo','head','manager','dpo'])
                      <a href="{{ route('project_survey_respondents', [$project->id, $survey->id]) }}" class="btn btn-outline-info btn-sm" title="{{ $survey->survey_name ?? 'Survey' }} Respondents">
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