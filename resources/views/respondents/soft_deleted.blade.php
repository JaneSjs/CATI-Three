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
          <h6 class="text-danger">
            {{ $survey->survey_name }} 
            
          </h6>
        </div>
        <div class="col-4">
          <form action="{{ url('search_respondents') }}" method="GET">
            @csrf
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search for them..." aria-label="Search for respondents..." aria-describedby="search_respondents" value="">
              <button type="submit" class="btn btn-outline-info" id="search_respondents">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="col-5 text-end">

          @include('partials/alerts')

          <div class="btn-group">
          
          @canany(['admin','dpo'])
            <button type="button" class="btn btn-outline-danger btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#bulkPermanentDeleteRespondents">
              Permanent Bulk Delete
            </button>
            @include('respondents/partials/bulk_delete_modal')
            <button type="button" class="btn btn-outline-info btn-sm mt-1" data-coreui-toggle="modal" data-coreui-target="#restoreDeletedRespondents">
              Restore Them
            </button>

            @include('respondents/partials/restore_soft_deleted_modal')
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
              @canany(['admin','ceo','head'])
              <caption class="text-danger">
               Soft Deleted Respondents for this survey
              </caption>
              @endcan
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
                <tr class=" table-danger">
                  <td>
                    <a href="{{ route('respondents.show', $respondent->id) }}">                  
                      {{ $respondent->name }}
                    </a>
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
                      <a href="{{ route('respondents.edit', $respondent->id) }}" class="btn btn-sm btn-outline-info" title="Update respondent Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @can('supervisor')
                      <button type="button" class="btn btn-sm btn-outline-primary" title="Recruit {{ $respondent->last_name }}">
                        <i class="fas fa-respondent-tie"></i>
                      </button>
                      @endcan

                      @canany(['admin','ceo','head','manager','coodinator','supervisor'])
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
            @canany(['admin','dpo'])
            <li class="list-group-item d-flex justify-content-between align-items-start" title="Soft Deleted Respondents For This Survey">
              <div class="ms-2 me-auto">
                <div class="fw-bold text-danger">
                  Total Soft Deleted Respondents
                </div>
              </div>
              <span class="badge bg-danger rounded-pill">
                {{ $trashedRespondents }}
              </span>
            </li>
            @endcan
          </ul>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection