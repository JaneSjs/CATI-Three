@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
          <div class="row">
            <div class="col">
              <h2> {{ $user->last_name }}'s Details</h2>
            </div>
            <div class="col text-end">
              @include('partials.alerts')
            </div>
          </div>
          
    </div>
    <div class="card-body">
      <form method="post" action="{{ url('password_reset_link') }}">
        @csrf
        <div class="d-none">
          <input type="email" name="email" value="{{ $user->email }}">
        </div>
        <button type="submit" class="btn btn-info">
          Send Activation Link
        </button>
      </form>
      <hr>
      <ul>
        @foreach($roles as $role)
          <li>{{ $role->name }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>


@endsection