<!-- View Respondent Modal-->
<div class="modal fade" id="viewRespondent-{{ $respondent->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-primary">
          Respondent's Details
        </h4>
      </div>
      <div class="modal-body">
        <section style="background-color: #eee;">
          <div class="container py-5">
            <div class="row">
              <div class="col-lg-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <img src="{{ $respondent->gender === 'Male' ? asset('assets/images/male-avatar.png') : asset('assets/images/female-avatar.png') }}" alt="{{ $respondent->name }} Respondent Image"
                      class="rounded-circle img-fluid" style="width: 150px;" title="{{ $respondent->gender }}">
                    <h5 class="my-3">
                      {{ $respondent->name }}
                    </h5>
                    
                    <span class="text-primary">
                      {{ $respondent->gender }}
                    </span>
                    <span class="text-primary">
                      {{ $respondent->dob }}
                    </span>
                    <span class="text-primary">
                      {{ $respondent->age_group }}
                    </span>
                    <hr>
                    <span class="text-primary">
                      {{ $respondent->edication_level }}
                    </span>
                    <span class="text-primary">
                      {{ $respondent->marital_status }}
                    </span>
                    <span class="text-primary">
                      {{ $respondent->religion }}
                    </span>
                    <span class="text-primary">
                      {{ $respondent->income }}
                    </span>
                  </div>
                </div>
                
              </div>
              <div class="col-lg-8">
                <div class="card mb-4">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">
                         Setting
                        </p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">
                          {{ $respondent->setting }}
                        </p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Project</p>
                      </div>
                      <div class="col-sm-9">
                        {{ $respondent->project->name }} | 
                        <span class="badge bg-primary">
                          {{ $respondent->schema->survey_name }}
                        </span>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">
                          {{ $respondent->email }}
                        </p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Phone</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">
                          {{ $respondent->phone_1 . ' / ' . $respondent->phone_2 }}
                        </p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">National Id</p>
                      </div>
                      <div class="col-sm-9">
                        <p class="text-muted mb-0">
                          {{ $respondent->national_id }}
                        </p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Location</p>
                      </div>
                      <div class="col-sm-9">
                        <span class="badge bg-primary">
                          {{ $respondent->region }}
                        </span>
                        <span class="badge bg-primary">
                          {{ $respondent->county }}
                        </span>
                        <span class="badge bg-primary">
                          {{ $respondent->sub_county }}
                        </span>
                        <span class="badge bg-primary">
                          {{ $respondent->constituency }}
                        </span>
                        <span class="badge bg-primary">
                          {{ $respondent->ward }}
                        </span>
                        <span class="badge bg-primary">
                          {{ $respondent->sampling_point }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End View Respondent Modal-->