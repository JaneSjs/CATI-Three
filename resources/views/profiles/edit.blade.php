@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-8">
          <h2>Update Your Details</h2>
          
        </div>
        <div class="col-4">
          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <form class="needs-validation"  action="{{ route('profiles.update', $user->id) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="row mb-3">
          <div class="col">
              <div class="form-outline mb-4">
              <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ $user->first_name }}" readonly/>
              <label for="first_name" class="form-text-label text-primary">First Name</label>
              @error('first_name')
              <div class="invalid-feedback bg-light rounded text-center" role="alert">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col">
              <div class="form-outline mb-4">
              <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ $user->last_name }}" readonly/>
              <label for="last_name" class="form-text-label text-primary">Last Name</label>
              @error('last_name')
              <div class="invalid-feedback bg-light rounded text-center" role="alert">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="row mb-3">
          <div class="col">
              <div class="form-outline mb-4">
              <input type="text" name="phone_1" id="phone_1" class="form-control @error('phone_1') is-invalid @enderror" placeholder="Primary Phone Number" value="{{ $user->phone_1 }}"/>
              <label for="phone_1" class="form-text-label text-primary">
                Primary Phone Number
              </label>
              @error('phone_1')
              <div class="invalid-feedback bg-light rounded text-center" role="alert">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col">
              <div class="form-outline mb-4">
              <input type="text" name="phone_2" id="phone_2" class="form-control @error('phone_2') is-invalid @enderror" placeholder="Secondary Phone Number" value="{{ $user->phone_2 }}"/>
              <label for="phone_2" class="form-text-label text-primary">
                Secondary Phone Number
              </label>
              @error('phone_2')
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
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ $user->email }}" readonly/>
              <label for="email" class="form-text-label text-primary">Email</label>
              @error('email')
              <div class="invalid-feedback bg-light rounded text-center" role="alert">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <!-- Extension Number input -->
          <div class="col">
              <div class="form-floating form-outline mb-4">
                <input type="number" name="ext_no" id="ext_no" class="form-control @error('ext_no') is-invalid @enderror" placeholder="Caller's Extension Number" value="{{ $user->ext_no }}"/>
                <label for="ext_no" class="form-text-label text-primary">Ext No</label>
                  @error('ext_no')
                  <div class="invalid-feedback bg-light rounded text-center" role="alert">
                    {{ $message }}
                  </div>
                  @enderror
              </div>
          </div>
        </div>   

        <button type="submit" class="btn btn-primary">
          Update
        </button>
      </form>
    </div>
  </div>
</div>


@endsection