@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Interviewer</th>
              <th>Respondent</th>
              <th>Interview Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <button class="btn btn-dark">
                Show Results
              </button>
            </td>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="{{ asset('assets/survey_js/survey_results.js') }}" defer></script>

@endsection