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
        <input type="hidden" name="firstName" value="{{ $user->first_name }}">
        <input type="hidden" name="lastName" value="{{ $user->last_name }}">
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
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <form action="route('profiles.update', $user->id)" method="post">
              @csrf
              @method('PATCH')
              <input type="hidden" name="userId" value="{{ $user->id }}">
              <input type="hidden" name="firstName" value="{{ $user->first_name }}">
              <input type="hidden" name="lastName" value="{{ $user->last_name }}">
              <div class="mb-3">
                <label for="phone1" class="form-label">
                  Primary Phone No
                </label>
                <input type="text" class="form-control @error('phone1') is-invalid @enderror" id="phone1" aria-describedby="phone1Help" name="phone1" value="{{ $user->phone_1 ?? old('phone1') }}">
                @error('phone1')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @else
                <div id="phone1Help" class="form-text">
                  Primary Phone Number
                </div>
                @enderror
              </div>
              <button type="submit" class="btn btn-outline-primary">
                Update
              </button>
            </form>
          </div>
          <div class="col">
            <form action="route('profiles.update', $user->id)" method="post">
              @csrf
              @method('PATCH')
              <input type="hidden" name="userId" value="{{ $user->id }}">
              <input type="hidden" name="firstName" value="{{ $user->first_name }}">
              <input type="hidden" name="lastName" value="{{ $user->last_name }}">
              <div class="mb-3">
                <label for="phone2" class="form-label">
                  Secondary Phone No
                </label>
                <input type="text" class="form-control @error('phone2') is-invalid @enderror" id="phone2" aria-describedby="phone2Help" name="phone2" value="{{ $user->phone_2 ?? old('phone2') }}">
                @error('phone2')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @else
                <div id="phone2Help" class="form-text">
                  Primary Phone Number
                </div>
                @enderror
              </div>
              <button type="submit" class="btn btn-outline-info">
                Update 
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- Edit Phone No Modal -->