<div class="modal fade" id="editProfile-{{ $user->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="profileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileLabel">
          Edit {{ $user->first_name }} Details
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
          @csrf
          @method('PATCH')
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>