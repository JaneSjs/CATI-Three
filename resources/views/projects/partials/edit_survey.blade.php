<div class="modal fade" id="edit-survey-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="stageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stageLabel">
         Edit {{ $survey->survey_name }}
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
            <label for="stage" class="form-label">
              Change Stage
            </label>
            <select name="stage" class="form-select" aria-label="Default select example">
              <option value="Draft" selected>
                Draft
              </option>
              <option value="Test">
                Test
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