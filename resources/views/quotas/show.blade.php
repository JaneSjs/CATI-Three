@extends('layouts.main')
    
@section('content')

<style type="text/css">
  .marquee {
    overflow: hidden;
  }

  .marquee-content {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 20s linear infinite;
  }

  @keyframes marquee {
    from {
      transform: translateX(100%);
    }
    to {
      transform: translateX(-100%);
    }
  }
</style>

<div class="body flex-grow-1 px-3">
  <div class="card">

    <div class="btn-group btn-sm" role="group" aria-label="Action Buttons">
      <button class="btn btn-outline-info">
        Edit Quota Attributes
      </button>
      <button class="btn btn-outline-danger">
        Remove This Quota From This Survey
      </button>
      <form action="{{ route('remove_quota', $survey->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">
          Remove This Quota
        </button>
      </form>
    </div>

    <div class="card-header">
      <div class="row">
        <div class="col">
          <h3>
            {{ $survey->name }}
          </h3>
        </div>
        <div class="col">
          @error('name', 'description')
            <div class="alert alert-danger" quota="alert">
              <i class="bi flex-shrink-0 me-2 fas fa-triangle-exclamation"></i>
              {{ $message }}
            </div>
          @enderror

          @include('partials.alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3>
                (#{{ $survey->id }}) {{ $survey->survey_name }} Operations Dashboard
              </h3>
            </div>
            <div class="card-body">
              <h5 class="text-primary text-center">
                <i class="fa-solid fa-users fa-xl" style="color: #0011ff;"></i>
                {{ $interviewed_respondents }} Interviewed Respondents
              </h5>

              <div class="table-responsive">
                <table class="table table-dark">
                  <thead>
                    <tr>
                      <td class="table-info">
                        <h5 class="text-info">
                          Total Interviews
                        </h5>
                        <i class="fa-solid fa-list-check fa-2xl" style="color: #62a0ea;">  {{ $total_interviews }}</i>
                      </td>
                      <td class="table-success">
                        <h5 class="text-success">
                          Approved Interviews
                        </h5>
                        <i class="fa-solid fa-thumbs-up fa-2xl" style="color: #2ff00c;">  {{ $approved_interviews }}</i>
                      </td>
                      <td class="table-danger">
                        <h5 class="text-danger">
                          Cancelled Interviews
                        </h5>
                        <i class="fa-solid fa-thumbs-down fa-2xl" style="color: #fc0000;">  {{ $cancelleded_interviews }}</i>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Religion
                          </th>
                          <th>
                             Targets
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            Catholic
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Mainstream Protestant (Anglican, Presbyterian, AIC, etc.)
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Muslim
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            SDA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Religion
                          </th>
                          <th>
                            Achieved
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_religion as $religion_data)
                          <tr>
                            <td>{{ $religion_data->religion }}</td>
                            <td>{{ $religion_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Gender
                          </th>
                          <th>
                            Targets
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            Female
                          </td>
                          <td>
                            {{ $quota['female_target'] ?? 'Not Set' }}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Male
                          </td>
                          <td>
                            {{ $quota['male_target'] ?? 'Not Set' }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Gender
                          </th>
                          <th>
                            Achieved
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_gender as $gender_data)
                          <tr>
                            <td>{{ $gender_data->gender }}</td>
                            <td>{{ $gender_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            County
                          </th>
                          <th>
                            Targets
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            EMBU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KILIFI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            NAIROBI CITY
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            NYAMIRA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            TURKANA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            EMBU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            EMBU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            EMBU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            EMBU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            County
                          </th>
                          <th>
                            Count
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_county as $county_data)
                          <tr>
                            <td>{{ $county_data->county }}</td>
                            <td>{{ $county_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Male Target
                          </th>
                          <th>
                            Female Target
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Sub County
                          </th>
                          <th>
                            Count
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_sub_county as $sub_county_data)
                          <tr>
                            <td>{{ $sub_county_data->sub_county }}</td>
                            <td>{{ $sub_county_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Male Target
                          </th>
                          <th>
                            Female Target
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Ward
                          </th>
                          <th>
                            Count
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_ward as $ward_data)
                          <tr>
                            <td>{{ $ward_data->ward }}</td>
                            <td>{{ $ward_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Setting
                          </th>
                          <th>
                            Targets
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            Rural
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Urban
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Setting
                          </th>
                          <th>
                            Achieved
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($interviewed_respondents_by_setting as $setting_data)
                          <tr>
                            <td>{{ $setting_data->setting }}</td>
                            <td>{{ $setting_data->count }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>

        

    </div>
    <div class="card-footer">
      
    </div>
  </div>
</div>

@endsection