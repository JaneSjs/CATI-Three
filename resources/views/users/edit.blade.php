@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-8">
          <h2>Edit {{ $user->last_name }}'s Details</h2>
          <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="first_name" value="{{ $user->first_name }}">
            <input type="hidden" name="last_name" value="{{ $user->last_name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="ext_no" value="{{ $user->ext_no }}">
            <!-- Roles Input -->
            <div class="col mb-4">
              @foreach($user->roles as $role)
              <div class="form-check form-check-inline">
                <input type="checkbox" name="roles[]" class="form-check-input @error('ext_no') is-invalid @enderror" id="{{ $role->name }}" value="{{ $role->id }}" checked disabled>
                <label class="form-check-label" for="{{ $role->name }}">
                  {{ $role->name }}
                </label>

                @error('roles')
                  <div class="invalid-feedback bg-light rounded text-center" role="alert">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              @endforeach
            </div>
            <!-- End Roles Input -->
            <input type="hidden" name="password">
            <button type="submit" class="btn btn-outline-danger btn-sm">
              Deactivate {{ $user->first_name . ' ' . $user->first_name }}
            </button>
          </form>
        </div>
        <div class="col-4">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @elseif (session('warning'))
            <div class="alert alert-danger">
              {{ session('warning') }}
            </div>
          @elseif (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
          <!-- First Name input -->
          <div class="col">
            <div class="form-outline mb-4">
              <input type="text" name="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ $user->first_name }}"/>
                @error('first_name')
                <div class="invalid-feedback bg-light rounded text-center" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
          </div>

          <!-- Last Name input -->
          <div class="col">
            <div class="form-outline mb-4">
              <input type="text" name="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ $user->last_name }}"/>
                @error('last_name')
                <div class="invalid-feedback bg-light rounded text-center" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
          </div>
        </div>
        
        <div class="row">
          <!-- Email input -->
          <div class="col">
            <div class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" value="{{ $user->email }}"/>
                @error('email')
                <div class="invalid-feedback bg-light rounded text-center" role="alert">
                  {{ $message }}
                </div>
                @enderror
            </div>
          </div>

          <!-- Extension Number input -->
          <div class="col">
              <div class="form-outline mb-4">
                <input type="number" name="ext_no" class="form-control form-control-lg @error('ext_no') is-invalid @enderror" placeholder="Caller's Extension Number" value="{{ $user->ext_no }}"/>
                  @error('ext_no')
                  <div class="invalid-feedback bg-light rounded text-center" role="alert">
                    {{ $message }}
                  </div>
                  @enderror
              </div>
          </div>
        </div>   
        
        <!-- Roles Input -->
        <div class="col mb-4">
          @foreach($roles as $role)
            <div class="form-check">
              <input type="checkbox" name="roles[]" class="form-check-input @error('ext_no') is-invalid @enderror" id="{{ $role->name }}" value="{{ $role->id }}" @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif>
              <label class="form-check-label" for="{{ $role->name }}">
                {{ $role->name }}
              </label>

              @error('roles')
                <div class="invalid-feedback bg-light rounded text-center" role="alert">
                  {{ $message }}
                </div>
              @enderror
            </div>
          @endforeach
        </div>
        <!-- End Roles Input -->

        <button type="submit" class="btn btn-primary">
          Update
        </button>
      </form>
    </div>
  </div>
</div>


@endsection