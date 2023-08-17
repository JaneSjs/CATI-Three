@extends('layouts.auth')

@section('content')

<section class="vh-100 mt-4">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{ asset('assets/images/call-center.jpg') }}"
              class="img-thumbnail img-fluid" style="height: 500px; width: 500px;" alt="TIFA Call Center">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          	<div class="bg-light p-3 border border-primary rounded my-4">
          		@if(session('status'))
                @include('partials.alerts')
              @else
                <h5 class="text-primary">
                  Forgotten Your Password? 
                </h5>
                <h5 class="text-primary">
                  Don't worry, We'll email you a Password Reset Link.
                </h5>
              @endif
          	</div>
            @if(session('status'))
              <p class="small fw-bold mt-2 pt-1 mb-0">
                Having Trouble ?
                <span  class="link-primary">
                  Talk To Your Supervisor
                  <i class="fa-solid fa-user-tie fa-bounce"></i>
                </span>
              </p>
            @else
              <form method="post" action="{{ route('password.email') }}" class="needs-validation">
              	@csrf

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"  placeholder="Enter Your Email"/>
                  @error('email')
                  	<div class="invalid-feedback bg-light rounded text-center" role="alert">
                  	    {{ $message }}
                  	</div>
                	@enderror
                </div>


                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">
                    Send Password Reset Link
                	</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">
                    <a href="{{ route('login') }}" class="link-primary">
                      Login Page
                    </a>
                  </p>
                </div>

              </form>
            @endif
          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary fixed-bottom">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
          TIFA Research Ltd © <?= date('Y') ?>. All rights reserved.
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