@extends('/auth.master')

@section('content')
<body class="text-center">
    <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-11 bg-white py-2 align-middle border border-light" style="float: none; margin: auto; margin-top: 10%; max-width: 350px;">
            
            <form class="form-signin m-2" method="POST" action="{{ route('login') }}">
                @csrf
     
                <i class="fas fa-coffee -primary mb-2" style="width=172px; height=172px;"></i>
                
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mb-2" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
      
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Passwort">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            
                <button type="submit" class="btn btn-lg btn-primary py-0 mt-2">
                    <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                </button>

                <!-- only used for development and testing system -->
                <p class="mt-3 mb-3 text-muted">Strichliste</p><p class="mt-1 text-muted bg-warning text-danger" style="color: red !important; background-color: gold !important">ENTWICKLUNGSSYSTEM</p>
            </form>

        </div>
    </div>
</body>
@endsection
