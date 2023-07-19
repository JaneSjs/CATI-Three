<div class="card-body">
  <!-- For Survey Model-->
  <p id="survey_url" style="display: none;">
    {{ route("api.surveys.show", $survey->id) }}
  </p>
  <p id="survey_id" style="display: none;">
    {{ $survey->id }}
  </p>
  <!-- End Survey Model-->


  <!-- For Saving Survey Results-->
  <p id="result_url" style="display: none;">
    {{ route('api.results.store') }}
  </p>
  <p id="user_id" style="display: none;">
    {{ auth()->user()->id }}
  </p>
  <p id="interview_id" style="display: none;">
    {{ $interview->id ?? 1}}
  </p>
  <p id="respondent_id" style="display: none;">
    {{ $respondent_id ?? 1}}
  </p>
  <p id="schema_id" style="display: none;">
    {{ route('api.results.store') }}
  </p>
  <!-- Survey Results-->

  <survey params="survey: model"></survey>

</div>

<script type="text/javascript" src="{{ asset('assets/survey_js/survey.js') }}" defer></script>