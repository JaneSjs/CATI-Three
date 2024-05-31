<!-- Bulk Soft Delete Respondents Modal-->
<div class="modal fade" id="bulkSoftDeleteRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog bg-warning">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Bulk Soft Delete {{ $survey->survey_name }} Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('bulk_soft_delete_respondents') }}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <button type="submit" class="btn btn-sm btn-outline-warning">
            Bulk Soft Delete
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- End Bulk Soft Delete Respondents Modal-->

<!-- Bulk Permanent Delete Respondents Modal-->
<div class="modal fade" id="bulkPermanentDeleteRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="staticBackdropLabel">
          Permanently Delete 
          <span style="text-decoration: underline;">
            {{ $survey->survey_name }}
          </span> 
          Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h5 class="alert-heading">
            Permanently deleting respondents removes them completely from the system.
          </h5>
          <p>
            This means the system will no longer remember them and they can later be re-introduced back to the system.
          </p>
          <hr>
          <p class="mb-o">
            Proceed with caution!
          </p>
        </div>

        <form action="{{ route('bulk_permanent_delete_respondents') }}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <button type="submit" class="btn btn-sm btn-outline-danger">
            Bulk Permanent Delete
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- End Bulk Permanent Delete Respondents Modal-->

<!-- Restore Deleted Respondents Modal-->
<div class="modal fade" id="restoreDeletedRespondents" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog bg-info">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="staticBackdropLabel">
          Restore 
          <span style="text-decoration: underline;">
            {{ $survey->survey_name }}
          </span>
          Deleted Respondents
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info" role="alert">
          <h5 class="alert-heading">
            These previously deleted respondents will be restored.
          </h5>
          <p>
            This means they be back to the respondents database and searchable for interviewing.
          </p>
          <hr>
          <p class="mb-o">
            Proceed with caution!
          </p>
        </div>

        <form action="{{ route('restore_respondents') }}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="survey_id" value="{{ $survey->id }}">
          <button type="submit" class="btn btn-sm btn-outline-info">
            Restore
          </button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- End Restore Deleted Respondents Modal-->

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