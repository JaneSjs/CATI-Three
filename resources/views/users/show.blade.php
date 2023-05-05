@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
          <h2> {{ $user->last_name }}'s Details</h2>
          <form method="post" action="{{ url('password_reset_link') }}">
            @csrf
            <input type="email" name="email" value="{{ $user->email }}">
            <button type="submit" class="btn btn-info">
              Send Activation Link
            </button>
          </form>
    </div>
    <div class="card-body">
      <ul>
        @foreach($roles as $role)
          <li>{{ $role->name }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>


@endsection