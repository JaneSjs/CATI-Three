<div class="modal fade" id="results-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          {{ $survey->survey_name }} Results
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr>
                <th scope="col">
                   
                </th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Scripter Actions">
                    <a href="{{ url('csv_export', $survey->id) }}" class="btn btn-outline-warning" title="CSV Format">
                      <i class="fas fa-file-csv"></i>
                      CSV
                    </a>
                    <a href="{{ url('xlsx_export', $survey->id) }}" class="btn btn-outline-dark" title="Excel Format">
                      <i class="far fa-file-spreadsheet" style="color: #3d3846;"></i>
                      Survey Results XLSX
                    </a>
                    <a href="{{ url('interviews_xlsx_export', $survey->id) }}" class="btn btn-outline-dark" title="Excel Format">
                      <i class="far fa-file-spreadsheet" style="color: #3d3846;"></i>
                      Interviews XLSX
                    </a>
                    <a href="{{ url('pdf_export', $survey->id) }}" class="btn btn-outline-dark" title="Portable Document Format">
                      <i class="fas fa-file-pdf" style="color: #ef2929;"></i>
                      PDF
                    </a>
                    <a href="!#" class="btn btn-outline-primary" title="JSON Format" title="Curre">
                      <i class="fas fa-brackets-curly"></i>
                      JSON
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{{ route('exported_files', ['projectId' => $project->id, 'schemaId' => $survey->id]) }}">
                    Exported Files
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>