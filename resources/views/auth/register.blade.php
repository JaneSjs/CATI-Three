@extends('layouts.auth')

@section('content')

<section class="vh-100 mt-4">
      <div class="container-fluid h-custom bg-warning">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{ asset('assets/images/survey.jpg') }}"
              class="img-thumbnail img-fluid" style="height: 500px; width: 500px;" alt="TIFA Call Center">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          	<div class="bg-light p-3 border border-primary rounded my-4">
          		<h3 class="text-primary">
                TIFA Research Ltd
              </h3>
              @include('partials.alerts')
          	</div>
            <form method="post" action="{{ route('register') }}" class="needs-validation">
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

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Your email address" value="{{ old('email') }}"/>
                @error('email')
                	<div class="invalid-feedback bg-light rounded text-center" role="alert">
                	    {{ $message }}
                	</div>
              	@enderror
              </div>

              <div class="row">
                <!-- Password input -->
                <div class="col">
                  <div class="form-outline mb-3">
                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" />
                    @error('password')
                      <div class="invalid-feedback bg-light rounded text-center" role="alert">
                          {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <!-- Confirm Password input -->
                <div class="col">
                  <div class="form-outline mb-3">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Verify Password" />
                    @error('password')
                      <div class="invalid-feedback bg-light rounded text-center" role="alert">
                          {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">
                  Register
              	</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Already Registered ? 
                  <a href="{{ route('login') }}" class="link-primary">
                    Login
                  </a>
                </p>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary fixed-bottom">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
          Copyright © <?= date('Y') ?>. All rights reserved.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div>
          <!-- <a href="#!" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#!" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#!" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="#!" class="text-white">
            <i class="fab fa-linkedin-in"></i>
          </a> -->
        </div>
        <!-- Right -->
      </div>
    </section>

@endsection