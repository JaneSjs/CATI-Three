@extends('layouts.main')
    
@section('content')
  @php
    use Carbon\Carbon;
  @endphp

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h4 class="text-center text-primary">
            Scheduled Interviews
          </h4>
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <thead class="table-warning">
            <tr>
              <th scope="col">Interview Id</th>
              <th scope="col">Project</th>
              <th scope="col">Survey</th>
              <th scope="col">Interview Links</th>
              <th scope="col">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($scheduled_interviews as $scheduled_interview)
              <tr>
                <td>
                  <strong class="text-primary">
                    {{ $scheduled_interview['interview_id'] }}
                  </strong>
                </td>
                <td>
                  {{ $scheduled_interview->project->name }}
                </td>
                <td>
                  {{ $scheduled_interview->survey->survey_name }}
                </td>
                <td>
                  <a href="{{ $scheduled_interview['interview_url'] }}" class="btn btn-outline-info" target="_blank">
                    {{ Carbon::parse($scheduled_interview['interview_datetime'])->format('l jS \\a\\t H:i \\H\\r\\s') }}
                  </a>
                </td>
                <td>
                  {{ $scheduled_interview['interview_status'] }}
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            {{ $scheduled_interviews->links() }}
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection