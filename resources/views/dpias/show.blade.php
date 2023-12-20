@extends('layouts.main')
    
@section('content')


<section class="h-100 gradient-custom-2 mb-4">
  <div class="card h-100">
    <div class="card-header">
      <h2>
        {{ $project->name }} DPIA
      </h2>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
          </ul>
        </div>
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
            <li class="list-group-item">
              {{ $project_dpia }}
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </div>
</section>


@endsection