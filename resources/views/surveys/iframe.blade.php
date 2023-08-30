<div class="card-body" style="width: auto; height: auto;">
  <?php $encoded_iframe_url = urlencode($iframe_url) ?>
  <iframe src="{{ $iframe_url }}" style="height:700px;width:100%;" title="Survey Loading Within The Iframe"></iframe>
   
</div>
<div class="card-footer">
  <div class="row">
    <div class="col">
      <form action="{{ route('update_interview_status') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent_id }}">
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="interview_id" value="{{ $interview->id }}">
        <input type="hidden" name="iframe_url" value="{{ $iframe_url  }}">
        <input type="hidden" name="interview_status" value="Interview Terminated">

        <button type="submit" class="btn btn-danger">
          Terminate Interview
          <i class="fa-solid fa-xmark" style="color: #ffffff;"></i>
        </button>
      </form>
    </div>
    <div class="col text-end">
      <form action="{{ route('update_interview_status') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="respondent_id" value="{{ $respondent_id }}">
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="interview_id" value="{{ $interview->id }}">
        <input type="hidden" name="iframe_url" value="{{ $iframe_url  }}">
        <input type="hidden" name="interview_status" value="Interview Completed">

        <button type="submit" class="btn btn-success">
          Complete Interview
          <i class="fa-solid fa-check" style="color: #ffffff;"></i>
        </button>
      </form>
    </div>
  </div>
</div>