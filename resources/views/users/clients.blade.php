@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h4 class="text-primary">
            Clients
          </h4>
        </div>
        <div class="col">
          @include('partials/alerts')
        </div>
        <div class="col text-end">
          <div class="btn-group btn-group-sm" role="group" aria-label="Add Client">
            <a href="{{ route('users.create') }}" class="btn btn-outline-success">
              Add Client
              <i class="fa-regular fa-face-smile"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-9">
          <div class="table-responsive">
            <table class="table caption-top table-striped table-bordered">
              @canany(['admin','ceo','head','manager'])
                <caption>
                  Clients List
                </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  @canany(['admin'])
                  <th scope="col">Phone No</th>
                  @endcan
                  <th scope="col">Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($clients as $client)
                <tr>
                  <th scope="row">
                    <i class="fas fa-eye"></i>
                    <a href="{{ route('users.show', $client->id) }}">
                      {{ $client->first_name . ' ' . $client->last_name  }}
                    </a>
                  </th>
                  @canany(['admin'])
                    <td>
                      {{ $client->phone_1 }}
                      @if($client->phone_2)
                      <hr>
                        {{ $client->phone_2 }}
                      @endif
                      @if($client->phone_3)
                      <hr>
                        {{ $client->phone_3 }}
                      @endif
                    </td>
                  @endcan
                  <td>
                    {{ $client->email }}
                  </td>
                  <td>
                    <div class="btn-group">
                      @canany(['admin','ceo','head','manager'])
                      <a href="{{ route('users.edit', $client->id) }}" class="btn btn-sm btn-outline-info" title="Update User Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @endcan
                      @canany(['admin'])
                      <form action="{{ route('users.destroy', $client->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove {{ $client->last_name }}">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </div>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $clients->links() }}
              </tfoot>
            </table>
          </div>
        </div>
        @canany(['admin','ceo','head','supervisor'])
          <div class="col-3 bg-secondary">
           {{ count($clients) }} Clients
          </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection