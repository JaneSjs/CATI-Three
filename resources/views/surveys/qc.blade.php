<?php
use Carbon\Carbon;

?>
<div class="card mb-3">
  <div class="card-header">
    <div class="row">
      <div class="col">
        <h5 class="text-primary">
          {{ $survey->survey_name ?? '' }} Interviews Quality Control Panel
        </h5>
      </div>
      <div class="col">
        <div class="btn-group btn-sm">
          <button class="btn btn-outline-danger" data-coreui-toggle="collapse" data-coreui-target="#possibleDuplicateInterviews" role="button" aria-expanded="false" aria-controls="possibleDuplicateInterviews" title="Toggle">
            {{ $total_duplicate_interviews }} Possible Duplicates
          </button>
          <button class="btn btn-outline-primary" data-coreui-toggle="collapse" data-coreui-target="#pendingInterviews" role="button" aria-expanded="false" aria-controls="pendingInterviews" title="Toggle">
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
    <div id="pendingInterviews" class="collapse table-responsive">
      <table class="table">
        <caption class="text-primary">
          {{ $total_pending_interviews }} Pending Interviews
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
            @forelse($pending_interviews as $pending_interview)
            <tr>
              <td>
                {{ $pending_interview->user->first_name . ' ' . $pending_interview->user->last_name }}
              </td>
              <td>
                {{ $pending_interview->respondent->name ?? $pending_interview->respondent_name }}
              </td>
              <td>
                {{ $pending_interview->phone_called ?? $pending_interview->respondent->phone_1 }}
              </td>
              <td>
                <?php
                  $interview_date = Carbon::parse($pending_interview->created_at)
                ?>
                {{ $interview_date->format('jS M Y H:i \H\r\s') }}
              </td>
              <td>
                <?php
                $start_time = Carbon::parse($pending_interview->start_time);
                $end_time   = Carbon::parse($pending_interview->end_time);
                ?>
                {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }} 
              </td>
              <td>
                <a href="{{ route('interviews.show', $pending_interview->id) }}" class="btn btn-dark">
                  Show Interview
                </a>
              </td>
            </tr>
          @empty
           <tr>
             No Interview to QC
           </tr>
          @endforelse
        </tbody>
        <tfoot>
          {{ $pending_interviews->links() }}
        </tfoot>
      </table>
    </div>
    <div id="possibleDuplicateInterviews" class="collapse show table-responsive">
      <table class="table">
        <caption class="text-danger">
          {{ $total_duplicate_interviews }} Possible Duplicate Interviews
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
            @foreach($duplicate_interviews as $duplicate_interview)
            <tr>
              <td>
                {{ $duplicate_interview->user->first_name . ' ' . $duplicate_interview->user->last_name }}
              </td>
              <td>
                {{ $duplicate_interview->respondent->name ?? $duplicate_interview->respondent_name }}
              </td>
              <td>
                {{ $duplicate_interview->phone_called ?? $duplicate_interview->respondent->phone_1 }}
              </td>
              <td>
                <?php
                  $interview_date = Carbon::parse($duplicate_interview->created_at)
                ?>
                {{ $interview_date->format('jS M Y H:i \H\r\s') }}
              </td>
              <td>
                <?php
                $start_time = Carbon::parse($duplicate_interview->start_time);
                $end_time   = Carbon::parse($duplicate_interview->end_time);
                ?>
                {{ $start_time->diff($end_time)->format('%h Hr %i Min %s Sec'); }} 
              </td>
              <td>
                <a href="{{ route('interviews.show', $duplicate_interview->id) }}" class="btn btn-dark">
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