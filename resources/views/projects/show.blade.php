@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
          <div class="row">
            <div class="col">
              <h2>
                {{ $project->name }}
                <span class="badge bg-info">
                  {{ $project->database }}
                </span>
              </h2>
            </div>
            <div class="col text-end">
              @include('partials.alerts')
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
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Project Duration</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $project->start_date }}</td>
                  <td>{{ $project->end_date }}</td>
                  <td>
                    <?php
                      use Illuminate\Support\Carbon;
                      $start_date = Carbon::parse($project->start_date);
                      $end_date = Carbon::parse($project->end_date);

                      echo $start_date->diffInDays($end_date) . 'days';
                    ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col">
          <div class="btn-group" role="group" aria-label="Project Actions">
            <a href="{{ url('survey_creator') }}" class="btn btn-outline-warning">
              Script Here
            </a>
            <a href="{{ url('survey_creator_new_tab') }}" class="btn btn-outline-warning" target="_blank">
              Script In A New Tab
            </a>
          </div>
        </div>
      </div>

      <div class="row">
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
                Role
              </dd>
            </dl>
            @endforeach
          </ul>
        </div>
        <div class="col">
          
        </div>
      </div>
    </div>
  </div>
</div>


@endsection