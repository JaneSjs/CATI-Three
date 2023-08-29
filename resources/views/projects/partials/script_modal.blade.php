<div class="modal fade" id="script_modal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <span class="text-primary">
            {{ $survey->survey_name }} Survey
          </span>
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-outline-warning" target="_blank" rel="noreferrer">
              <img src="{{ asset('assets/survey_js/SurveyJs-Logo.png') }}" alt="Dooblo" height="50px" width="100px">
            </a>
          </div>
          <div class="col">
            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-success" target="_blank" rel="noreferrer">
              <img src="{{ asset('assets/dooblo/Dooblo_logo_white.png') }}" alt="Dooblo" height="50px" width="100px">
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>