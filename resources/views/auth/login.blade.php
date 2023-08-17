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
            <form method="post" action="{{ route('login') }}" class="needs-validation">
            	@csrf

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Your email address" value="{{ old('email') }}"/>
                @error('email')
                	<div class="invalid-feedback bg-light rounded text-center" role="alert">
                	    {{ $message }}
                	</div>
              	@enderror
              </div>

              <!-- Password input -->
              <div class="form-outline mb-3">
                <input type="password" name="password" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Password" />
                @error('password')
                	<div class="invalid-feedback bg-light rounded text-center" role="alert">
                      {{ $message }}
                  </div>
              	@enderror
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" name="remember" value="true" id="remember_me" />
                  <label class="form-check-label" for="remember_me">
                    Remember me
                  </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-body">
                  Forgot password?
                </a>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">
                  Login
              	</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Don't have an account?
                  <a href="{{ route('register') }}" class="link-primary">
                    Sign Up
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