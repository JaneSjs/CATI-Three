@extends('layouts.main')
    
@section('content')

<div class="row m-2">
  <div>
    
  </div>
  @foreach($applicants as $applicant)
    <div class="col">
      <div class="card">
        <img src="{{ $applicant->gender === 'Male' ? asset('assets/images/male-avatar.png') : asset('assets/images/female-avatar.png') }}" alt="{{ $applicant->first_name . ' ' . $applicant->last_name }} Profile Image"
              class="rounded-circle img-fluid" style="width: 100%;" title="{{ $applicant->gender }}">
        <div class="card-body">
          <h4 class="card-title">
            {{ $applicant->first_name . ' ' . $applicant->last_name }}
          </h4>
          <div class="row">
            <div class="col">
              <ul class="list-group">
                <li class="list-group-item active">
                  @foreach($applicant->roles as $role)
                      {{ $role->name }}
                  @endforeach
                </li>
                <li class="list-group-item">
                  <table>
                    <thead>
                      <tr>
                        <th>Experience:</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          {{ count($applicant->projects) }} Projects
                        </td>
                      </tr>
                      <tr>
                        <td>
                          {{ count($applicant->interviews) }} Interviews
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Rating: 
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="btn-group">
            <a href="{{ route('profiles.show', $applicant->id) }}" class="btn btn-outline-primary">
              See Profile
            </a>
            <button class="btn btn-outline-info">
              Recruit
            </button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

</div>

@endsection