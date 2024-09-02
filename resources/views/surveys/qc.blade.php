<?php
use Carbon\Carbon;

?>
<div class="card mb-3">
  <div class="card-header">
    <div class="row">
      <div class="col">
        <h5 class="text-primary">
          Interviews Quality Control Panel
        </h5>
      </div>
      <div class="col">
        <div class="btn-group btn-sm">
          <button class="btn btn-outline-danger" data-coreui-toggle="collapse" data-coreui-target="#possibleDuplicateInterviews" role="button" aria-expanded="false" aria-controls="possibleDuplicateInterviews" title="Toggle">
            {{ $total_duplicate_interviews }} Possible Duplicates
          </button>
          <button class="btn btn-outline-primary" data-coreui-toggle="collapse" data-coreui-target="#allInterviews" role="button" aria-expanded="false" aria-controls="allInterviews" title="Toggle">
            {{ $total_pending_interviews }} Pending Interviews
          </button>
        </div>
      </div>
      <div class="col">
        <!-- <form action="{{ url('search_interviews') }}" method="post">
          @csrf
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <div class="input-group">
            <input type="search" name="query" class="form-control" placeholder="Search Interviews" aria-label="Search for Interviews" aria-describedby="search_interviews" value="{{ request()->get('query') }}">
            <button type="submit" class="btn btn-outline-info" id="search_interviews">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form> -->
      </div>
    </div>
  </div>
  <div class="card-body">
    <div id="allInterviews" class="collapse table-responsive">
      <table class="table">
        <caption class="text-primary">
          All Interviews
        </caption>
        <thead class="bg-info text-light">
          <tr>
            <th>Interviewer</th>
            <th>Respondent</th>
            <th>Phone</th>
            <th>Date Time</th>
            <th>
              Sort By Duration
              <i class="fa-solid fa-sort"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          @if($pending_interviews)
            @foreach($pending_interviews as $interview)
            <tr>
              <td>
                {{ $interview->user->first_name . ' ' . $interview->user->last_name }}
              </td>
              <td>
                {{ $interview->respondent->name ?? $interview->respondent_name }}
              </td>
              <td>
                {{ $interview->phone_called ?? $interview->respondent->phone_1 }}
              </td>
              <td>
                <?php
                  $interview_date = Carbon::parse($interview->created_at)
                ?>
                {{ $interview_date->format('jS M Y H:i \H\r\s') }}
              </td>
              <td>
                <?php
                $start_time = Carbon::parse($interview->start_time);
                $end_time   = Carbon::parse($interview->end_time);
                ?>
                {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }} 
              </td>
              <td>
                <a href="{{ route('interviews.show', $interview->id) }}" class="btn btn-dark">
                  Show Interview
                </a>
              </td>
            </tr>
            @endforeach
          @else
           <tr>
             No Interview to QC
           </tr>
          @endif
        </tbody>
        <tfoot>
          {{ $pending_interviews->links() }}
        </tfoot>
      </table>
    </div>
    <div id="possibleDuplicateInterviews" class="collapse show table-responsive">
      <table class="table">
        <caption class="text-danger">
          Possible Duplicate Interviews
        </caption>
        <thead class="bg-danger">
          <tr>
            <th>Interviewer</th>
            <th>Respondent</th>
            <th>Phone</th>
            <th>Date Time</th>
            <th>
              Sort By Duration
              <i class="fa-solid fa-sort"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          @if($duplicate_interviews)
            @foreach($duplicate_interviews as $interview)
            <tr>
              <td>
                {{ $interview->user->first_name . ' ' . $interview->user->last_name }}
              </td>
              <td>
                {{ $interview->respondent->name ?? $interview->respondent_name }}
              </td>
              <td>
                {{ $interview->phone_called ?? $interview->respondent->phone_1 }}
              </td>
              <td>
                <?php
                  $interview_date = Carbon::parse($interview->created_at)
                ?>
                {{ $interview_date->format('jS M Y H:i \H\r\s') }}
              </td>
              <td>
                <?php
                $start_time = Carbon::parse($interview->start_time);
                $end_time   = Carbon::parse($interview->end_time);
                ?>
                {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }} 
              </td>
              <td>
                <a href="{{ route('interviews.show', $interview->id) }}" class="btn btn-dark">
                  Show Interview
                </a>
              </td>
            </tr>
            @endforeach
          @else
           <tr>
             No Interview to QC
           </tr>
          @endif
        </tbody>
        <tfoot>
          {{ $duplicate_interviews->links() }}
        </tfoot>
      </table>
    </div>
  </div>
</div>