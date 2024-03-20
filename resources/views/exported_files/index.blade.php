@extends('layouts.main')
    
@section('content')

<?php
use Carbon\Carbon;

?>
<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h4 class="text-primary">
            {{ $survey->survey_name }} Exported Files
          </h4>
        </div>
        <div class="col">
          @error('name', 'description')
            <div class="alert alert-danger" exported_file="alert">
              <i class="bi flex-shrink-0 me-2 fas fa-triangle-exclamation"></i>
              {{ $message }}
            </div>
          @enderror

          @include('partials.alerts')
        </div>
        <div class="col text-end">
          
        </div>
      </div>
    </div>
    <div class="card-body">
          <div class="table-responsive">
            <table class="table caption-top">
              <caption>
               Latest Exported Files
              </caption>
              <thead class="table-success">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">File Name</th>
                  <th scope="col">Generated Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if(count($exported_files) > 0)
                  @foreach($exported_files as $exported_file)
                  <tr>
                    <td>
                      {{ $exported_file->id }}
                    </td>
                    <th scope="row">
                      {{ $exported_file->file_name  }}
                    </th>
                    <td>
                      {{ Carbon::parse($exported_file->created_at)->diffForHumans() }}
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('download_exported_files', $exported_file->file_name) }}" class="btn btn-sm btn-primary" title="Download">
                          <i class="fas fa-download"></i>
                          {{ $exported_file->project_id }}
                        </a>

                      </div>
                    </td>
                  </tr>
                  @endforeach
                @else
                <tr>
                  Could Not Generate The Spreadsheet. Use the Json Data Instead
                </tr>
                @endif
              </tbody>
              <tfoot>
                {{ $exported_files->links() }}
              </tfoot>
            </table>
          </div>
    </div>
  </div>
</div>


@endsection