<!-- Validation Errors -->
@if ($errors->any())
  <div class="alert alert-danger d-flex align-items-center" role="alert">
    <ul class="list-group">
      @foreach($errors->all() as $error)
        <li class="list-group-item">
          <i class="fas fa-circle-check fa-lg me-2"></i>
          {{ $error }}
        </li>
      @endforeach
    </ul>
  </div>
@endif

<!-- Import Failures -->
@if(session()->has('failures'))
<div class="table-responsive">
  <h4 class="text-danger">
    The Following Errors Have Been Encountered :
  </h4>
  <table class="table table-danger table-hover">
    <thead class="thead-light">
        <tr>
            <th>Row</th>
            <th>Attribute</th>
            <th>Errors</th>
            <th>Value</th>
        </tr>
    </thead>
    @foreach (session()->get('failures') as $failure)
    <tbody>
      <tr>
        <td>{{ $failure->row() }}</td>
        <td>{{ $failure->attribute() }}</td>
        <td>
          <ul>
            @foreach($failure->errors() as $failure_error)
              <li>{{ $failure_error }}</li>
            @endforeach
          </ul>
        </td>
        <td>
          {{ $failure->values()[$failure->attribute()] }}
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
@endif
<!-- End Import Failures -->