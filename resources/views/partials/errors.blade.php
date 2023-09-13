<!-- Validation Errors -->
@if ($errors->any())
  <div class="alert alert-danger d-flex align-items-center" role="alert">
    <ul class="list-group">
      @foreach($errors->all() as $error)
        <li class="list-group-item">
          <i class="fas fa-circle-exclamation fa-lg me-2"></i>
          {{ $error }}
        </li>
      @endforeach
    </ul>
  </div>
@endif