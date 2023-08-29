<div class="card-body" style="width: auto; height: auto;">
  <?php $encoded_iframe_url = urlencode($iframe_url) ?>
  <iframe src="{{ $iframe_url }}" style="height:700px;width:100%;" title="Iframe Survey"></iframe>
   
</div>
<div class="card-footer">
  <div class="text-center mt-o">
    <!-- <a href="{{ route('update_interview_status', [$respondent_id, $survey->id, $project->id, $interview->id, urlencode($iframe_url)]) }}" class="btn btn-secondary">
      Begin Another Interview
    </a> -->

    <form action="{{ route('update_interview_status') }}" method="post">
      @csrf
      @method('PATCH')
      <input type="hidden" name="respondent_id" value="{{ $respondent_id }}">
      <input type="hidden" name="survey_id" value="{{ $survey->id }}">
      <input type="hidden" name="project_id" value="{{ $project->id }}">
      <input type="hidden" name="interview_id" value="{{ $interview->id }}">
      <input type="hidden" name="iframe_url" value="{{ $iframe_url  }}">

      <button type="submit" class="btn btn-secondary">
        Begin Another Interview
      </button>
    </form>
  </div>
</div>