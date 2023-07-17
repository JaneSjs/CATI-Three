<div class="d-none">
  <p id="survey_id">{{ $interview->survey->id  }}</p>
  <p id="interview_id">{{ $interview->id  }}</p>
  <p id="result_url">{{ route('api.results.show', $interview->id)  }}</p>
</div>

<div class="container">

  <div class="table-responsive">
	  <table class="table table-bordered">
	  	<thead>
	  		<tr>
	  			<th>
	  				Survey Results
	  			</th>
	  		</tr>
	  	</thead>
	    <tbody id="json-data"></tbody>
	  </table>
	</div>

</div>

<script type="text/javascript" src="{{ asset('assets/custom/coding.js') }}" defer></script>

