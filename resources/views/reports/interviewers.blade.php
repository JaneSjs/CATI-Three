<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-primary" style="text-decoration: underline;">
        {{ $project->name }} Interviewers Performance Report
      </h3>
      <div class="row">
        <div class="col">
          
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
          Interview Attempts: 
          <span class="badge bg-info rounded-pill">
            {{ count($all_interview_attempts) }}
          </span>
        </li>
        <li class="list-group-item">
          Completed Interviews: 
          <span class="badge bg-success rounded-pill">
            {{ count($completed_interviews) }}
          </span>
        </li>
        <li class="list-group-item">
          Approved Interviews: 
          <span class="badge bg-success rounded-pill">
            {{ count($approved_interviews) }}
          </span>
        </li>
        <li class="list-group-item">
          Cancelled Interviews: 
          <span class="badge bg-danger rounded-pill">
            {{ count($cancelled_interviews) }}
          </span>
        </li>
      </ul>
      <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
          QC Rate: 
          <span class="badge rounded-pill
            @if(count($completed_interviews) == 0)
              bg-secondary text-dark
            @else
              @php
                $qc_rate = round(($qcd_interviews / count($completed_interviews) ) * 100);
              @endphp

              @if($qc_rate < 25)
                bg-danger
              @elseif($qc_rate < 50)
                bg-info
              @elseif($qc_rate < 75)
                bg-primary
              @else
                bg-success
              @endif
            @endif
          ">
            @if(count($completed_interviews) == 0)
              0%
            @else
              {{ round(($qcd_interviews / count($completed_interviews) ) * 100) }} %
            @endif
          </span>
        </li>
        <li class="list-group-item">
          Progress: 
          {{ $progress }}
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $progress  }}%;">
              {{ $progress }}%
            </div>
          </div>
        </li>
      </ul>

      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-primary">
           {{ $total_interviewers }} Interviewers
          </caption>
          <thead class="table-success">
            <tr>
              <th scope="col">
                Name
              </th>
              <th class="text-primary">
                Interview Attempts
              </th>
              <th class="text-info">
                Completed Interviews
              </th>
              <th class="text-success">
                Approved Interviews
              </th>
              <th class="text-danger">
                Cancelled Interviews
              </th>
              <th>
              Rate
            </th>
              <th>
              Total Payable
            </th>
            <th title="Payments Feature Under Development">
              Pay
            </th>
            </tr>
          </thead>
          <tbody>
            @foreach($interviewers as $interviewer)
            <tr>
              <th scope="row">
                {{ $interviewer->first_name . ' ' . $interviewer->last_name }}
              </th>
              <td class="table-primary">
                @php
                  $interview_attempts = $interviewer->interviews->sum('interview_attempts');
                @endphp

                {{ $interview_attempts ?? 0 }}
              </td>
              <td class="table-info">
                @php
                  $total_interviews = $interviewer->interviews->sum('completed_interviews')
                @endphp

                {{ $total_interviews ?? 0 }}
              </td>
              <td class="table-success">
                @php
                  $total_approved_interviews = $interviewer->interviews->sum('total_approved_interviews')
                @endphp

                {{ $total_approved_interviews ?? 0 }}
              </td>
              <td class="table-danger">
                @php
                  $total_cancelled_interviews = $interviewer->interviews->sum('total_cancelled_interviews')
                @endphp

                {{ $total_cancelled_interviews ?? 0 }}
              </td>
              <td></td>
              <td></td>
              <td title="Payments Feature Under Development">
                <div class="btn-group">
                  <!-- Let Wages button Appear Only When The Project is Closed -->
                  <button class="btn btn-outline-success btn-sm">
                    Pay Wage Via M-Pesa
                  </button>
                  <!-- Let Wages button Appear Only When The Project is Closed -->
                </div>
              </td>
            </tr>
            @endforeach
            <tr>
              <td>Grand Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <div class="btn-group" title="Feature Under Development">
                  <!-- Let Wages button Appear Only When The Project is Closed -->
                  <button class="btn btn-success btn-sm">
                    Pay All Wages At Once
                  </button>
                  <!-- Let Wages button Appear Only When The Project is Closed -->
                </div>
              </td>
            </tr>
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