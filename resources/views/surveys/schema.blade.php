<div class="card-body">
  <!-- For Survey Model-->
  <p id="survey_url" style="display: none;">
    {{ route("api.surveys.show", $survey->id) }}
  </p>
  <p id="survey_id" style="display: none;">
    {{ $survey->id }}
  </p>
  <!-- End Survey Model-->


  <!-- For Posting Survey Results-->
  <p id="post_result_url" style="display: none;">
    {{ route('api.results.store') }}
  </p>
  <!-- For Patching Survey Results-->
  <p id="patch_result_url" style="display: none;">
    {{ route('api.results.update', $interview->id) }}
  </p>

  <p id="user_id" style="display: none;">
    {{ auth()->user()->id }}
  </p>
  <p id="interview_id" style="display: none;">
    {{ $interview->id ?? 1 }}
  </p>
  <p id="project_id" style="display: none;">
    {{ $interview->project_id ?? '' }}
  </p>
  <p id="respondent_id" style="display: none;">
    {{ $respondent_id ?? 1}}
  </p>
  <p id="schema_id" style="display: none;">
    {{ route('api.results.store') }}
  </p>
  <!-- Survey Results-->

  <!--Translations-->
  <label for="languages">
    Translations
  </label>
  <select id="languages">
    <option value="en">English</option>
    <option value="sw">Kiswahili</option>
    <option value="bg">Bulgarian</option>
  </select>
  <!-- End Translations-->

  <survey params="survey: model"></survey>

</div>


<script type="text/javascript" src="{{ asset('assets/survey_js/survey.js') }}" defer></script>