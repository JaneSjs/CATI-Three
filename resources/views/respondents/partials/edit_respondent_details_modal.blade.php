<!-- Edit Respondent Details Modal -->
<div class="modal fade" id="editRespondentDetails-{{ $respondent->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="editRespondent" aria-hidden="true">
  <div class="modal-dialog modal-lg bg-info">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editRespondent">
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
            <div class="row mb-3">
              <div class="col">
                <label for="gender" class="form-label">
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
              <div class="col">
                <label for="phone_2" class="form-label">
                  Setting
                </label>
                <select class="form-select form-select-sm" name="setting" id="setting" aria-label="Respondent Setting">
                  <option value="" @selected(is_null($respondent->setting))>
                    Select Setting
                  </option>
                  <option value="Rural" @selected($respondent->setting == 'Rural')>
                    Rural
                  </option>
                  <option value="Urban" @selected($respondent->setting == 'Urban')>
                    Urban
                  </option>
                </select>
                <div id="setting" class="form-text">
                  setting
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
                  <option value="BARINGO" @selected($respondent->county == 'BARINGO')>
                    BARINGO
                  </option>
                  <option value="BOMET" @selected($respondent->county == 'BOMET')>
                    BOMET
                  </option>
                  <option value="BUNGOMA" @selected($respondent->county == 'BUNGOMA')>
                    BUNGOMA
                  </option>
                  <option value="BUSIA" @selected($respondent->county == 'BUSIA')>
                    BUSIA
                  </option>
                  <option value="DIASPORA" @selected($respondent->county == 'DIASPORA')>
                    DIASPORA
                  </option>
                  <option value="ELGEIYO MARAKWET" @selected($respondent->county == 'ELGEIYO MARAKWET')>
                    ELGEIYO MARAKWET
                  </option>
                  <option value="EMBU" @selected($respondent->county == 'EMBU')>
                    EMBU
                  </option>
                  <option value="GARISSA" @selected($respondent->county == 'GARISSA')>
                    GARISSA
                  </option>
                  <option value="HOMA BAY" @selected($respondent->county == 'HOMA BAY')>
                    HOMA BAY
                  </option>
                  <option value="ISIOLO" @selected($respondent->county == 'ISIOLO')>
                    ISIOLO
                  </option>
                  <option value="KAJIADO" @selected($respondent->county == 'KAJIADO')>
                    KAJIADO
                  </option>
                  <option value="KAKAMEGA" @selected($respondent->county == 'KAKAMEGA')>
                    KAKAMEGA
                  </option>
                  <option value="KERICHO" @selected($respondent->county == 'KERICHO')>
                    KERICHO
                  </option>
                  <option value="KIAMBU" @selected($respondent->county == 'KIAMBU')>
                    KIAMBU
                  </option>
                  <option value="KILIFI" @selected($respondent->county == 'KILIFI')>
                    KILIFI
                  </option>
                  <option value="KIRINYAGA" @selected($respondent->county == 'KIRINYAGA')>
                    KIRINYAGA
                  </option>
                  <option value="KISII" @selected($respondent->county == 'KISII')>
                    KISII
                  </option>
                  <option value="KISUMU" @selected($respondent->county == 'KISUMU')>
                    KISUMU
                  </option>
                  <option value="KITUI" @selected($respondent->county == 'KITUI')>
                    KITUI
                  </option>
                  <option value="KWALE" @selected($respondent->county == 'KWALE')>
                    KWALE
                  </option>
                  <option value="LAIKIPIA" @selected($respondent->county == 'LAIKIPIA')>
                    LAIKIPIA
                  </option>
                  <option value="LAMU" @selected($respondent->county == 'LAMU')>
                    LAMU
                  </option>
                  <option value="MACHAKOS" @selected($respondent->county == 'MACHAKOS')>
                    MACHAKOS
                  </option>
                  <option value="MAKUENI" @selected($respondent->county == 'MAKUENI')>
                    MAKUENI
                  </option>
                  <option value="MANDERA" @selected($respondent->county == 'MANDERA')>
                    MANDERA
                  </option>
                  <option value="MARSABIT" @selected($respondent->county == 'MARSABIT')>
                    MARSABIT
                  </option>
                  <option value="MERU" @selected($respondent->county == 'MERU')>
                    MERU
                  </option>
                  <option value="MIGORI" @selected($respondent->county == 'MIGORI')>
                    MIGORI
                  </option>
                  <option value="MOMBASA" @selected($respondent->county == 'MOMBASA')>
                    MOMBASA
                  </option>
                  <option value="MURANG'A" @selected($respondent->county == "MURANG'A")>
                    MURANG'A
                  </option>
                  <option value="NAIROBI CITY" @selected($respondent->county == 'NAIROBI CITY')>
                    NAIROBI CITY
                  </option>
                  <option value="NAKURU" @selected($respondent->county == 'NAKURU')>
                    NAKURU
                  </option>
                  v
                  <option value="NANDI" @selected($respondent->county == 'NANDI')>
                    NANDI
                  </option>
                  <option value="NAROK" @selected($respondent->county == 'NAROK')>
                    NAROK
                  </option>
                  <option value="NYAMIRA" @selected($respondent->county == 'NYAMIRA')>
                    NYAMIRA
                  </option>
                  <option value="NYANDARUA" @selected($respondent->county == 'NYANDARUA')>
                    NYANDARUA
                  </option>
                  <option value="NYERI" @selected($respondent->county == 'NYERI')>
                    NYERI
                  </option>
                  <option value="SAMBURU" @selected($respondent->county == 'SAMBURU')>
                    SAMBURU
                  </option>
                  <option value="SIAYA" @selected($respondent->county == 'SIAYA')>
                    SIAYA
                  </option>
                  <option value="TAITA TAVETA" @selected($respondent->county == 'TAITA TAVETA')>
                    TAITA TAVETA
                  </option>
                  <option value="TANA RIVER" @selected($respondent->county == 'TANA RIVER')>
                    TANA RIVER
                  </option>
                  <option value="THARAKA NITHI" @selected($respondent->county == 'THARAKA NITHI')>
                    THARAKA NITHI
                  </option>
                  <option value="TRANS NZOIA" @selected($respondent->county == 'TRANS NZOIA')>
                    TRANS NZOIA
                  </option>
                  <option value="TURKANA" @selected($respondent->county == 'TURKANA')>
                    TURKANA
                  </option>
                  <option value="UASIN GISHU" @selected($respondent->county == 'UASIN GISHU')>
                    UASIN GISHU
                  </option>
                  <option value="VIHIGA" @selected($respondent->county == 'VIHIGA')>
                    VIHIGA
                  </option>
                  <option value="WAJIR" @selected($respondent->county == 'WAJIR')>
                    WAJIR
                  </option>
                  <option value="WEST POKOT" @selected($respondent->county == 'WEST POKOT')>
                    WEST POKOT
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