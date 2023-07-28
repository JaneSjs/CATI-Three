<div class="modal fade" id="quotas-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Set Quota Criteria for 
          <span class="text-primary">
            {{ $survey->survey_name }}
          </span>
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('quotas.store') }}">
          @csrf
        
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <input type="hidden" name="schema_id"  value="{{ $survey->id }}">

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="male" class="form-label">Males Target Count</label>
                <input id="male" type="number" name="quota_criteria[gender][male]" class="form-control" placeholder="Male Target Count">
              </div>

              <div class="mb-3">
                <label for="female" class="form-label">Females Target Count</label>
                <input id="female" type="number" name="quota_criteria[gender][female]" class="form-control" placeholder="Female Target Count">
              </div>
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">18-24 Target Count</label>
                <input type="number" name="quota_criteria[age_group][18-24]" class="form-control" placeholder="18-24 Target Count">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">25-29 Target Count</label>
                <input type="number" name="quota_criteria[age_group][25-29]" class="form-control" placeholder="25-29 Target Count">
              </div>                
            </div>
            <div class="col">
              
            </div>
            <div class="col">
              
            </div>
          </div>
          <div class="bg-warning text-end">
            <button type="submit" class="btn btn-outline-primary">
              Set Quotas
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>