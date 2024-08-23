@extends('layouts.main')
@section('content')

<?php
  use Carbon\Carbon;
?>
<!-- /.row-->
<div class="card mb-4">
  <div class="card-header">
    <h4 class="card-title mb-0">
      My 
      <span class="text-info">{{ $project->name }}</span>
      Interview Performance Report.
    </h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $total_user_interviews->count() }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-headphones fa-beat fa-xl"></i>
                </span>
              </div>
              <div>Total Interviews</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $todays_user_interviews->count() }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-calendar fa-xl"></i>
                </span>
              </div>
              <div>Todays Interviews</div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @if($user_interviews)
    <div class="table-responsive">
      <table class="table table-striped table-sm table-bordered">
        <thead class="table-dark">
          <tr>
            <th scope="col">Interview Id</th>
            @canany(['admin','ceo','head','manager'])
            <th scope="col">Interviewer</th>
            <th scope="col">Respondent</th>
            @endcan
            <th scope="col">Interview Details</th>
            @canany(['admin','ceo','coordinator'])
              <th scope="col">QC Name</th>
            @endcan
            <th>
              Date
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($user_interviews as $interview)
          <tr>
            <th scope="row">
              {{ $interview->id }}
            </th>
            @canany(['admin','ceo','head','manager'])
            <td>
              {{ $interview->user->first_name . ' ' .$interview->user->last_name }}
            </td>
                  
            <td>
              {{ $interview->respondent->name ?? '' }}
              <hr>
              Phone Called - 890 {{ $interview->phone_called }}
                  
              <hr>
              Id - {{ $interview->respondent->id ?? '' }}
              <hr>
              R_ID - {{ $interview->respondent->r_id ?? '' }}
            </td>
            @endcan
            <td>
              <dl>
                <dt>
                  {{ $interview->interview_status ?? '' }}
                </dt>
                <dd>
                  <?php
                    $start_time = Carbon::parse($interview->start_time ?? '' );
                    $end_time   = Carbon::parse($interview->end_time ?? '' );
                  ?>
                  <p>
                    Duration
                    <span class="badge bg-primary">
                      {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }}
                    </span>
                  </p>
                </dd>
                <dt>
                  <!--<a href="#" 
                          class="btn btn-dark btn-xs" 
                          target="_blank"
                          title="Go To Interview (Currently Not Working)"
                          onclick="return false;"
                        >
                    Preview
                  </a>-->
                </dt>
              </dl>
            </td>
            @canany(['admin','ceo','coordinator'])
            <td></td>
            @endcan
            <td>
              {{ $end_time->format('d/m/Y') }}
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          {{ $user_interviews->links() }}
        </tfoot>
      </table>
    </div>
    @endif
  </div>
  <div class="card-footer">
    
  </div>
</div>
<!-- /.card.mb-4-->
    


@endsection