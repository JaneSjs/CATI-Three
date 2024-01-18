@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col col-3">
          {{ $respondent->name }}
        </div>
        <div class="col col-3">
          
        </div>
        <div class="col text-end">
          @include('partials/alerts')
          
        </div>
      </div>
      @include('partials/errors')
    </div>
    <div class="card-body">

      <ul class="list-group">
        <li class="list-group-item">
          {{ $respondent->phone_1 }}
        </li>
      </ul>

    </div>
  </div>
</div>


@endsection