@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>
            {{ $project->name }}
            @can('scripter', 'admin', 'manager', 'client')
            <span class="badge bg-info">
              Data {{ $project->database }}
            </span>
            @endcan
          </h2>
        </div>
        <div class="col text-end">
          @include('partials.alerts')
          @include('partials.errors')
        </div>
      </div>
          
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <thead class="table-success">
                <tr>
                  @canany(['head','manager','scripter'])
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  @endcan
                  <th scope="col">Project Duration</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @canany(['head','manager','scripter'])
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
        <div class="col">
          @canany(['head','manager','scripter'])
            <!-- Trigger Survey Modal -->
            <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#createSurvey">
              Create Survey
            </button>
          @endcan

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
        </div>
      </div>

      <div class="row">
        @canany(['admin','head','ceo','manager','supervisor','client'])
        <div class="col">
          <ul class="list-group">
              <li class="list-group-item list-group-item-action active" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">
                      {{ count($users) }} Project Team Members
                  </h5>
                </div>
              </li>


            @foreach($users as $user)
            <dl class="list-group-item">
              <dt>
                {{ $user->first_name . ' ' . $user->last_name }}
              </dt>
              <dd>
                Survey
              </dd>
            </dl>
            @endforeach
          </ul>
        </div>
        @endcan
        <div class="col">
          <hr>

          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Survey</th>
                  @canany(['head','manager','scripter'])
                  <th>
                    Stage
                  </th>
                  <th></th>
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
                    <a href="{{ route('surveys.show', $survey->id) }}">
                      {{ $survey->survey_name }}
                    </a>
                  </td>
                  @canany(['head','manager','scripter'])
                  <td>
                    {{ $survey->stage }}
                  </td>
                  <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#survey-{{ $survey->id }}" title="Change Stage">
                      <i class="fas fa-pen"></i>
                    </button>

                    <!-- Survey Edit Modal -->
                    <div class="modal fade" id="survey-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="stageLabel" aria-hidden="true">
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
                  </td>
                  <td>
                    
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