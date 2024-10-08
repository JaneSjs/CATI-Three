@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h5>
            All System Users
          </h5>
        </div>
        <div class="col">
          @include('partials/alerts')
        </div>
        <div class="col text-end">
          <a href="{{ route('users.create') }}" class="btn btn-outline-success">
            Register User
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <form action="{{ url('search_users') }}" method="GET">
            <div class="input-group">
              <input type="search" name="query" class="form-control" placeholder="Search" aria-label="Search for system users..." aria-describedby="search_users" value="{{ request()->get('query') }}">
              <button type="submit" class="btn btn-outline-info" id="search_users">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="col">
          
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-9">
          <div class="table-responsive">
            <table class="table caption-top">
              @canany(['admin','ceo','dpo'])
              <caption>
               All System Users
              </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  @canany(['admin','dpo'])
                    <th scope="col">Role(s)</th>
                  @endcan
                  @canany(['admin','dpo','supervisor'])
                    <th scope="col">Ext No</th>
                  @endcan
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
                  @canany(['admin','dpo'])
                    <td class="bg-warning">
                      @foreach($user->roles as $role)
                          <span class="badge bg-secondary text-dark">
                            {{ $role->name }}
                          </span>
                      @endforeach
                    </td>
                  @endcan
                  @canany(['admin','dpo','supervisor'])
                    <td class="">
                      {{ $user->ext_no }}
                    </td>
                  @endcan
                  <td>
                    <div class="btn-group">
                      @canany(['admin','dpo'])
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info" title="Update User Details">
                        <i class="fas fa-pen"></i>
                      </a>
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
        @canany(['admin','ceo','dpo'])
        <div class="col-3 bg-secondary">
          Total System Users = {{ $allUsers }}
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>


@endsection