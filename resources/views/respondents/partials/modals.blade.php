<!-- Bulk Delete Respondents Modal-->
<div class="modal fade" id="bulkDeleteRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Bulk Delete {{ $survey->survey_name }} Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('bulk_delete_respondents') }}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <button type="submit" class="btn btn-sm btn-outline-danger">
            Bulk Delete
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- End Bulk Delete Respondents Modal-->

<!-- Unlock Respondents Modal-->
<div class="modal fade" id="unlockRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Unlock Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('unlock_respondents') }}" method="post">
          @csrf
          @method('PATCH')
          <input type="hidden" name="surveyId" value="{{ $survey->id }}">
          <button type="submit" class="btn btn-sm btn-outline-success">
            Unlock
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Unlock Respondents Modal-->