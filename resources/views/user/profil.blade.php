@extends('user.master')

@section('content')

@if(session()->has('message'))
    <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }}">
        {{session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
        
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Deine E-Mail</div>
    
                       
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
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Dein Passwort</div>
    
                       
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
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Deine Cookie-PIN</div>
                       
                        @if($PinGenerated == false)
                        <div class="alert alert-secondary" role="alert">Du hast auf keinem Gerät eine Cookie-PIN hinterlegt</div>
                        @endif

                        @if($cookieStored == true)
                        <div class="alert alert-success" role="alert">
                            Auf diesem Gerät ist deine Cookie-PIN hinterlegt
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
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">FAQ Cookie-Pin</div>

                        
                       
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection
