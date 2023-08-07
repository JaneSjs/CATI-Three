@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    @include('partials.alerts')
    @canany(['admin','ceo','head','manager'])
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('users.index') }} ">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  {{ $users->count() }} 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-user-lock fa-xl"></i>
                  </span></div>
                <div>System Users</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('projects.index') }}">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  {{ $projects->count() }} 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-user-lock fa-xl"></i>
                  </span></div>
                <div>Projects</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('surveys.index') }}">
          <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  {{ $surveys->count() }} 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-user-lock fa-xl"></i>
                  </span>
                </div>
                <div>Surveys</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $supervisors->count() }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-user-lock fa-xl"></i>
                </span>
              </div>
              <div>Supervisors</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endcan

    @canany(['admin','qc','agent'])
    <!-- /.row-->
    <div class="card mb-4">
      <div class="card-header">
        <h4 class="card-title mb-0">
          My Report
        </h4>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">Interview Id</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">Respondent Id</th>
                  <th scope="col">Respondent Name</th>
                  <th scope="col">Interview Date</th>
                  <th scope="col">Phone Called</th>
                  <th scope="col">Interview Status</th>
                  @canany(['admin','coordinator'])
                    <th scope="col">QC Name</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                @foreach($interviews as $interview)
                <tr>
                  <th scope="row">1</th>
                  <td>{{ $interview->id }}</td>
                  <td>{{ $interview->user->first_name }}</td>
                  <td>{{ $interview->respondent->name }}</td>
                  <td>{{ $interview->start_time }}</td>
                  <td>{{ $interview->phone_called }}</td>
                  @canany(['admin','coordinator'])
                  <td></td>
                  @endcan
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
      <div class="card-footer">
        
      </div>
    </div>
    <!-- /.card.mb-4-->
    @endcan
  </div>
</div>


@endsection