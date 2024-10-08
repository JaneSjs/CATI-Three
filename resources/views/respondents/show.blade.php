<?php
use Carbon\Carbon;

?>

@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-3">
          <h6>
            {{ $survey->survey_name }} Respondents
          </h6>
          <br>
          <a href="{{ route('projects.show', $project->id) }}">
            Go To {{ $project->name }}
          </a>
        </div>
        <div class="col-4">
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

        <div class="col-5 text-end">

          @include('partials/alerts')

          <div class="btn-group">
            @if($survey->database == 'Processor')
              @canany(['admin','ceo','dpo'])
                <form action="{{ route('respondents.export') }}" method="post">
                  @csrf
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                  <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                  <button type="submit" class="btn btn-outline-info btn-sm mt-1" title="Export respondents">
                    <i class="fas fa-download"></i>
                    Export
                  </button>
                </form>
              @endcan
              <a href="{{ url('respondents/import') }}" class="btn btn-outline-success btn-sm mt-1" title="Import respondents">
                Import 
                <i class="fas fa-upload"></i>
              </a>
            @elseif($survey->database == 'Controller')
              <button type="button" class="btn btn-success btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#rdms">
                RDMS
                <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
              </button>
            @endif

            @canany(['admin','dpo'])
              <button type="button" class="btn btn-warning btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#bulkSoftDeleteRespondents">
                Bulk Soft Delete
              </button>
              @include('respondents/partials/bulk_soft_delete_modal')
              <button type="button" class="btn btn-info btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#unlockRespondents">
                Unlock
              </button>
              @include('respondents/partials/unlock_modal')
            @endcan
            @canany(['admin','head','manager'])
              <button type="button" class="btn btn-primary btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#transferRespondents">
                Transfer 
              </button>
              @include('respondents/partials/transfer_modal')
            @endcan
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-8">
          <div class="table-responsive">
            <table class="table table-sm caption-top">
              <thead class="table-success">
                <tr>
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
                  <td>
                    <div title="Click To View Respondent Details" data-coreui-toggle="modal" data-coreui-target="#viewRespondent-{{ $respondent->id }}">
                      {{ $respondent->name }}
                    </div>
                    @include('respondents/partials/view_respondent_modal')              
                    <hr>
                    <small>
                      {{ $respondent->phone_1 }}
                    </small>
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
                      <button type="button" class="btn btn-sm btn-outline-info" title="Update respondent Details" data-coreui-toggle="modal" data-coreui-target="#editRespondentDetails-{{ $respondent->id }}">
                        <i class="fas fa-pen"></i>
                      </button>
                      @include('respondents/partials/edit_respondent_details_modal')

                      

                      @canany(['admin','dpo'])
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
        @canany(['admin','ceo','head','manager','coordinator','dpo'])
        <div class="col-4 bg-dark">
          <ul class="list-group mt-5">
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Survey">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Total Respondents
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $total_respondents }}
              </span>
            </li>
            @canany(['admin','dpo'])
              <li class="list-group-item d-flex justify-content-between align-items-start" title="Soft Deleted Respondents For This Survey">
              <div class="ms-2 me-auto">
                <a href="{{ route('soft_deleted_respondents', [$project->id, $survey->id]) }}" class="text-danger">
                  <div class="fw-bold">
                    Soft Deleted Respondents
                  </div>
                </a>
              </div>
              <span class="badge bg-danger rounded-pill">
                {{ $trashedRespondents }}
              </span>
            </li>
            @endcan
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Project">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Imported Today
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $imported_today }}
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Total Respondents For This Project">
              <div class="ms-2 me-auto">
                <div class="fw-bold">
                  Imported Yesterday
                </div>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ $imported_yesterday }}
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
                {{ $available_for_interviewing }}
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