@extends('user.master')

@section('content')

@section('head')
     @livewireStyles
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12">
                             <!-- check if tallysheet has articles -->
                            @if($articles->count() > 0)
                                        
                                @livewire('category-article')

                            @else
                                Keine Artikel hinterlegt. Wenden Sie sich bitte an Ihren Administrator.
                            @endif
                                
                            @if(session()->has('message'))
                                <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }}">
                                    {{session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert mt-2 {{ Session::get('alert-class', 'alert-danger') }}">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                                                                                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@livewireScripts

@endsection
