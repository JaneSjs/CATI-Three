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
        <!-- First Name input -->
        <div class="form-outline mb-4">
          <input type="text" name="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name') }}"/>
            @error('first_name')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Last Name input -->
        <div class="form-outline mb-4">
          <input type="text" name="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name') }}"/>
            @error('last_name')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}"/>
            @error('email')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Extension Number input -->
        <div class="form-outline mb-4">
          <input type="number" name="ext_no" class="form-control form-control-lg @error('ext_no') is-invalid @enderror" placeholder="Caller's Extension Number" value="{{ old('ext_no') }}"/>
            @error('ext_no')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Password input -->
        <div class="form-outline mb-3 invisible">
          <input type="password" value="buzzword" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" />
          @error('password')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Password Confirmation input -->
        <div class="form-outline mb-3 invisible">
          <input type="password" value="buzzword" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Password" />
          @error('password_confirmation')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </form>
    </div>
  </div>
</div>


@endsection