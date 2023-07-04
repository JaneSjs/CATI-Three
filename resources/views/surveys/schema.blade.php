<div class="card-body">
      <!-- For Survey Model-->
      <p id="survey_url" style="display: none;">
        {{ route("api.surveys.show", $survey->id) }}
      </p>
      <p id="survey_id" style="display: none;">
        {{ $survey->id }}
      </p>
      <!-- End Survey Model-->


      <!-- For Survey Results-->
      <p id="result_url" style="display: none;">
        {{ route('api.results.store') }}
      </p>
      <p id="user_id" style="display: none;">
        {{ auth()->user()->id }}
      </p>
      <p id="schema_id" style="display: none;">
        {{ route('api.results.store') }}
      </p>
      <!-- Survey Results-->

      <survey params="survey: model"></survey>

    </div>