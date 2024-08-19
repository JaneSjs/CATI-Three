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