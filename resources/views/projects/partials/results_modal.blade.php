<div class="modal fade" id="results-{{ $survey->id }}" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="#resultsLabel" aria-hidden="true">
  <div class="modal-dialog bg-primary">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="resultsLabel">
          Download Survey Results
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">
                   
                </th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <td>
                  <div class="btn-group" role="group" aria-label="XLSX Formats">
                    <form action="{{ route('interviews_xlsx_export') }}" method="post">
                      @csrf
                      <input type="hidden" name="project_id" value="{{ $project->id }}">
                      <button class="btn btn-outline-dark btn-sm" title="Excel Format">
                        <i class="fa-solid fa-file-excel" style="color: #3d3846;"></i>
                        {{ $project->name }} Interviews XLSX
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
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="btn-group" role="group" aria-label="JSON Formats">
                    <!--<form action="{{ route('json_export') }}" method="post">
                      @csrf
                      <input type="hidden" name="project_id" value="{{ $project->id }}">
                      <button class="btn btn-outline-primary btn-sm" title="JSON Format">
                        <i class="fa-solid fa-file-export"></i>
                        {{ $project->name }} Results JSON
                      </button>
                    </form>-->

                    <form action="{{ route('json_export') }}" method="post">
                      @csrf
                      <input type="hidden" name="schema_id" value="{{ $survey->id }}">
                      <button class="btn btn-outline-primary btn-sm" title="JSON Format">
                        <i class="fa-solid fa-file-export"></i>
                        {{ $survey->survey_name }} Results JSON
                      </button>
                    </form>

                    @canany(['admin'])
                    <a href="{{ route('json_export_all_data', $survey->id) }}" class="btn btn-outline-danger btn-sm" title="JSON Format">
                      <i class="fa-solid fa-download"></i>
                      All {{ $survey->survey_name }} Results JSON
                    </a>
                    @endcan
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="btn-group" role="group" aria-label="XML Formats">
                    <a href="{{ route('xml_export', $survey->id) }}" class="btn btn-outline-info btn-sm" title="XML Format">
                      <i class="fa-solid fa-file-arrow-down"></i>
                      Survey Results XML
                    </a>
                  </div>
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