<?php
use Carbon\Carbon;

?>
<div class="card">
  <div class="card-header">
    Interviews
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Interviewer</th>
            <th>Respondent</th>
            <th>Phone Called</th>
            <th></th>
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
                {{ $interview_date->diffForHumans() }}
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