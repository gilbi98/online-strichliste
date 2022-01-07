@extends('/auth.master')

@section('content')
<div class="container">
    <body class="text-center">
        <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-11 bg-white py-2 align-middle border border-light" style="float: none; margin: auto; margin-top: 10%; max-width: 350px;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
     
                    <i class="fas fa-coffee -primary mb-2" style="width=172px; height=172px;"></i>
      
                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror mb-2" name="firstname" required autocomplete="firstname" autofocus placeholder="Vorname">
                    @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror mb-2" name="lastname" required autocomplete="lastname" autofocus placeholder="Nachname">
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mb-2" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mb-2" name="password" required autocomplete="new-password" placeholder="Passwort">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password-confirm" type="password" class="form-control mb-3" name="password_confirmation" required autocomplete="new-password" placeholder="Passwort wiederholen">
      
                    <button type="submit" class="btn btn-lg btn-primary py-0">
                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Registrieren') }}
                    </button>

                    <p class="mt-3 mb-3 text-muted">v1.0.0</p><p class="mt-1 text-muted bg-warning text-danger">ENTWICKLUNGSSYSTEM</p>
                </form>
            </div>
        </div>
    </body>   
</div>
@endsection
