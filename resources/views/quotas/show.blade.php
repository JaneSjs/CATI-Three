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
                (#{{ $survey->id }}) {{ $survey->survey_name }} Quota Criteria
              </h3>
            </div>
            <div class="card-body">
              
              <ul class="list-group">
                <div class="marquee mb-3 bg-info p-3  text-center text-light rounded">
                    <h3 class="marquee-content">
                      {{ $interviewed_respondents }} Interviwed Respondents
                    </h3>
                </div>

                @foreach($quota as $criteria => $attribute)
                  <li class="list-group-item">
                    <h4>{{ $attribute->attribute }}</h4>
                    <hr>
                    Target Count {{ $attribute->value }}
                    <span class="badge badge-lg bg-primary rounded-pill">
                          {{ $attribute->target_count }}
                    </span>
                  </li>
                @endforeach
                </ul>
                  
              </div>
            </div>
          </div>
        </div>

        

    </div>
    <div class="card-footer">
      <form action="{{ route('remove_quota', $survey->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">
          Remove Quota
        </button>
      </form>
    </div>
  </div>
</div>

@endsection