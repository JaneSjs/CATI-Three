<div class="modal fade" id="results-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="resultsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultsLabel">
          Download {{ $survey->survey_name }}
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

                    <form action="{{ route('interviews_xlsx_export') }}" method="post">
                      @csrf
                      <input type="hidden" name="project_id" value="{{ $project->id }}">
                      <button class="btn btn-outline-dark btn-sm" title="Excel Format">
                        <i class="fa-solid fa-file-excel" style="color: #3d3846;"></i>
                        Project Interviews XLSX
                      </button>
                    </form>

                    <form action="{{ route('interviews_xlsx_export') }}" method="post">
                      @csrf
                      <input type="hidden" name="schema_id" value="{{ $survey->id }}">
                      <button class="btn btn-outline-dark btn-sm" title="Excel Format">
                        <i class="fa-solid fa-file-excel" style="color: #3d3846;"></i>
                        {{ $survey->survey_name }} Interviews XLSX
                      </button>
                    </form>

                    <a href="{{ route('json_export', $survey->id) }}" class="btn btn-outline-primary btn-sm" title="JSON Format">
                      <i class="fa-solid fa-file-export"></i>
                      Survey Results JSON
                    </a>
                    @canany(['admin'])
                    <a href="{{ route('json_export_all_data', $survey->id) }}" class="btn btn-outline-danger btn-sm" title="JSON Format">
                      <i class="fa-solid fa-download"></i>
                      All Survey Results JSON
                    </a>
                    @endcan
                    <a href="{{ route('xml_export', $survey->id) }}" class="btn btn-outline-info btn-sm" title="XML Format">
                      <i class="fa-solid fa-file-arrow-down"></i>
                      Survey Results XML
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <!--<a href="{{ route('exported_files', ['projectId' => $project->id, 'schemaId' => $survey->id]) }}">
                    Exported Files
                  </a>-->
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