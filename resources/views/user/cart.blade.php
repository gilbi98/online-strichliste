@extends('user.master')

@section('content')

@section('head')
     
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
                                        <!-- check if categories exist for showing categories or not -->
                                        @if($categories->count() > 0)
                                            
                                        <form method="post" action="{{route('createPurchaseWithCategory')}}">
                                                @csrf
                                                <!-- if no categories exist only one dropdown is necessary -->
                                                <div class="form-group">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahme eintragen</div>
                                                    
                                                    <select class="form-control" id="category" name="category">
                                                        <option value="null">Kategorie wählen</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                
                                                    <select class="form-control mt-2" id="article" name="article">
                                                        <option value="null">Artikel wählen</option>
                                                        @foreach($articles as $article)
                                                            <option value="{{$article->id}}">{{$article->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Speichern</button>
                                            </form>

                                        @else

                                            <form method="post" action="{{route('createPurchaseWithoutCategory')}}">
                                                @csrf
                                                <!-- if no categories exist only one dropdown is necessary -->
                                                <div class="form-group">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahme eintragen</div>
                                                    <select class="form-control" id="article" name="article">
                                                        <option value="null">Artikel wählen</option>
                                                        @foreach($articles as $article)
                                                            <option value="{{$article->id}}">{{$article->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Speichern</button>
                                            </form>

                                        @endif
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

@endsection
