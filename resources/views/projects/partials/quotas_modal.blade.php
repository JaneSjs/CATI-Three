<div class="modal fade" id="quotas-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          {{ $survey->survey_name }} Quotas
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('surveys.store') }}">
        @csrf
        
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="row mb-3">
            <div class="col">
              <label for="survey_name" class="form-label">
                Occupation
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
            <div class="col">
              <label for="survey_name" class="form-label">
                Region
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
            <div class="col">
              <label for="survey_name" class="form-label">
                County
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
          </div>
          <input type="hidden" name="project_id" value="{{ $project->id }}">
      </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </div>
  </div>
</div>