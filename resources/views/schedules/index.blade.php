@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Scheduled Interviews
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-danger">
           Scheduled Interviews
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Interviews</th>
              <th scope="col">Status</th>
              <th scope="col"></th>
              @canany(['admin'])
                <th scope="col">Actions</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach($scheduled_interviews as $scheduled_interview)
              <tr>
                <td>
                  
                </td>
                <td>
                  <a href="{{ $scheduled_interview['interview_url'] }}" class="btn btn-outline-info" target="_blank">
                    {{ $scheduled_interview['interview_datetime'] }}
                  </a>
                </td>
                <td>
                  {{ $scheduled_interview['interview_status'] }}
                </td>
                <td>
                  <button class="btn btn-outline-primary" title="Currently under development">
                    Assign To Someone Else
                  </button>
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