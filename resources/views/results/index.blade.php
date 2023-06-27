@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Survey Results
        </div>
        <div class="col">
          @include('partials/alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
            <table class="table caption-top">
              @canany(['admin','ceo','head'])
              <caption>
               All System results
              </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Ext No</th>
                  <th scope="col">IP Address</th>
                </tr>
              </thead>
              <tbody>
                @foreach($results as $result)
                <tr>
                  <th scope="row">
                    
                    <a href="{{ route('results.show', $result->id) }}" title="View Results">
                      <i class="fas fa-eye"></i>
                      {{ $result->id  }}
                    </a>
                  </th>
                  
                  <td>
                    {{ $result->ext_no }}
                  </td>
                  <td>
                    {{ $result->ip_address }}
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $results->links() }}
              </tfoot>
            </table>
          </div>

    </div>
  </div>
</div>


@endsection