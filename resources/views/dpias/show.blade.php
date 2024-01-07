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
              <strong>Approved or Not</strong>
            </li>
            <li class="list-group-item" title="Data Protection Impact Assessment">
              Project <strong>DPIA</strong> Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item" title="Data Protection Sensitization">
              Interviewers <strong>DPS</strong> Training Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item">
              Data Protection Controller/Processor Agreement Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item">
              Extra Document 1
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item">
              Extra Document 2
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </div>
</section>


@endsection