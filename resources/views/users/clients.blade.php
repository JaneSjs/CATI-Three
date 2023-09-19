@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Clients
        </div>
        <div class="col">
          @include('partials/alerts')
        </div>
        <div class="col text-end">
          <div class="btn-group btn-group-sm" role="group" aria-label="Management Actions">
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
              @canany(['admin','ceo','head'])
              <caption>
               Call Center Clients
              </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Phone No</th>
                  <th scope="col">Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <th scope="row">
                    <i class="fas fa-eye"></i>
                    <a href="{{ route('users.show', $user->id) }}">
                      {{ $user->first_name . ' ' . $user->last_name  }}
                    </a>
                  </th>
                  <td>
                    {{ $user->phone_1 }}
                    @if($user->phone_2)
                    <hr>
                      {{ $user->phone_2 }}
                    @endif
                    @if($user->phone_3)
                    <hr>
                      {{ $user->phone_3 }}
                    @endif
                  </td>
                  <td>
                    {{ $user->email }}
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info" title="Update User Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @can('supervisor')
                      <button type="button" class="btn btn-sm btn-outline-primary" title="Recruit {{ $user->last_name }}">
                        <i class="fas fa-user-tie"></i>
                      </button>
                      @endcan

                      @can('supervisor')
                      <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove {{ $user->last_name }}">
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
                {{ $users->links() }}
              </tfoot>
            </table>
          </div>
        </div>
        @canany(['admin','ceo','head','supervisor'])
          <div class="col-3 bg-secondary">
           {{ count($users) }} Clients
          </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection