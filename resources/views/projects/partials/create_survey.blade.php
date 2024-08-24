<div class="modal fade" id="createSurvey" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="surveyLabel" aria-hidden="true">
<div class="modal-dialog bg-warning">
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

        <div class="row">
          <div class="col">
            <label for="project_type" class="form-label">
              Survey Type
            </label>
            <select class="form-select" id="project_type" name="type">
              <option value="CATI">CATI</option>
              <option value="CAWI">CAWI</option>
              <option value="CAPI">CAPI</option>
            </select>
            <div id="projectType" class="form-text">
              Type of the survey
            </div>
          </div>
          <div class="col">
            <label for="database" class="form-label">
              Data Protection Module
            </label>
            <select class="form-select" name="database" aria-label="Select Database">
              <option value="Controller" title="Controlled Database" selected>
                Controller
              </option>
              <option value="Processor" title="Processed Database">
                Processor
              </option>
            </select>
            <div id="database" class="form-text">
              Choose Database
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">
          Create
        </button>
      </div>
    </form>
    </div>
  </div>
</div>
          