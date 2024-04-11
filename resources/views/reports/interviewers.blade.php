<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          @canany(['admin','head','manager'])
          <form action="{{ url('search_users') }}" method="GET">
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search Interviewers..." aria-label="Search interviewer..." aria-describedby="search_interviewers" value="{{ request()->get('query') }}">
              <button type="submit" class="btn btn-outline-info" id="search_interviewers">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
          @endcan
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
        <div class="col text-end">
          
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-danger">
           Total Interviews Per Interviewer
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Interviews</th>
              <th scope="col">Percentage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($interviewers as $interviewer)
            <tr>
              <th scope="row">
                {{ $interviewer->first_name . ' ' . $interviewer->last_name }}
              </th>
              <td>
                {{ count($interviewer->interviews) }}
              </td>
              
              <td>
                
                
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            {{ $interviewers->links() }}
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection