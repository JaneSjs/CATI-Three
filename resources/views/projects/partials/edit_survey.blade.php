<div class="modal fade" id="edit-survey-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="stageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stageLabel">
         Edit {{ $survey->survey_name }} Survey Details
        </h5>
        <button type="button" class="btn btn-outline-info btn-sm float-end" data-coreui-dismiss="modal">
          x
        </button>
      </div>
      <div class="modal-body"> 
        <form action="{{ route('surveys.update', $survey->id) }}" method="post">
        @csrf
        @method('PATCH')

          <div class="mb-3">
            <label for="survey_name" class="form-label">
              Edit Survey Name
            </label>
            <input type="text" name="survey_name" class="form-control" id="survey_name" value="{{ $survey->survey_name }}">
          </div>

          <div class="mb-3">
            <label for="iframe_url" class="form-label">
              Iframe Url
            </label>
            <input type="url" name="iframe_url" class="form-control" id="iframe_url" value="{{ $survey->iframe_url }}" placeholder="Survey To Go CAWI Link">
          </div>

          <div class="row">
          <div class="col">
            <label for="project_type" class="form-label">
              Survey Type
            </label>
            <select class="form-select" id="project_type" name="type">
              <option value="{{ $survey->type }}" selected>
                {{ $survey->type }}
              </option>
              <option value="CATI">CATI</option>
              <option value="CAWI">CAWI</option>
              <option value="CAPI">CAPI</option>
            </select>
            <div id="surveyType" class="form-text">
              Type of the survey
            </div>
          </div>
          <div class="col">
            <label for="database" class="form-label">
              Data Protection Module
            </label>
            <select class="form-select" name="database" aria-label="Select Database">
              <option value="{{ $survey->database }}" selected>
                {{ $survey->database }}
              </option>
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

          <div class="mb-3">
            <label for="stage" class="form-label">
              Staging
            </label>
            <select name="stage" class="form-select" aria-label="Change Survey Stage">
              <option value="{{ $survey->stage }}" selected>
                {{ $survey->stage }}
              </option>
              <option value="Draft">
                Draft
              </option>
              <option value="Pilot">
                Pilot
              </option>
              <option value="Production">
                Production
              </option>
              <option value="Closed">
                Closed
              </option>
            </select>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary">
              Update
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>