@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Respondents
        </div>
        <div class="col">
          <form action="#!" method="GET">
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search for respondents..." aria-label="Search for respondents..." aria-describedby="search_respondents" value="">
              <button type="submit" class="btn btn-outline-info" id="search_respondents">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="col text-end">

          @include('partials/alerts')

          @canany(['admin','head','manager','coordinator'])
          <a href="{{ url('respondents/import') }}" class="btn btn-outline-success">
            Import respondents
          </a>
          @endcan
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-9">
          <div class="table-responsive">
            <table class="table caption-top">
              @canany(['admin','ceo','head'])
              <caption>
               All System respondents
              </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Id</th>
                  <th scope="col">Interview Status</th>
                  <th scope="col">Feedback</th>
                  <th scope="col">Interview DateTime</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($respondents as $respondent)
                <tr>
                  <th scope="row">
                    <i class="fas fa-eye"></i>
                    <a href="{{ route('respondents.show', $respondent->id) }}">
                      {{ $respondent->name }}
                    </a>
                  </th>
                  <td>
                    ####{{ $respondent->id ?? '-' }}
                  </td>
                  <td>
                    {{ $respondent->interview_status ?? '-' }}
                  </td>
                  <td>
                    {{ $respondent->feedback ?? '-' }}
                  </td>
                  <td>
                    {{ $respondent->interview_date_time }}
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('respondents.edit', $respondent->id) }}" class="btn btn-sm btn-outline-info" title="Update respondent Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @can('supervisor')
                      <button type="button" class="btn btn-sm btn-outline-primary" title="Recruit {{ $respondent->last_name }}">
                        <i class="fas fa-respondent-tie"></i>
                      </button>
                      @endcan

                      @can('supervisor')
                      <form action="{{ route('respondents.destroy', $respondent->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove {{ $respondent->last_name }}">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                      @endcan
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $respondents->links() }}
              </tfoot>
            </table>
          </div>
        </div>
        @canany(['admin','ceo','head'])
        <div class="col-3 bg-secondary">
          <strong>
            {{ $total_respondents }} Respondents
          </strong>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection