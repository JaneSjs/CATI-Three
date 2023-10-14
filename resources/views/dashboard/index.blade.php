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
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('users.index') }} ">
          <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start" title="USB Headsets is Preffered">
              <div>
                <div class="fs-4 fw-semibold">
                  30 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-computer fa-xl"></i>
                  </span></div>
                <div>Working Computers</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('projects.index') }}">
          <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  60 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-phone-volume fa-xl"></i>
                  </span></div>
                <div>PBX Capacity - Concurrent Calls</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('surveys.index') }}">
          <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
              <div>
                <div class="fs-4 fw-semibold">
                  - 
                  <span class="fs-6 fw-normal">
                    <i class="fas fa-server fa-xl"></i>
                  </span>
                </div>
                <div>CATI Server Capacity</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $interviewers->count() }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-user-lock fa-xl"></i>
                </span>
              </div>
              <div>Interviewers</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endcan
    
    @canany(['admin','ceo','head','manager','coodinator','supervisor','qc'])
      @include('dashboard/includes/all_interviews')
    @endcan

    @canany(['admin','interviewer'])
      @include('dashboard/includes/user_interviews')
    @endcan
  </div>
</div>


@endsection