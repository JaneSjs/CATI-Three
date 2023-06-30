@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  @foreach($surveys as $survey)
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>Pick A Survey To Proceed</h2>
        </div>
        <div class="col text-end">
          @include('partials.alerts')
        </div>
    </div>
          
    </div>
    <div class="card-body">
      
      <div class="row mb-3">
        <div class="col">
          <button class="btn btn-outline-primary">
            Get New Respondent
          </button>
        </div>
        <div class="col">
          <button class="btn btn-outline-primary">
            Search For A Respondent
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col"></th>
                </tr>
                <tr>
                  <th scope="col">County</th>
                  <th scope="col"></th>
                </tr>
                <tr>
                  <th scope="col">Age</th>
                  <th scope="col"></th>
                </tr>
                <tr>
                  <th scope="col">Gender</th>
                  <th scope="col"></th>
                </tr>
                <tr>
                  <th scope="col">Setting</th>
                  <th scope="col"></th>
                </tr>
                
              </thead>
              
            </table>
          </div>

        </div>
        <div class="col">
          
        </div>
      </div>

    </div>
  </div>
  @endforeach
</div>


@endsection