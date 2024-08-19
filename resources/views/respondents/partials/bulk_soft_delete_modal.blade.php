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