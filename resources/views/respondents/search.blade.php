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
              <input type="search" name="query" class="form-control" placeholder="Search for respondents..." aria-label="Search for respondents..." aria-describedby="search_respondents" value="{{ request()->get('query') }}">
              <button type="submit" class="btn btn-outline-info" id="search_respondents">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="col text-end">

          @include('partials/alerts')

          @canany(['admin','head','manager','coordinator'])
          <a href="{{ url('respondents/import') }}" class="btn btn-outline-success">
            Import respondents
            <i class="fas fa-upload"></i>
          </a>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-9">
          <div class="table-responsive">
            <table class="table caption-top">
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
        
      </div>
    </div>
  </div>
</div>


@endsection