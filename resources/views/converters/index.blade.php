@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          Data Conversion
        </div>
        <div class="col">
          @error('name', 'description')
            <div class="alert alert-danger" role="alert">
              <i class="bi flex-shrink-0 me-2 fas fa-triangle-exclamation"></i>
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
        <div class="mb-3 mt-3 input-group">
          <label for="file" class="form-label">
            Convert JSON File To CSV File
          </label>
          <input type="file" name="jsonFile" id="file" class="form-control">
          <button class="btn btn-primary" type="submit">
            Upload
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection