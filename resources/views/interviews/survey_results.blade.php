<div class="card-body">

  <!-- For Survey Model-->
  <p id="survey_url" style="display: none;">
    {{ route("api.surveys.show", $interview->survey->id) }}
  </p>
  <p id="survey_id" style="display: none;">
    {{ $interview->survey->id }}
  </p>
  <!-- End Survey Model-->

  <survey params="survey: model"></survey>

</div>

<script type="text/javascript" src="{{ asset('assets/survey_js/survey_results.js') }}" defer></script>