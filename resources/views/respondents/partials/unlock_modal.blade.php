<!-- Unlock Respondents Modal-->
<div class="modal fade" id="unlockRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog bg-primary">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="staticBackdropLabel">
          Unlock Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>
          Are you sure ?
        </h6>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col">
            <form action="{{ route('unlock_respondents') }}" method="post">
              @csrf
              @method('PATCH')
              <input type="hidden" name="survey_id" value="{{ $survey->id }}">
              <button type="submit" class="btn btn-success btn-sm">
                Yes
              </button>
            </form>
          </div>
          <div class="col">
            <button type="button" class="btn btn-primary btn-sm" data-coreui-dismiss="modal" aria-label="No">
              No
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Unlock Respondents Modal-->

