<!-- Edit Respondent Details Modal -->
<div class="modal fade" id="editRespondentDetails-{{ $respondent->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="editExtNoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg bg-info">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExtNoLabel">
          Edit Respondent Details
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('update_respondent', $respondent->id) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent->id }}">
        <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="name" class="form-label">
                  Respondent Name
                </label>
                <input type="text" class="form-control" id="name" aria-describedby="respondentName" name="name" value="{{ $respondent->name ?? old('name') }}">
                <div id="respondentName" class="form-text">
                  Correct Name of The Respondent
                </div>
              </div>
              <div class="col mb-3">
                <label for="phone_2" class="form-label">
                  Alternative Phone Number
                </label>
                <input type="text" class="form-control" id="phone_2" aria-describedby="alternativePhoneNumber" name="phone_2" value="{{ $respondent->phone_2 ?? old('phone_2') }}">
                <div id="alternativePhoneNumber" class="form-text">
                  Alternative Phone Number
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="occupation" class="form-label">
                  Respondent Occupation
                </label>
                <input type="text" class="form-control" id="occupation" aria-describedby="respondentName" name="occupation" value="{{ $respondent->occupation ?? old('occupation') }}">
                <div id="respondentName" class="form-text">
                  Respondent Occupation
                </div>
              </div>
              <div class="col mb-3">
                <label for="phone_2" class="form-label">
                  Gender
                </label>
                <select class="form-select form-select-sm" name="gender" id="gender" aria-label="Respondent Gender">
                  <option value="" @selected(is_null($respondent->gender))>
                    Select Gender
                  </option>
                  <option value="Male" @selected($respondent->gender == 'Male')>
                    Male
                  </option>
                  <option value="Female" @selected($respondent->gender == 'Female')>
                    Female
                  </option>
                </select>
                <div id="gender" class="form-text">
                  gender
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="region" class="form-label">
                  Region
                </label>
                <select class="form-select form-select-sm" name="region" id="region" aria-label="Respondent Region">
                  <option value="" @selected(is_null($respondent->region))>
                    Select Region
                  </option>
                  <option value="CENTRAL" @selected($respondent->region == 'CENTRAL')>
                    CENTRAL
                  </option>
                  <option value="COAST" @selected($respondent->region == 'COAST')>
                    COAST
                  </option>
                  <option value="Eastern" @selected($respondent->region == 'Eastern')>
                    Eastern
                  </option>
                  <option value="Nairobi" @selected($respondent->region == 'Nairobi')>
                    Nairobi
                  </option>
                  <option value="North Eastern" @selected($respondent->region == 'North Eastern')>
                    North Eastern
                  </option>
                  <option value="Nyanza" @selected($respondent->region == 'Nyanza')>
                    Nyanza
                  </option>
                  <option value="Rift Valley" @selected($respondent->region == 'Rift Valley')>
                    Rift Valley
                  </option>
                  <option value="Western" @selected($respondent->region == 'Western')>
                    Western
                  </option>
                </select>
                <div id="region" class="form-text">
                  Region
                </div>
              </div>
              <div class="col mb-3">
                <label for="county" class="form-label">
                  County
                </label>
                <select class="form-select form-select-sm" name="county" id="county" aria-label="Respondent County">
                  <option value="" @selected(is_null($respondent->county))>
                    Select County
                  </option>
                  <option value="Baringo" @selected($respondent->county == 'Baringo')>
                    Baringo
                  </option>
                  <option value="Bomet" @selected($respondent->county == 'Bomet')>
                    Bomet
                  </option>
                </select>
                <div id="county" class="form-text">
                  County
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Respondent Details Modal -->