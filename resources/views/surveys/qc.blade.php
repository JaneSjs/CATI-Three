<?php
use Carbon\Carbon;

?>
<div class="card mb-3">
  <div class="card-header">
    <div class="row">
      <div class="col">
        <form action="{{ url('search_interviews') }}" method="GET">
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <div class="input-group">
            <input type="search" name="query" class="form-control" placeholder="Search Interviews" aria-label="Search for Interviews" aria-describedby="search_interviews" value="{{ request()->get('query') }}">
            <button type="submit" class="btn btn-outline-info" id="search_interviews">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form>
      </div>
      <div class="col">
        <h5 class="text-primary">
          Interviews Quality Control Panel
        </h5>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Interviewer</th>
            <th>Respondent</th>
            <th>Phone Called</th>
            <th>Date Time</th>
            <th>
              Sort By Duration
              <i class="fa-solid fa-sort"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          
          @if($interviews)
            @foreach($interviews as $interview)
            <tr>
              <td>
                {{ $interview->user->first_name . ' ' . $interview->user->last_name }}
              </td>
              <td>
                {{ $interview->respondent->name ?? $interview->respondent_name }}
              </td>
              <td>
                {{ $interview->respondent->phone_1 ?? '' }}
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
          {{ $interviews->links() }}
        </tfoot>
      </table>
    </div>
  </div>
</div>