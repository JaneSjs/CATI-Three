@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">

    <div class="btn-group btn-sm" role="group" aria-label="Action Buttons">
      
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
        <div>
          <a href="{{ route('reports.index') }}" class="btn btn-sm btn-info">
            Kool Reports
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3>
                (#{{ $survey->id }}) <span class="text-info" style="text-decoration: underline;">
                  {{ $survey->survey_name }}
                </span> Operations Dashboard
              </h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-dark table-bordered border-light table-sm">
                  <caption>
                    Interviews Status
                  </caption>
                  <thead>
                    <tr>
                      <th>
                        Sample Size
                      </th>
                      <th>
                        {{ $quota['sample_size'] ?? 'Not Set' }}
                      </th>
                    </tr>
                    <tr>
                      <th>
                        Interviewed <span class="text-success">(Active)</span> Respondents
                      </th>
                      <th>
                        {{ $interviewed_respondents }}
                      </th>
                    </tr>
                    <tr>
                      <th>
                        <span class="text-success">(Active)</span> Respondents With Complete Interviews
                      </th>
                      <th>
                        {{ $respondents_with_complete_interviews }}
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>

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
                            Settings
                          </th>
                          <th>
                            Targets
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            Others
                          </td>
                          <td>
                            
                          </td>
                        </tr>
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
                            Settings
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

              <hr>

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
                            Others
                          </td>
                          <td>
                            
                          </td>
                        </tr>
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

              <hr>

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
                            Others
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Atheist
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Catholic
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Evangelical
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Hindu
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
                            None
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Other Christian
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
                        <tr>
                          <td>
                            Traditional Religious Beliefs
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
              
              <hr>

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
                            Others
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            BARINGO
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            BOMET
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            BUNGOMA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            BUSIA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            ELGEIYO MARAKWET
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
                            GARISSA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            HOMA BAY
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            ISIOLO
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KAJIADO
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KAKAMEGA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KERICHO
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KIAMBU
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
                            KIRINYAGA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KISII
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KISUMU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KITUI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            KWALE
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            LAIKIPIA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            LAMU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MACHAKOS
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MAKUENI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MANDERA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MARSABIT
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MERU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MIGORI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MOMBASA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            MURANG'A
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
                            NAKURU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            NANDI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            NAROK
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
                            NYANDARUA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            NYERI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            SAMBURU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            SIAYA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            TAITA TAVETA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            TANA RIVER
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            THARAKA NITHI
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            TRANS NZOIA
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
                            UASINGISHU
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            VIHIGA
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            WAJIR
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <tr>
                          <td>
                            WEST POKOT
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
                            Counties
                          </th>
                          <th>
                            Achieved
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

              <hr>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Sub Counties
                          </th>
                          <th>
                            Targets
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
                            Achieved
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

              <hr>

              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">

                      <thead>
                        <tr>
                          <th>
                            Wards
                          </th>
                          <th>
                            Targets
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
                            Wards
                          </th>
                          <th>
                            Achieved
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