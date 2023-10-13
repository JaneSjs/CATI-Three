@can(['agent'])
<!-- Feedback Modal -->
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
              Enter Feedback
            </label>
            <textarea class="form-control" name="feedback" id="feedback_input" rows="7"></textarea>
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
<!-- End Feedback Modal -->

<!-- Schedule Interview Modal -->
<div class="modal fade" id="interview_schedule" tabindex="-1" aria-labelledby="interview_schedule" aria-hidden="true">
  <div class="modal-dialog">
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
        <input type="text" name="interview_url" value="{{ url()->current() }}" class="form-control">
        <div class="modal-body">
          <div class="mt-1">
            <label class="form-label">
              Schedule to This time
            </label>
                
            <input class="form-control" type="datetime-local" name="interview_datetime" aria-labelledby="interview_datetime">
            <div id="interview_datetime" class="form-text">
              Schedule to This time
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Schedule
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Schedule Interview Modal -->


@endcan