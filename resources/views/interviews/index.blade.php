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
                        @if($interview->quality_control)
                          <span class="badge bg-info">
                            {{ $interview->quality_control }}
                          </span>
                        @endif
                      </dt>
                      <dd>
                        Start Time: ({{ $interview->start_time ?? '' }})
                        @if($interview->end_time)
                        | End Time: ({{ $interview->end_time ?? '' }})
                        @endif
                      </dd>
                      <dt>
                        <a href="{{ route('begin_survey', [
                            'project_id' => $interview->project->id, 
                            'survey_id' => $interview->schema_id,
                            'interview_id' => $interview->id,
                            'respondent_id' => $interview->respondent_id,
                              ]) }}" 
                          class="btn btn-dark btn-xs" 
                          target="_blank"
                          title="Go To Interview"
                        >
                          Preview
                        </a>
                      </dt>
                    </dl>
                  </td>
                  <td>
                    {{ $interview->qc_name }}
                    <hr>
                    {{ $interview->quality_control }}
                    <hr>
                    {{ $interview->qc_feedback }}
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