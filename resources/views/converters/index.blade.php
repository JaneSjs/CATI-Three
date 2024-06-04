@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">
            Data Conversion (JSON to CSV)
          </h3>
        </div>
        <div class="col-auto">
          @error('name', 'description')
            <div class="alert alert-danger" role="alert">
              <i class="bi flex-shrink-0 me-2 fa-solid fa-triangle-exclamation"></i>
              {{ $message }}
            </div>
          @enderror

          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ url('jsonToCsv') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="file" class="form-label">
            Select The JSON File
          </label>
          <div class="input-group">
            <input type="file" name="jsonFile" id="file" class="form-control">
            <button class="btn btn-outline-primary" type="submit">
              Convert
              <i class="fa-solid fa-file-csv fa-beat ms-2"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection