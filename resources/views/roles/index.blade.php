@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Manage Roles
        </div>
        <div class="col">
          @error('name', 'description')
            <div class="alert alert-danger" role="alert">
              <i class="bi flex-shrink-0 me-2 fas fa-triangle-exclamation"></i>
              {{ $message }}
            </div>
          @enderror

          @include('partials.alerts')
        </div>
        <div class="col text-end">
          <!-- Trigger Create New Role Modal -->
          <button type="button" class="btn btn-outline-success" data-coreui-toggle="modal" data-coreui-target="#createRole">
            Create New Role
          </button>
        </div>
      </div>
    </div>
    <div class="card-body">
          <div class="table-responsive">
            <table class="table caption-top">
              <caption>
               All System Roles
              </caption>
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <th scope="row">
                    {{ $role->name  }}
                  </th>
                  <td>
                    {{ $role->description }}
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-secondary" title="View Role">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-warning" title="Update Role">
                        <i class="fas fa-pen"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-danger" title="Delete Role" data-coreui-toggle="modal" data-coreui-target="#deleteRole">
                        <i class="fas fa-trash"></i>
                      </button>
                      
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $roles->links() }}
              </tfoot>
            </table>
          </div>
    </div>
  </div>
</div>

<!-- Create Role Modal -->
<div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="title" aria-hidden="true" data-coreui-backdrop="static">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">
          Create New Role
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('roles.store') }}">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">
              Role Name
            </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="nameDescription">
            @error('name')
            <p class="text-danger">
              {{ $message }}
            </p>
            @else
            <div id="nameDescription" class="form-text">
              Name of the role e.g scripter, agent e.t.c
            </div>
            @endif
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">
              Role Description
            </label>
            <input type="text" class="form-control" name="description" id="description" aria-describedby="roleDescription">
            @error('description')
            <p class="text-danger">
              {{ $message }}
            </p>
            @else
            <div id="roleDescription" class="form-text">
              Desctiption of the role i.e what tasks the user assigned with that role is intended to do in the system.
            </div>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">
            Create
          </button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- End Create Role Modal -->

<!-- Delete Role Modal -->
<div class="modal fade" id="deleteRole" tabindex="-1" aria-labelledby="title" aria-hidden="true" data-coreui-backdrop="static">
  <div class="modal-dialog modal-sm modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">
          Are you sure You want to delete this role
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('roles.destroy', $role->id) }}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-sm btn-danger" title="Delete Role">
              Delete {{ $role->name }}
            </button>
          </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- End Delete Role Modal -->

@endsection