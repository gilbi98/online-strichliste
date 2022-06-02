@extends('user.master')

@section('content')

@if(session()->has('message'))
    <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }}">
        {{session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
<!-- PIN !-->
<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
        
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Deine Cookie-PIN</div>
                       
                        @if($PinGenerated == false)
                        <div class="alert alert-secondary" role="alert">Du hast auf keinem Gerät eine Cookie-PIN hinterlegt. Wenn du gerade an deinem Smartphone bist, kannst du eine Cookie-PIN auf diesem Gerät hinterlegen. Dann kannst du eine Entnahme eintragen, ohne dich einzuloggen.</div>
                        @endif

                        @if($cookieStored == true)
                        <div class="alert alert-success" role="alert">
                            Auf diesem Gerät ist deine Cookie-PIN hinterlegt
                        </div>
                        @endif

                        @if($PinGenerated == true && $cookieStored == false)
                        <div class="alert alert-warning" role="alert">
                            Deine Cookie-PIN ist auf einem anderen Gerät hinterlegt. Um sie für dieses Gerät zu hinterlegen, klicke auf "Pin generieren". Beachte, dass die Cookie-PIN auf dem anderen Gerät dann nicht mehr gültig ist.
                        </div>
                        @endif

                        <form method="post" action="{{ route('generatePin') }}">
                            @csrf
                            <button class="btn btn-primary" type="submit">PIN generieren</button>
                        </form>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
        
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Deine E-Mail</div>
                    
                    <form action="{{ route('update-email') }}" method="POST">
                        @csrf
                            @if (session('email'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('email') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <input name="email" type="text" class="form-control @error('new_password') is-invalid @enderror" id="email" placeholder="{{$email}}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </input>
                            </div>

                            <button class="btn btn-primary ml-3">Speichern</button>
                    </form>                

                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
        
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Passwort ändern</div>

                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Altes Passwort">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="Neues Passwort">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Bestätige neues Passwort">
                            </div>

                        </div>

                        
                        <button class="btn btn-primary ml-3">Speichern</button>
                        

                    </form>
                       
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

@endsection
