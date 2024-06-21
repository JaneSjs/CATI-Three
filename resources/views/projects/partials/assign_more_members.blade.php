<div class="modal fade" id="assignMoreMembers" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="assignUsers" aria-hidden="true">
  <div class="modal-dialog modal-xl bg-success">
    <div class="modal-content">
      <form method="post" action="{{ route('projects.assign_more_users', $project->id) }}">
        @csrf
        @method('PATCH')
        <div class="modal-header">
          <h5 class="modal-title" id="assignUsers">
            Assign More Members(s) To {{ $project->name }}
          </h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="project_id" value="{{ $project->id }}">

          <!-- Members Input -->
          <div class="col mt-3 mb-4">
            @foreach($users as $user)
              <div class="form-check form-check-inline">
                <input type="checkbox" name="users[]" class="form-check-input @error('users') is-invalid @enderror" id="{{ $user->first_name }}" value="{{ $user->id }}" @if($members->contains('id', $user->id)) checked @endif>
                <label class="form-check-label" for="{{ $user->first_name }}">
                  {{ $user->first_name . ' ' . $user->last_name }}
                </label>

                @error('users')
                  <div class="invalid-feedback bg-light rounded text-center" role="alert">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            @endforeach
          </div>
          <!-- End Members Input -->  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            Assign More Members
          </button>
        </div>
      </form>
    </div>
  </div>
</div>