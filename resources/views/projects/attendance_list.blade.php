@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h6>
            {{ $project->name }} Attendance List
          </h6>
        </div>
        <div class="col">
            <h6>
              Date: <span>{{ date('d-m-y') }}</span>
            </h6>
        </div>
        <div class="col text-end">
          <div class="btn-group btn-group-sm" role="group" aria-label="Supervisor Actions">
            <a href="{{ route('users.create') }}" class="btn btn-outline-success">
              Add Interviewer
            </a>
            <button type="button" class="btn btn-outline-primary">
              Print Attendance List
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <img src="{{ url('assets/images/company-logo.png') }}" class="img-thumbnail h-50" alt="Logo">
        </div>
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item active">
              <strong>Supervisors:</strong>
              <ul>
                <li class="list-group-item text-dark">Name 1</li>
                <li class="list-group-item text-dark">Name 2</li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col">
          <ul class="list-group">
            <li class="list-group-item active">
              <strong>Coordinators:</strong>
              <ul>
                <li class="list-group-item text-dark">Name 1</li>
                <li class="list-group-item text-dark">Name 2</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
            <table class="table caption-top table-striped table-bordered">
              <caption>
               
              </caption>
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">National ID</th>
                  <th scope="col">Phone No</th>
                  <th scope="col">Ext No</th>
                  <th scope="col">LT</th>
                  <th scope="col">Signature</th>
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
                    
                  </td>
                  <td>
                    {{ $user->ext_no }}
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info" title="Update User Details">
                        <i class="fas fa-pen"></i>
                      </a>
                      @canany(['coordinator','supervisor'])
                      <button type="button" class="btn btn-sm btn-outline-primary" title="Recruit {{ $user->last_name }}">
                        <i class="fas fa-user-tie"></i>
                      </button>
                      @endcan

                      @canany(['admin'])
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
                <div class="row">
                  <div class="col">
                    <h6>
                      {{ $project->name }} Attendance List
                    </h6>
                  </div>
                  <div class="col">
                      <h6>
                        Date: <span>{{ date('d-m-y') }}</span>
                      </h6>
                  </div>
                </div>
              </tfoot>
            </table>
          </div>
    </div>
  </div>
</div>


@endsection