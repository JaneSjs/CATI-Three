@extends('layouts.main')
    
@section('content')


<section class="h-100 gradient-custom-2 mb-4">
  <div class="card h-100">
    <div class="card-header">
      <h2>
        {{ $project->name }} DPIA
      </h2>
      <div class="row">
        <div class="col">
          
        </div>
        <div class="col">
          @canany(['admin','dpo'])
            <div class="btn-group">
              <button type="button" class="btn btn-outline-primary btn-sm" data-coreui-toggle="modal" data-coreui-target="#dpa_documents-{{ $project->id }}" title="Upload DPIA Documents">
                <i class="fa-solid fa-upload"></i>
              </button>
              <button type="button" class="btn btn-outline-success btn-sm" data-coreui-toggle="modal" data-coreui-target="#approve_project-{{ $project->id }}" title="Approve {{ $project->name }} DPIO ?">
                <i class="fa-solid fa-check"></i>
              </button>
            </div>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item">
              <strong>Approved or Not</strong>
            </li>
            <li class="list-group-item" title="Data Protection Impact Assessment">
              Project <strong>DPIA</strong> Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item" title="Data Protection Sensitization">
              Interviewers <strong>DPS</strong> Training Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item">
              Data Protection Controller/Processor Agreement Document
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item">
              Extra Document 1
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
            <li class="list-group-item">
              Extra Document 2
              <a href="" class="btn btn-primary btn-sm text-light float-end">
                <i class="fa-solid fa-download"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </div>
</section>

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
        <form action="{{ route('dpias.update', $project->id) }}" method="post">
          @csrf
          @method('PUT')

          <input type="hidden" name="dpia_approval" value="Approved">

          <button type="submit" class="btn btn-outline-success">
            Approve
          </button>
        </form>
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
      <form action="{{ route('dpias.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <input type="file" class="form-control" name="dpia_document" id="dpia_document">
              <label for="dpia_document" class="form-label">
                DPIA Document
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


@endsection