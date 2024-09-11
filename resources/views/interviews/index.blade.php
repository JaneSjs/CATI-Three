@extends('layouts.main')
    
@section('content')

<div class="card">
  <div class="card-header">
    <h4 class="card-title text-primary">
      {{ $project->name }} Interviews
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
            <table class="table table-striped table-sm table-bordered">
              <thead class="table-dark">
                <tr>
                  <th scope="col" title="Interview Id">
                    #
                  </th>
                  <th scope="col">Interviewer Details</th>
                  <th scope="col">Respondent Details</th>
                  <th scope="col">Interview Details</th>
                  <th scope="col">QC Details</th>
                </tr>
              </thead>
              <tbody>
                @foreach($interviews as $interview)
                <tr>
                  <th scope="row">
                    {{ $interview->id }}
                  </th>
                  <td>
                    {{ $interview->user->first_name . ' ' .$interview->user->last_name }}
                    <hr>
                    Ext No Used: {{ $interview->ext_no  }}
                  </td>
                  
                  <td>
                    {{ $interview->respondent->name ?? '' }}
                    <hr>
                    Phone Called - 890{{ $interview->phone_called }}
                  
                    <hr>
                    Id - {{ $interview->respondent->id ?? '' }}
                    <hr>
                    R_ID - {{ $interview->respondent->r_id ?? '' }}
                  
                  </td>
                  <td>
                    <button type="button" class="btn btn-warning" disabled>
                      {{ $interview->survey->survey_name }} 
                      <span class="badge bg-info">
                        Version {{ $interview->survey->version }}
                      </span>
                    </button>
                    <dl>
                      <dt>
                        {{ $interview->interview_status ?? '' }}
                        @if(isset($interview->quality_control))
                          @if($interview->quality_control == 'Cancelled')
                            <span class="badge bg-danger">
                              {{ $interview->quality_control }}
                            </span>
                          @else
                            <span class="badge bg-success">
                              {{ $interview->quality_control }}
                            </span>
                          @endif
                        @endif
                      </dt>
                      <dd>
                        Start Time: ({{ $interview->start_time ?? '' }}).
                        @if($interview->end_time)
                          | End Time: ({{ $interview->end_time ?? '' }})
                        @elseif(isset($interview->respondent->feedback))
                          <strong>
                            Interview Did Not End because the respondent {{ $interview->respondent->feedback }}
                          </strong>
                        @else
                          Interview Did Not End.
                        @endif
                      </dd>
                      <dt>
                        <a href="{{ route('interviews.show', $interview->id) }}" 
                          class="btn btn-outline-dark btn-xs"
                          title="Preview The Interview"
                        >
                          Preview Interview
                        </a>
                      </dt>
                    </dl>
                  </td>
                  <td>
                    {{ $interview->qc_name }}
                    <hr>
                    <div class="@if($interview->quality_control == 'Cancelled') text-danger @else text-success @endif">
                      {{ $interview->quality_control }}
                      <hr>
                      {{ $interview->qc_feedback }}
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $interviews->links() }}
              </tfoot>
            </table>
          </div>
  </div>
</div>

@endsection