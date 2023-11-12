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
          @canany(['admin','manager','coordinator','client'])
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
        <div class="col-4">
          <div class="btn-group" role="group" aria-label="Create Survey and Assign Members to Projects Button">
          @canany(['admin','head','manager','coordinator','scripter'])
            <a href="{{ route('respondents.show', $project->id) }}" class="btn btn-outline-info btn-sm" title="Project Respondents">
              Respondents
            </a>
            <a href="{{ route('interviewers', $project->id) }}" class="btn btn-outline-primary btn-sm" title="Project Interviewers">
              Interviewers
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

            @canany(['admin','head','manager','coordinator','scripter'])
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
                    <span class="badge bg-dark">
                      {{ $survey->stage }}
                    </span>
                  </td>
                  @endcan

                  <td>
                    
                    <div class="btn-group btn-group-sm float-end" role="group" aria-label="Scripter Actions">
                      @canany(['interviewer'])
                        <a href="{{ route('begin_interview', [$project->id, $survey->id, 1]) }}" class="btn btn-outline-dark">
                          Begin Interview
                        </a>
                      @endcan

                      @canany(['admin','scripter'])
                        <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-dark" target="_blank">
                          Script
                        </a>
                      @endcan

                      @canany(['admin','manager'])
                      <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#edit-survey-{{ $survey->id }}" title="Edit Survey Name or Change Survey Stage">
                        <i class="fas fa-pen"></i>
                      </button>
                      @endcan
                      
                      @canany(['admin','ceo','head','manager','scripter'])
                      <a href="" class="btn btn-outline-primary" title="View Tool">
                        Tool
                      </a>
                      @endcan

                      @canany(['admin','ceo','head','manager','coordinator'])
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