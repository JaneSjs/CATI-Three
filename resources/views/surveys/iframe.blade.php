<div class="card-body" style="width: auto; height: auto;">
   <iframe src="{{ $survey->iframe_url }}" style="height:700px;width:100%;" title="Iframe Survey"></iframe>
   
</div>
<div class="card-footer">
  <div class="text-center mt-o">
    <a href="{{ route('update_interview_status', [$respondent_id, $survey->id, $project->id, $interview->id]) }}" class="btn btn-secondary">
      Begin Another Interview
    </a>
  </div>
</div>