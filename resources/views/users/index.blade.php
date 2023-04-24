@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Manage Users
        </div>
        <div class="col text-end">
          <a href="{{ route('users.create') }}" class="btn btn-outline-success">
            Register User
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-8">
          <div class="table-responsive">
            <table class="table caption-top">
              <caption>
               All System Users
              </caption>
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <th scope="row">
                    {{ $user->first_name . ' ' . $user->last_name  }}
                  </th>
                  <td>
                    {{ $user->email }}
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-secondary" title="View User Profile">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-primary" title="Recruit This User">
                        <i class="fas fa-user-tie"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-warning" title="Suspend">
                        <i class="fas fa-eraser"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                      </button>
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

        <div class="col-4 bg-warning">
          Total System Users = {{ count($users) }}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection