@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>Register A New User</h2>
        </div>
        <div class="col">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
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
      <form action="{{ route('users.store') }}" method="post">
        @csrf

        <div class="row">
          <!-- First Name input -->
          <div class="col">
            <div class="form-outline mb-4">
              <input type="text" name="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name') }}"/>
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
              <input type="text" name="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name') }}"/>
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
              <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}"/>
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
                <input type="number" name="ext_no" class="form-control form-control-lg @error('ext_no') is-invalid @enderror" placeholder="Caller's Extension Number" value="{{ old('ext_no') }}"/>
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
              <input type="checkbox" name="roles[]" class="form-check-input @error('roles') is-invalid @enderror" id="{{ $role->name }}" value="{{ $role->id }}">
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
          Create
        </button>
      </form>
    </div>
  </div>
</div>


@endsection