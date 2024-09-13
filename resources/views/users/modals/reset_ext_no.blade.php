<!-- Reset Ext No Modal -->
<div class="modal fade" id="resetExtNo-{{ $interviewer->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="resetExtNoLabel" aria-hidden="true">
  <div class="modal-dialog bg-info">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetExtNoLabel">
          Reset
          <span class="text-primary">
            {{ $interviewer->first_name . ' ' . $interviewer->last_name }}
          </span>
          Ext No
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('reset_ext_no') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="user_id" value="{{ $interviewer->id }}">
        
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block">
            Reset
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Reset Ext No Modal -->