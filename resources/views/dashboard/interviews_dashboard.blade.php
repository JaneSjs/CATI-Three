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
        <div class="card mb-4 text-white bg-secondary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $user_interview_attempts }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-headphones fa-beat fa-xl"></i>
                </span>
              </div>
              <div>Interview Attempts</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $net_user_interviews }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-headphones fa-beat fa-xl"></i>
                </span>
              </div>
              <div>Total Net Interviews</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
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
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $approved_user_interviews }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-check fa-xl"></i>
                </span>
              </div>
              <div>Approved Interviews</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $cancelled_user_interviews }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-times fa-xl"></i>
                </span>
              </div>
              <div>Cancelled Interviews</div>
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
            @canany(['admin','ceo','interviewer'])
              <th scope="col">Quality Check</th>
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
              <?php
                $start_time = Carbon::parse($interview->start_time ?? '' );
                $end_time   = Carbon::parse($interview->end_time ?? '' );
              ?>
              <dl>
                @if($interview->interview_status == 'Interview Completed')
                  <dt class="text-primary">
                    {{ $interview->interview_status ?? '' }}
                  </dt>
                  <dd>
                    <p>
                      Duration
                      <span class="badge bg-primary">
                        {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }}
                      </span>
                    </p>
                  </dd>
                @else
                  <dt class="text-danger">
                    Incomplete Interview
                  </dt>
                  @isset($interview->respondent->interview_status)
                  @if($interview->respondent->interview_status == 'Locked')
                    <dd class="text-danger">
                      You have {{ $interview->respondent->interview_status }} this respondent.
                    </dd>
                    <p>
                      You should either  
                      <span class="text-success">
                        complete
                      </span> or 
                      <span class="text-danger">
                        terminate
                      </span> this interview to release the respondent.
                    </p>
                    <p>
                      If you choose to terminate the interview, remember to update feedback accordingly.
                    </p>
                  @endif
                  @endisset
                @endif
                <dt>
                  @if($interview->interview_status != 'Interview Completed')
                  <form method="post" action="{{ route('interviews.store') }}">
                    @csrf
                    <div class="d-none">

                      <input type="hidden" name="project_id" value="{{ $project->id }}">

                      <input type="hidden" name="survey_id" value="{{ $interview->survey->id }}">

                      <input type="hidden" name="interview_id" value="{{ $interview->id }}">

                      <input type="hidden" name="respondent_id" value="{{ $interview->respondent->id }}">

                      <input type="hidden" name="respondent_name" value="{{ $interview->respondent->name ?? $interview->respondent_name }}">

                      <input type="hidden" name="ext_no" value="{{ auth()->user()->ext_no }}">

                      <input type="hidden" name="phone_called" value="{{ $interview->phone_called }}">

                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                      Interview Link
                    </button>
                  </form>
                  @endif
                </dt>
              </dl>
            </td>
            @canany(['admin','ceo','interviewer'])
            <td>
              @if(isset($interview->qc_name))
                QC: {{ $interview->qc_name }}
                <hr>
              @endif
              <div class="@if($interview->quality_control == 'Cancelled') text-danger @else text-success @endif">
                {{ $interview->quality_control }}
                <hr>
                {{ $interview->qc_feedback }}
              </div>
            </td>
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