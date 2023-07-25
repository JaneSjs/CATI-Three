<div class="modal fade" id="assignMembers" data-coreui-backdrop="static" tabindex="-1" aria-labelledby="surveyLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form method="post" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PATCH')
        <div class="modal-header">
          <h5 class="modal-title" id="surveyLabel">
            Assign Member To {{ $project->name }}
          </h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          <div class="mb-3">
            <label for="name" class="form-label">
              Update Project Name
            </label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="nameDescription" value="{{  $project->name ?? old('name') }}">
            @error('name')
            <p class="text-danger">
              {{ $message }}
            </p>
            @else
            <div id="nameDescription" class="form-text">
              Name of the Project
            </div>
            @endif
          </div>
          <input type="hidden" name="project_id" value="{{ $project->id }}">

          <!-- Members Input -->
          <div class="col mt-3 mb-4">
            @foreach($users as $user)
              <div class="form-check form-check-inline">
                <input type="checkbox" name="users[]" class="form-check-input @error('users') is-invalid @enderror" id="{{ $user->first_name }}" value="{{ $user->id }}">
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
          <button type="submit" class="btn btn-primary">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>