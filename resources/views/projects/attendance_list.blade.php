@extends('layouts.main')
    
@section('content')

<style type="text/css">
  @media print {
  body {
    font-size: 12px;
  }
  
  .card {
    border: none;
  }
  
  .card-header, .card-footer {
    text-align: center;
    border: none;
  }
  
  .card-header img {
    display: block;
    margin: 0 auto;
    max-width: 100px;
  }
  
  .card-body .table-responsive {
    overflow: visible;
  }
  
  .table {
    width: 100%;
    margin: 0 auto;
  }
  
  .table th, .table td {
    padding: 8px;
  }
  
  .print-btn {
    display: none;
  }
  
  .list-unstyled {
    text-align: center;
  }
  
  .list-unstyled li {
    display: inline;
    margin: 0 10px;
  }

  .no-print {
    display: none;
  }
}

</style>

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h6>
            {{ $project->name }} Attendance List
          </h6>
        </div>
        <div class="col">
          <button type="button" class="btn btn-outline-primary btn-sm float-end print-btn" onclick="window.print()">
            Print Attendance List
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="float-start">
            <img src="{{ url('assets/images/company-logo.png') }}" class="img-thumbnail h-50" alt="Logo" style="max-width: 100px;">
          </div>
        </div>
        <div class="col">
          <div class="d-flex justify-content-between mt-3">
            <ul class="list-unstyled">
              <li><strong>Supervisors:</strong></li>
              <li>Name 1</li>
              <li>Name 2</li>
            </ul>
            <ul class="list-unstyled">
              <li><strong>Coordinators:</strong></li>
              <li>Name 1</li>
              <li>Name 2</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="table-primary">
            <caption>
              Project Managers, Coordinators and Supervisors
            </caption>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Phone No</th>
              <th scope="col">Role</th>
              <th scope="col">LT</th>
              <th scope="col">Signature</th>
            </tr>
          </thead>
          <tbody>
            @foreach($senior_members as $member)
            <tr>
              <td>
                <a href="{{ route('profiles.show', $member->id) }}">
                  {{ $member->first_name . ' ' . $member->last_name  }}
                </a>
              </td>
              <td>{{ $member->phone_1 }}</td>
              <td>
                @if($member->roles->isNotEmpty())
                  {{ $member->roles->pluck('name')->join(', ') }}
                @endif
              </td>
              <td></td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <hr>

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <caption>
            QC's
          </caption>
          <thead class="table-success">
            <tr>
              <th scope="col">QC Name</th>
              <th scope="col">National ID</th>
              <th scope="col">Phone No</th>
              <th scope="col">Role</th>
              <th scope="col">Today's QC'd Interviews</th>
              <th scope="col">LT</th>
              <th scope="col">Signature</th>
            </tr>
          </thead>
          <tbody>
            @foreach($qcs as $qc)
            <tr>
              <td>
                <a href="{{ route('profiles.show', $qc->id) }}">
                  {{ $qc->first_name . ' ' . $qc->last_name  }}
                </a>
              </td>
              <td>{{ $qc->national_id }}</td>
              <td>{{ $qc->phone_1 }}</td>
              <td>
                @if($qc->roles->isNotEmpty())
                  {{ $qc->roles->pluck('name')->join(', ') }}
                @endif
              </td>
              <td>{{ $qc->todays_qcd_interviews ?? 0 }}</td>
              <td></td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <hr>

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <caption>
            Interviewers
          </caption>
          <thead class="table-success">
            <tr>
              <th scope="col">Interviewer's Name</th>
              <th scope="col">National ID</th>
              <th scope="col">Phone No</th>
              <th scope="col">Ext No</th>
              <th scope="col">Role</th>
              <th scope="col">Today's Interviews</th>
              <th scope="col">LT</th>
              <th scope="col">Signature</th>
            </tr>
          </thead>
          <tbody>
            @foreach($interviewers as $interviewer)
            <tr>
              <td>
                <a href="{{ route('profiles.show', $interviewer->id) }}">
                  {{ $interviewer->first_name . ' ' . $interviewer->last_name  }}
                </a>
              </td>
              <td>{{ $interviewer->national_id }}</td>
              <td>{{ $interviewer->phone_1 }}</td>
              <td>{{ $interviewer->ext_no }}</td>
              <td>
                @if($interviewer->roles->isNotEmpty())
                  {{ $interviewer->roles->pluck('name')->join(', ') }}
                @endif
              </td>
              <td>{{ $interviewer->todays_completed_interviews ?? 0 }}</td>
              <td></td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-center">
      <h6>
        {{ $project->name }} Attendance List
      </h6>
      <h6>
        Date: <span>{{ date('d-m-y H:i') . 'Hrs' }}</span>
      </h6>
    </div>
  </div>
</div>

@endsection
