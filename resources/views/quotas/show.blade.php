@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h3>
            Quota Criteria for Survey Name
          </h3>
        </div>
        <div class="col">
          @error('name', 'description')
            <div class="alert alert-danger" quota="alert">
              <i class="bi flex-shrink-0 me-2 fas fa-triangle-exclamation"></i>
              {{ $message }}
            </div>
          @enderror

          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      
      <div class="row">
        
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gender</h5>
              <div class="table-responsive">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      @foreach($quotas as $criteria => $attribute)
                        <th>
                          {{ $attribute->attribute }}
                        </th>
                        <th>
                          Target Count {{ $attribute->value }}
                        </th>
                        <th>
                          {{ $attribute->target_count }}
                        </th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        Total Count {{ $interviewed_respondents }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Age Group</h5>
              <div class="table-responsive">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th>Gender</th>
                      <th>Target</th>
                      <th>Achieved</th>
                      <th>Difference</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Male</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Female</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Total Count</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col">
          <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">County</h5>
              <div class="table-responsive">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th>Gender</th>
                      <th>Target</th>
                      <th>Achieved</th>
                      <th>Difference</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Male</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Female</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Total Count</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection