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
          <h5>
            Project Respondents
          </h5>
        </div>
        <div class="col">
          <form action="{{ url('search_respondents') }}" method="GET">
            @csrf
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search for respondents..." aria-label="Search for respondents..." aria-describedby="search_respondents" value="">
              <button type="submit" class="btn btn-outline-info" id="search_respondents">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="col text-end">

          @include('partials/alerts')

          @canany(['admin','head','manager','coordinator'])
          <button class="btn btn-outline-info btn-sm" title="Export respondents">
            <i class="fas fa-download"></i>
            Export
          </button>
          <a href="{{ url('respondents/import') }}" class="btn btn-outline-success btn-sm" title="Import respondents">
            Import 
            <i class="fas fa-upload"></i>
          </a>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-8">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              @canany(['admin','ceo','head'])
              <caption>
               Respondents that belong to this project
              </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Interview Status</th>
                  <th scope="col">Feedback</th>
                  <th scope="col">Interview DateTime</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($respondents as $respondent)
                <tr>
                  <th scope="row">
                    {{ $respondent->id ?? '-' }}
                  </th>
                  <td>
                    <i class="fas fa-eye"></i>
                    <a href="{{ route('respondents.show', $respondent->id) }}">                  
                      {{ $respondent->name }}
                    </a>
                  </td>
                  <td>
                    {{ $respondent->gender ?? '-' }}
                  </td>
                  <td>
                    {{ $respondent->interview_status ?? '-' }}
                  </td>
                  <td>
                    {{ $respondent->feedback ?? '-' }}
                  </td>
                  <td>
                    <?php
                      $interview_date_time = Carbon::parse($respondent->interview_date_time)
                    ?>
                    @if($respondent->interview_date_time)
                    {{ $interview_date_time->diffForHumans() ?? ''}}
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('respondents.edit', $respondent->id) }}" class="btn btn-sm btn-outline-info" title="Update respondent Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @can('supervisor')
                      <button type="button" class="btn btn-sm btn-outline-primary" title="Recruit {{ $respondent->last_name }}">
                        <i class="fas fa-respondent-tie"></i>
                      </button>
                      @endcan

                      @can('supervisor')
                      <form action="{{ route('respondents.destroy', $respondent->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove {{ $respondent->last_name }}">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                      @endcan
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $respondents->links() }}
              </tfoot>
            </table>
          </div>
        </div>
        @canany(['admin','ceo','head','manager','coordinator'])
        <div class="col-4 bg-dark">
          <ul class="list-group mt-5">
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Project">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Total Respondents
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $total_respondents }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Project">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Imported Today
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $total_respondents }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Project">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Imported Yesterday
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $total_respondents }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Male Respondents in the System">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Male 
                </div>
              </div>
              <span class="badge bg-dark rounded-pill">
                {{ $male_respondents }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Female Respondents in the System">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Female 
                </div>
              </div>
              <span class="badge bg-dark rounded-pill">
                {{ $female_respondents }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Respondents</div>
                Available for Interviewing
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $respondents_available_for_interviewing }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Respondents</div>
                With Feedback
              </div>
              <span class="badge bg-warning rounded-pill">
                {{ $respondents_with_feedback }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Respondents</div>
                With Complete Interviews
              </div>
              <span class="badge bg-success rounded-pill">
                {{ $respondents_with_complete_interviews }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Respondents</div>
                With Terminated Interviews
              </div>
              <span class="badge bg-danger rounded-pill">
                {{ $respondents_with_terminated_interviews }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Locked</div>
                 - Engaged to an Ongoing or Scheduled interview
              </div>
              <span class="badge bg-info rounded-pill">
                {{ $locked_respondents }}
              </span>
            </li>
          </ul>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection