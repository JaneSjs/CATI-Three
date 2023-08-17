@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="card">
      @if(session('status'))
        @include('partials.alerts')
      @else
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">
            Verify Your Email Address
          </h4>
          <p>
            Upon your account creation, we sent you an <strong>email verification link</strong>. Click on that link to activate your account. If you, however, did not receive that email, you can resend it yourself by clicking the button below. Remember though, to also check your <strong>spam folder</strong> and mark us as not spam so as not to miss future important emails from us.
          </p>
          <hr>
          <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">
              Resend Account Activation Link
            </button>
          </form>
        </div>
      @endif
    </div>
  </div>
</div>


@endsection