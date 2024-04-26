@extends('layouts/main')

@section('content')

@include('profiles/includes/edit_profile_modal')

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">
              <a href="#">
                {{ $user->first_name }}
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              {{ $user->first_name . ' ' . $user->last_name }} Profile
            </li>
          </ol>
        </nav>
      </div>
      <div class="col">

        <a href="{{ route('profiles.edit', $user->id) }}" class="btn btn-outline-info float-end">
          <div class="icon me-2">
            <i class="fa-solid fa-pen"></i>
          </div>Edit
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{ asset('assets/images/male-avatar.png') }}" alt="Student Avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">
              {{ $user->first_name . ' ' . $user->last_name }}
            </h5>
            <p class="text-muted mb-1">Pre Primary 1</p>
            <p class="text-muted mb-4">Utu Academy</p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">
                Activate
              </button>
              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">
                Send Invoice
              </button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-school fa-lg text-primary"></i>
                <p class="mb-0">
                  
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-chalkboard-user fa-lg" style="color: #333333;"></i>
                <p class="mb-0">
                  
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fa-solid fa-school-circle-check fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">
                  
                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fa-solid fa-school-flag fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">

                </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">

                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">
                  Full Name
                </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  {{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <ol class="list-group list-group-horizontal mb-0">
                  @foreach($user->roles as $role)
                    <li class="list-group-item active">
                      {{ $role->name }}
                    </li>
                  @endforeach
                </ol>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  {{ $user->email }}
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  {{ $user->phone_1 . ' / ' . $user->phone_2 }}
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Ext No</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  {{ $user->ext_no }}
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">
                  Lavington, Nairobi
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">
                  <span class="text-primary font-italic me-1">
                    {{ count($projects) }} Projects Done
                  </span> 
                </p>
                @foreach($projects as $project)
                <p class="mb-1" style="font-size: .77rem;">
                 {{ $project->name }}
               </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4">
                  <span class="text-primary font-italic me-1">
                    Sporting Activities
                  </span>
                </p>
                <p class="mb-1" style="font-size: .77rem;">
                  Athletics
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">
                  Football
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">
                  Volley Ball
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">
                  Rugby
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">
                  Basket Ball
                </p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection