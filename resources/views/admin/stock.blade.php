@extends('admin.master')

@section('currentSide')
    Bestände korrigieren
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            {{session()->get('message') }}
            <button class="btn-close" type="button" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert mt-2 {{ Session::get('alert-class', 'alert-danger') }}">
                {{$error}}
            </div>
        @endforeach
    @endif

        @if($articles->count() == 0)
            Keine Artikel mit Bestandstracking im System vorhanden
        @endif
    
            <!-- Wenn Kategorien existieren, Akkordion. Wenn keine Kategorien, kein Akkordion, nur Tabelle -->
            @if($categories->count() > 0)

            <div class="accordion m-2" id="accordionExample">
                <form method="post" action="{{ route('changeArticlesStock') }}">
                    @csrf

                    @foreach($categories as $category)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$category->id}}">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapse{{$category->id}}" aria-expanded="false" aria-controls="collapse{{$category->id}}">{{$category->name}}</button>
                            </h2>

                            <div class="accordion-collapse collapse" id="collapse{{$category->id}}" aria-labelledby="heading{{$category->id}}" data-coreui-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-bordered">
                                    @foreach($articles as $article)
                                    
                                        @if($category->id == $article->category)
                                            <tr>
                                                <td>{{$article->name}}</td>  
                                                <td>
                                                <div class="col-3">
                                                    <input class="form-control form-control-sm" type="text" placeholder="Aktueller Bestand" aria-label="min" name="{{$article->id}}" id="{{$article->id}}[]" value="{{$article->in_stock}}">
                                                </div>
                                                </td>
                                            </tr>
                                        @endif
        
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
           
            <button class="btn btn-primary m-2 py-0" type="submit" data-coreui-toggle="modal" data-coreui-target="#changeArticleData">
                <svg class="icon me-2">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
                </svg>Änderungen speichern
            </button>
            </form>          

            @else

            <form method="post" action="{{ route('changeArticlesStock') }}">
                @csrf

                <div class="accordion-item">
                    
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                @foreach($articles as $article)
                    
                                    <tr>
                                        <td>{{$article->name}}</td>  
                                        <td>
                                            <div class="col-3">
                                                <input class="form-control form-control-sm" type="text" placeholder="Aktueller Bestand" aria-label="min" name="{{$article->id}}" id="{{$article->id}}[]" value="{{$article->in_stock}}">
                                            </div>
                                        </td>
                                    </tr>
        
                                @endforeach
                            </table>
                        </div>
                    </div>
                

                    <button class="btn btn-primary m-2 py-0" type="submit" data-coreui-toggle="modal" data-coreui-target="#changeArticleData">
                        <svg class="icon me-2">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
                        </svg>Änderungen speichern
                    </button>

                </div>

            </form>

            @endif
            
@endsection