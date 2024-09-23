@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col col-3">
          Bulk Import Respondents
        </div>
        <div class="col col-3">
          <a href="{{ asset('Templates/Respondents-Import-Template.xlsx') }}" class="btn btn-warning" title="Click To Download Template" download>
            Use This Template
            <i class="fas fa-download"></i>
          </a>
        </div>
        <div class="col text-end">
          @include('partials/alerts')
          
        </div>
      </div>
      @include('partials/errors')
    </div>
    <div class="card-body">

      <form method="post" action="{{ url('respondents/xlsx_import') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="formFile" class="form-label">
            Select Excel File With Bulk Respondents
          </label>
          <input class="form-control" type="file" id="formFile" name="bulk_respondents">
        </div>

        <button type="submit" class="btn btn-outline-primary float-end">
          <i class="fas fa-cloud-upload"></i>
          Begin Import
        </button>
      </form>

    </div>
  </div>
</div>


@endsection