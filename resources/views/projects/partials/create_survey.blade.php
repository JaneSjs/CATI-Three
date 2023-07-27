<div class="modal fade" id="createSurvey" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="surveyLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="{{ route('surveys.store') }}">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="surveyLabel">
          Create A New Survey For This Project
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="mb-3">
          <label for="survey_name" class="form-label">
            Survey Name
          </label>
          <input type="text" class="form-control" name="survey_name" id="survey_name" aria-describedby="nameDescription" value="{{ old('survey_name') }}">
            @error('survey_name')
            <p class="text-danger">
              {{ $message }}
            </p>
            @else
            <div id="nameDescription" class="form-text">
              Name of the Survey
            </div>
            @endif
        </div>
        <input type="hidden" name="project_id" value="{{ $project->id }}">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </form>
    </div>
  </div>
</div>
          