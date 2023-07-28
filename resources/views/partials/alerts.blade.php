@if (session('success'))
  <div class="alert alert-success d-flex align-items-center" role="alert">
    <i class="fas fa-circle-check fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('success') }}
    </div>
  </div>
@elseif (session('status'))
  <div class="alert alert-success d-flex align-items-center" role="alert">
    <i class="fas fa-circle-check fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('status') }}
    </div>
  </div>
@elseif (session('info'))
  <div class="alert alert-info d-flex align-items-center" role="alert">
    <i class="fas fa-exclamation fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('info') }}
    </div>
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif (session('warning'))
  <div class="alert alert-warning d-flex align-items-center" role="alert">
    <i class="fas fa-exclamation fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('warning') }}
    </div>
  </div>
@elseif (session('danger'))
  <div class="alert alert-danger d-flex align-items-center" role="alert">
    <i class="fas fa-circle-exclamation fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('danger') }}
    </div>
  </div>
@elseif (session('error'))
  <div class="alert alert-danger d-flex align-items-center" role="alert">
    <i class="fas fa-circle-exclamation fa-lg me-2" style="color: #074411;"></i>
    <div>
      {{ session('error') }}
    </div>
  </div>
@endif