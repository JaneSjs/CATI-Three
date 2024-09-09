@canany(['ceo','client','interviewer'])
<!-- Interview Termination Feedback Modal -->
<div class="modal fade" id="interview_termination_feedback" tabindex="-1" aria-labelledby="interviewTerminationFeedback" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="interviewTerminationFeedback">
          Respondent Feedback
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('respondent_feedback') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="feedback_input" class="form-label text-primary">
              Enter Reason for terminating the interview.
            </label>
            <textarea class="form-control" name="feedback" id="feedback_input" rows="7" required>
              {{ $respondent->feedback ?? '' }}
            </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block">
            Submit Feedback And Terminate This Interview.
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Interview Termination Feedback Modal -->

<!-- Respondent Feedback Modal -->
<div class="modal fade" id="respondent_feedback" tabindex="-1" aria-labelledby="respondent_feedback" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="respondent_feedback">
          Respondent Feedback
        </h5>

        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('respondent_feedback') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="feedback_input" class="form-label text-primary">
              Enter Feedback.
            </label>
            <textarea class="form-control" name="feedback" id="feedback_input" rows="7" required>
              {{ $respondent->feedback ?? '' }}
            </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-block">
            Submit Feedback
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Respondent Feedback Modal -->

<!-- Schedule Interview Modal -->
<div class="modal fade" id="interview_schedule" tabindex="-1" aria-labelledby="interview_schedule" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog bg-warning">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="interview_schedule">
          Schedule This Interview
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('interview_schedules.store') }}" method="post">
        @csrf
        <input type="hidden" name="respondent_id" value="{{ $respondent->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="schema_id" value="{{ $survey->id }}">
        <input type="hidden" name="interview_id" value="{{ $interview->id ?? '' }}">
        <input type="hidden" name="interview_url" value="{{ url()->current() }}" class="form-control">
        <div class="modal-body">
          <div class="mt-1">
            <label class="form-label">
              Schedule to This time
            </label>
                
            <input class="form-control" type="datetime-local" name="interview_datetime" aria-labelledby="interview_datetime">
            <div id="interview_datetime" class="form-text">
              Schedule to This Date and Time
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">
            Schedule
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Schedule Interview Modal -->

@endcan

@canany(['qc'])
<!-- QC Interview Approval Modal -->
<div class="modal fade" id="qc_interview_approval" tabindex="-1" aria-labelledby="qc_interview_approval" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qc_interview_approval">
          Interview Quality.
        </h5>

        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="{{ route('interviews.update', $interview->id) }}">
      @csrf
      @method('PATCH')
      <input type="hidden" name="quality_control" value="Cancelled">
      <input type="hidden" name="survey_id" value="{{ $interview->survey->id }}">

      <div class="modal-body">
        <div class="row mb-3">
          <div class="col">
            <label for="professional_language" class="form-label text-primary" name="professional_language">
              Language Used Was Professional ?

            </label>
            <select id="professional_language" class="form-select @error('professional_language') is-invalid @enderror">
              <option>Yes</option>
              <option>No</option>
            </select>
            @error('professional_language')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col">
            <label for="script_compliance" class="form-label text-primary" name="script_compliance">
              Script Compliance ?
            </label>
            <select id="script_compliance" class="form-select @error('script_compliance') is-invalid @enderror" name="script_compliance">
              <option value="Script Compliance: Good">Good</option>
              <option value="Script Compliance: Fair">Fair</option>
              <option value="Script Compliance: Bad">Bad</option>
            </select>
            @error('script_compliance')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="audio_complete" class="form-label text-primary" name="audio_complete">
              Audio Was Complete
            </label>
            <select id="audio_complete" class="form-select @error('audio_complete') is-invalid @enderror">
              <option>Yes</option>
              <option>No</option>
            </select>
            @error('audio_complete')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col">
            <label for="clear_audio" class="form-label text-primary" name="clear_audio">
              Audio Was Clear
            </label>
            <select id="clear_audio" class="form-select @error('clear_audio') is-invalid @enderror">
              <option>Yes</option>
              <option>No</option>
            </select>
            @error('clear_audio')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="qc_feedback" class="form-label text-primary" name="qc_feedback">
              Interview Integrity
            </label>
            <select id="qc_feedback" class="form-select @error('qc_feedback') is-invalid @enderror" name="qc_feedback">
              <option value="Interview Integrity: Yes">Yes</option>
              <option value="Interview Integrity: No">No</option>
            </select>
            @error('qc_feedback')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success btn-block">
            Approve Interview
          </button>
        </div> 
    </form>
    </div>
  </div>
</div>
<!-- End QC Interview Approval Modal -->

<!-- QC Interview Cancellation Modal -->
<div class="modal fade" id="qc_interview_cancellation" tabindex="-1" aria-labelledby="qc_interview_cancellation" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qc_interview_cancellation">
          Reason for cancelling the interview.
        </h5>

        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="{{ route('interviews.update', $interview->id) }}">
      @csrf
      @method('PATCH')
      <input type="hidden" name="quality_control" value="Cancelled">
      <input type="hidden" name="survey_id" value="{{ $interview->survey->id }}">

      <div class="modal-body">
          <div class="mb-3">
            <label for="qc_feedback" class="form-label text-primary">
              Reason for cancelling this interview.
            </label>
            <textarea class="form-control @error('qc_feedback') is-invalid @enderror" name="qc_feedback" id="qc_feedback" rows="7" required>
              
            </textarea>
            @error('qc_feedback')
            <div class="invalid-feedback bg-light rounded text-center" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-danger btn-block">
            Submit QC Feedback
          </button>
        </div> 
    </form>
    </div>
  </div>
</div>
<!-- End QC Interview Cancellation Modal -->
@endcan