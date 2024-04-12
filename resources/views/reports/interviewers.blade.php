<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-primary">
        {{ $project->name }} Interviewers Performance Report
      </h3>
      <div class="row">
        <div class="col">
          @canany(['admin','ceo','manager'])
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
      <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
          Sample Size: 
          <span class="badge bg-primary rounded-pill">
            3000
          </span>
        </li>
        <li class="list-group-item">
          Total Interviews: 
          <span class="badge bg-success rounded-pill">
            3000
          </span>
        </li>
        <li class="list-group-item">
          Excess Interviews: 
          <span class="badge bg-danger rounded-pill">
            3000
          </span>
        </li>
      </ul>
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-primary">
           Interviewers Performance Report
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Name</th>
              <th>Total Interviews</th>
              <th>Approved Interviews</th>
              <th>Cancelled Interviews</th>
              <th>Performance</th>
              <th>Rate</th>
              <th>Total Payable</th>
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
                @php
                  $totalApproved = 0;
                  foreach($interviewer->interviews as $interview)
                  {
                    $totalApproved += $interview->total_approved_interviews;
                  }

                  echo $totalApproved
                @endphp
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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