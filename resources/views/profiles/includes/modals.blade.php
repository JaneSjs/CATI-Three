<!-- Edit Ext No Modal -->
<div class="modal fade" id="editExtNo" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="editExtNoLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm bg-info">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExtNoLabel">
          Edit Ext No
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="route('profiles.update', $user->id)" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="userId" value="{{ $user->id }}">
        <div class="modal-body">
            <div class="mb-3">
              <label for="extNo" class="form-label">
                Ext No
              </label>
              <input type="text" class="form-control" id="extNo" aria-describedby="extNoHelp" name="extNo" value="{{ $user->ext_no ?? old('extNo') }}">
              <div id="extNoHelp" class="form-text">
                Should align with the soft phone on this computer
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Ext No Modal -->

<!-- Edit Phone No Modal -->
<div class="modal fade" id="editPhoneNumber" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="editExtNoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExtNoLabel">
          Edit Phone No
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="route('profiles.update', $user->id)" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="userId" value="{{ $user->id }}">
        <div class="modal-body">
            <div class="mb-3">
              <label for="phone1" class="form-label">
                Primary Phone No
              </label>
              <input type="text" class="form-control" id="phone1" aria-describedby="phone1Help" name="phone_1" value="{{ $user->phone_1 ?? old('phone_1') }}">
              <div id="phone1Help" class="form-text">
                Secondary Phone Number
              </div>
            </div>
            <div class="mb-3">
              <label for="phone2" class="form-label">
                Secondary Phone No
              </label>
              <input type="text" class="form-control" id="phone2" aria-describedby="phone1Help" name="phone_2" value="{{ $user->phone_2 ?? old('phone_2') }}">
              <div id="phone1Help" class="form-text">
                Alternative Phone Number
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Phone No Modal -->