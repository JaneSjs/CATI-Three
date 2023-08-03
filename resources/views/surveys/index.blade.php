@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Surveys
        </div>
        <div class="col">
          @include('partials.alerts')
        </div>
        <div class="col text-end">
          @canany(['admin','manager'])
          <a href="{{ route('surveys.create') }}" class="btn btn-outline-success">
            Create Survey
          </a>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped-columns table-hover table-sm caption-top">
          <caption class="text-danger">
           Active Surveys
          </caption>
          <thead class="table-warning">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Stage</th>
              <th scope="col">Version</th>
              <th scope="col">Last Updated By</th>
            </tr>
          </thead>
          <tbody>
            @foreach($surveys as $survey)
            <tr>
              <th scope="row">
                {{ $survey->id }}
              </th>
              <td>
                  <strong class="text-primary">
                    {{ $survey->survey_name }}
                  </strong>
              </td>
              <td>
                {{ $survey->stage }}
              </td>
              <td>
                {{ $survey->version }}
              </td>
              <td>
                {{ $survey->updated_by }}
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            {{ $surveys->links() }}
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection