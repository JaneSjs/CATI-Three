<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-primary" style="text-decoration: underline;">
        {{ $project->name }} Quality Control Report
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
          QC Rate:          <span class="badge bg-primary rounded-pill">
            @if(count($completed_interviews) == 0)
              0 %
            @else
              {{ round(($qcd_interviews / count($completed_interviews) ) * 100) }} %
            @endif
          </span>
        </li>
        <li class="list-group-item">
          Completed Interviews: 
          <span class="badge bg-success rounded-pill">
            {{ count($completed_interviews) }}
          </span>
        </li>
      </ul>
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-primary">
           {{ $total_qcs }} QC's
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Name</th>
              <th>Total QC'd </th>
              <th>Total Approvals</th>
              <th>Total Cancelled</th>
              <th>Performance</th>
              <th>Rate</th>
              <th>Total Payable</th>
              <th>Pay</th>
            </tr>
          </thead>
          <tbody>
            @foreach($qcs as $qc)
            <tr>
              <th scope="row">
                {{ $qc->first_name . ' ' . $qc->last_name }}
              </th>
              <td class="table-info">
                @php
                  $total_interviews = $qc->interviews->sum('completed_interviews')
                @endphp

                {{ $total_interviews ?? 0 }}
              </td>
              <td class="table-success">
                @php
                  $total_approved_interviews = $qc->interviews->sum('total_approved_interviews')
                @endphp

                {{ $total_approved_interviews ?? 0 }}
              </td>
              <td class="table-danger">
                @php
                  $total_cancelled_interviews = $qc->interviews->sum('total_cancelled_interviews')
                @endphp

                {{ $total_cancelled_interviews ?? 0 }}
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td>
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
                <div class="btn-group">
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
            {{ $qcs->links() }}
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection