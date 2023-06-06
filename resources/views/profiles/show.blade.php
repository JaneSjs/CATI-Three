@extends('layouts.main')
    
@section('content')


<section class="h-100 gradient-custom-2 mb-4">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top bg-primary text-white d-flex flex-row" style=" height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="{{ asset('assets/images/male-avatar.png') }}"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px; z-index: 1">
              <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;">
                Edit profile
              </button>
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <h5>
                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
              </h5>
              <p>
                {{ auth()->user()->email }}
              </p>
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
              <div>
                <p class="mb-1 h5">
                  {{ count($projects) }}
                </p>
                <p class="small text-muted mb-0">Projects</p>
              </div>
              @if($surveys)
              <div class="px-3">
                <p class="mb-1 h5">
                  {{ count($surveys) }}
                </p>
                <p class="small text-muted mb-0">Surveys</p>
              </div>
              @endif
              <div class="">
                <h5 class="mb-1">
                  Ext No ({{ $user->ext_no }})
                </h5>
              </div>
            </div>
          </div>
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">System Role(s)</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                @foreach($user->roles as $role)
                  <p class="font-italic mb-1">
                    {{ $role->name }}
                  </p>
                @endforeach
              </div>
            </div>
            @if(count($projects) > 0)
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Recent Projects</p>
              <p class="mb-0"><a href="{{ route('projects.index') }}" class="text-muted">Show all</a></p>
            </div>
            <div class="row g-2">
                <ul class="list-group">
                  @foreach($projects as $project)
                  <li class="list-group-item">
                    Project 1
                  </li>
                  @endforeach
                </ul>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection