<?php
  use Illuminate\Support\Carbon;
?>
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $total_interviews->count() }} 
                <span class="fs-6 fw-normal">
                  <i class="fas fa-headphones fa-beat fa-xl"></i>
                </span>
              </div>
              <div>Total Quality Controlled Interviews</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">
                {{ $todays_interviews->count() }} 
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
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th title="Interview Id">#</th>
            <th>Interviewer</th>
            <th>Respondent</th>
            <th>Interview Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach($qcd_interviews as $interview)
          <tr>
            <th scope="row">
              {{ $interview->id }}
            </th>
            
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
              
              <td>
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="row bg-primary text-light">
                      <div class="col">
                        {{ $interview->interview_status ?? '' }}
                      </div>
                      <div class="col">
                        <?php
                          $startTime = Carbon::parse($interview->start_time);
                          $endTime = Carbon::parse($interview->end_time);
                        ?>
                        {{ $startTime->diffInMinutes($endTime) }} Minutes
                      </div>
                    </div>
                  </li>
                  @if($interview->quality_control)
                  <li class="list-group-item">
                      @if($interview->quality_control == 'Approved')
                      <span class="badge bg-success">
                        {{ $interview->quality_control }}
                      </span>
                      @else
                      <span class="badge bg-danger">
                        {{ $interview->quality_control }}
                      </span>
                      @endif
                      @if($interview->qc_feedback)
                      <span class="badge bg-info ">
                        {{ $interview->qc_feedback }}
                      </span>
                      @endif
                  </li>
                  @endif
                  <?php
                    $carbon = new Carbon();
                  ?>
                  <li class="list-group-item">
                    Start Time:
                    <div data-coreui-date="{{ $interview->start_time }}" data-coreui-locale="en-UK" data-coreui-timepicker="true" data-coreui-toggle="date-picker"></div>
                  </li>
                  <li class="list-group-item">
                    @if($interview->end_time)
                     End Time:
                     <div data-coreui-date="{{ $interview->end_time }}" data-coreui-locale="en-UK" data-coreui-timepicker="true" data-coreui-toggle="date-picker"></div>

                    @endif
                  </li>
                </ul>
              </td>
              @canany(['admin','coordinator'])
              <td></td>
              @endcan
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          
        </tfoot>
      </table>
    </div>
  </div>
  <div class="card-footer">
    
  </div>
</div>