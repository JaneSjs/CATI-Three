<!-- DPIO Approval Modal -->
<div class="modal fade" id="approve_project-{{ $project->id }}" tabindex="-1" data-coreui-backdrop="static">
  <div class="modal-dialog modal-sm bg-success">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          DPIO Approval For {{ $project->name }}
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          You are about to perform a sensitive operation. Are you sure about this ?
        </p>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col">
            <form action="{{ route('dpias.store') }}" method="post">
              @csrf
              <input type="hidden" name="dpia_approval" value="Approved">
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              <input type="hidden" name="schema_id" value="">

              <button type="submit" class="btn btn-outline-success">
                Approve
              </button>
            </form>
          </div>
          <div class="col">
            <form action="{{ route('dpias.store') }}" method="post">
              @csrf
              <input type="hidden" name="dpia_approval" value="Disapproved">
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              <input type="hidden" name="schema_id" value="">

              <button type="submit" class="btn btn-outline-danger">
                Disapprove
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End DPIO Approval Modal -->

<!-- Upload DPIO Documents Modal -->
<div class="modal fade" id="dpa_documents-{{ $project->id }}" tabindex="-1" data-coreui-backdrop="static">
  <div class="modal-dialog modal-lg bg-primary">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          DPA Documents For {{ $project->name }}
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('dpias.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <input type="file" class="form-control" name="dpia_documents[]" id="dpia_documents" multiple>
              <label for="dpia_documents" class="form-label">
                DPIA Documents
              </label>
            </div>
            <div class="col">
              <input type="file" class="form-control" name="dpa_training_document" id="dpa_training_document">
              <label for="dpa_training_document" class="form-label">
                DPA Training Document
              </label>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <input type="file" class="form-control" name="dpa_controller_agreement_document" id="dpa_controller_agreement_document">
              <label for="dpa_controller_agreement_document" class="form-label">
                Data Protection Controller/Processor Agreement Document
              </label>
            </div>
            <div class="col">
              <input type="file" class="form-control" name="extra_dpa_document_1" id="extra_dpa_document_1">
              <label for="extra_dpa_document_1" class="form-label">
                Extra Document 1
              </label>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <input type="file" class="form-control" name="extra_dpa_document_2" id="extra_dpa_document_2">
              <label for="extra_dpa_document_2" class="form-label">
                Extra Document 2
              </label>
            </div>
            <div class="col">
              <input type="file" class="form-control" name="extra_dpa_document_3" id="extra_dpa_document_3">
              <label for="extra_dpa_document_3" class="form-label">
                Extra Document 3
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          
            <button type="submit" class="btn btn-outline-primary">
              Upload
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Upload DPIO Documents Modal -->