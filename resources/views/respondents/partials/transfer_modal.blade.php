<!-- Transfer Respondents Modal-->
<div class="modal fade" id="transferRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="respondentsTranfer" aria-hidden="true">
  <div class="modal-dialog bg-primary">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="respondentsTranfer">
          Respondents Transfer
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <p>
          Transfer Respondents From 
          <strong class="text-primary">{{ $survey->survey_name }}</strong>
          To:
        </p>
        <hr>
        <form action="{{ route('transfer_respondents') }}" method="post">
          @csrf
          @method('PATCH')
          <input type="hidden" name="previous_project_id" value="{{ $project->id }}">
          <input type="hidden" name="previous_survey_id" value="{{ $survey->id }}">
          <div class="row">
            <div class="col mb-3">
              <label for="currentProjectId" class="form-label">
                Select Project
              </label>
              <select class="form-select" id="currentProjectId" name="current_project_id">
                @foreach($projects as $project)
                  <option value="{{ $project->id }}">
                    {{ $project->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col mb-3">
              <label for="currentSurveyId" class="form-label">
                Select Survey
              </label>
              <select class="form-select" id="currentSurveyId" name="current_survey_id">
                @foreach($surveys as $survey)
                  <option value="{{ $survey->id }}">
                    {{ $survey->survey_name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary float-end">
            Transfer
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Transfer Respondents Modal-->