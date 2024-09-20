@can('interviewer')
<!-- Respondent Feedback Modal -->
<div class="modal fade" id="respondent_feedback" tabindex="-1" aria-labelledby="respondent_feedback" data-coreui-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="respondent_feedback">
          Respondent Feedback
        </h5>

        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('respondent_feedback') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="schema_id" value="{{ $survey->id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="predefined_feedback" class="form-label text-primary">
              Predefined Feedbacks
            </label>
            <select id="predefined_feedback" class="form-select" name="predefined_feedback">
              <option value="Phone Ringed But Was Not Answered. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Phone Ringed But Was Not Answered
              </option>
              <option value="Phone Ringed But Was Not Answered Even After a Few Attempts. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Phone Ringed But Was Not Answered Even After a Few Attempts
              </option>
              <option value="Phone Ringed But Was Not Answered Even After Many Attempts. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Phone Ringed But Was Not Answered Even After Many Attempts
              </option>
              <option value="Phone Was Hanged Up. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Phone Was Hanged Up
              </option>
              <option value="Was Not Reachable (Mteja Hapatikani). Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Mteja Wa Nambari Uliopigwa Hapatikani Kwa Sasa
              </option>
              <option value="Has Blocked TIFA. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has Blocked TIFA. 
              </option>
              <option value="Not Interested. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Not Interested. 
              </option>
              <option value="Not Interested Today. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Not Interested Today. 
              </option>
              <option value="Busy. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:m') }}">
                User Busy. 
              </option>
              <option value="Voicemail. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Voicemail.
              </option>
              <option value="Wrong Number. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Wrong Number. 
              </option>
              <option value="Has Blocked TIFA. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has Blocked TIFA. 
              </option>
              <option value="Number Not In Service. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Number Not In Service. 
              </option>
              <option value="Has Already Participated. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has Already Participated. 
              </option>
              <option value="Refused To Participate. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Refused To Participate. 
              </option>
              <option value="Not In A Position Participate. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Not In A Position Participate. 
              </option>
              <option value="Does Not Qualify. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Does Not Qualify. 
              </option>
              <option value="Has Not Received Airtime Previously. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has Not Received Airtime Previously. 
              </option>
              <option value="Has Never Received Airtime Before. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has Never Received Airtime Before. 
              </option>
              <option value="Phone Was Off. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Phone Was Off. 
              </option>
              <option value="Rude. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Rude. 
              </option>
              <option value="Very Rude. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Very Rude.
              </option>
              <option value="Is Abusive. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Is Abusive.
              </option>
              <option value="Respondent Cannot Hear The Interviewer. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                The Respondent Cannot Hear Me.
              </option>
              <option value="Respondent Cannot Be Heard. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                I Cannot Hear The Respondent. 
              </option>
              <option value="Network Problems. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Network Problems
              </option>
              <option value="Language Barrier. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Language Barrier. 
              </option>
              <option value="Cannot Speak English. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Cannot Speak English. 
              </option>
              <option value="Cannot Speak Kiswahili. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Cannot Speak Kiswahili. 
              </option>
              <option value="Is Not The Owner Of The Phone. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Is Not The Owner Of The Phone. 
              </option>
              <option value="Is Disabled. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Is Disabled. 
              </option>
              <option value="Is Sick. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Is Sick.
              </option>
              <option value="Is a Liar. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Is a Liar.
              </option>
              <option value="Has No Time. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Has No Time.
              </option>
              <option value="Unable To Complete The Interview. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Unable To Complete The Interview. 
              </option>
              <option value="Quota Met. Called by {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }} on {{ date('l d/m/Y H:i') }}">
                Quota Met.
              </option>
            </select>

            <script defer>
              $(document).ready(function () {
                $('#predefined_feedback').select2({
                  dropdownParent: $('#respondent_feedback'),
                  placeholder: 'Chagua  moja',
                  width: '100%'
                });
                $.fn.select2.defaults.set("theme", "classic");
              });
            </script>
          </div>
          <hr>
          <div class="mb-3">
            <label for="unique_feedback" class="form-label bg-warning text-dark">
              Type Unique Feedback Here.
            </label>
            <textarea class="form-control" name="unique_feedback" id="unique_feedback" rows="7">
              {{ old('unique_feedback') }}
            </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-block">
            Submit Feedback
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Respondent Feedback Modal -->
@endcan