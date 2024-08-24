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
          Completed Interviews: 
          <span class="badge bg-info rounded-pill">
            {{ count($completed_interviews) }}
          </span>
        </li>
        <li class="list-group-item">
          QC'd Interviews: 
          <span class="badge bg-success rounded-pill">
            {{ $qcd_interviews }}
          </span>
        </li>
        <li class="list-group-item">
          Not QC'd Interviews: 
          <span class="badge bg-danger rounded-pill">
            {{ $not_qcd_interviews }}
          </span>
        </li>
        <li class="list-group-item">
          QC Rate:
          <span class="badge bg-primary rounded-pill">
            @if(count($completed_interviews) == 0)
              0 %
            @else
              {{ round(($qcd_interviews / count($completed_interviews) ) * 100) }} %
            @endif
          </span>
        </li>
        <li class="list-group-item">
          <a href="javascript:void" class="btn btn-outline-primary btn-sm">
            QC Report
            <i class="fa-solid fa-download"></i>
          </a>
        </li>
      </ul>
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-primary">
           {{ $total_qcs }} QC's
          </caption>
          <thead class="table-success">
            <tr>
              <th scope="col">
                Name
              </th>
              <th class="text-primary">
                Total QC'd
              </th>
              <th class="text-success">
                Total Approved
              </th>
              <th class="text-danger">
                Total Cancelled
              </th>
              <th>
                Rate
              </th>
              <th>
                Total Payable
              </th>
              <th>
                Pay
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($qcPerformance as $performance )
            <tr> 
              <th scope="row">
                {{ $performance->qc_name }}
              </th>
              <td class="table-info">
                {{ $performance->total_qcd ?? 0 }}
              </td>
              <td class="table-success">
                {{ $performance->total_approved ?? 0 }}
              </td>
              <td class="table-danger">
                {{ $performance->total_cancelled ?? 0 }}
              </td>
              <td></td>
              <td></td>
              <td>
                <div class="btn-group" title="Feature Under Development">
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
            {{ $qcPerformance->links() }}
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection