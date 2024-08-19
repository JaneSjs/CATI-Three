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