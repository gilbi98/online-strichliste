@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <span>Artikel</span>
        </li>
        <li class="breadcrumb-item active"><span>{{$article->name}}</span></li>
    </ol>
</nav>
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
    <!-- Modal change Article Data -->
    <div class="modal fade" id="changeArticleData" tabindex="-1" aria-labelledby="newArticle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Stammdaten ändern</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('changeArticleData', $article->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name:</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name', $article->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Preis:</label>
                    <input class="form-control" id="price" name="price" type="text" value="{{ old('price', $article->price) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Kategorie:</label>
                    <select class="form-select" aria-label="Default select example" name="category" id="category">
                        @foreach($categories as $category)
                            @if($article->category == $category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                        <option value="null">Keine Kategorie</option>
                    </select>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" id="status" name="status" type="checkbox" value="1" @if($article->status == 1) checked @endif>
                    <label class="form-check-label" for="flexCheckChecked">Für Nutzer sichtbar</label>
                </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Abbrechen</button>
                    <button class="btn btn-primary" type="submit">Speichern</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- Modal change Artricle Stock Data, button is in area down below-->
    <div class="modal fade" id="changeStockData" tabindex="-1" aria-labelledby="newArticle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Bestandsdaten ändern</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('changeArticleStockData', $article->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Aktueller Bestand:</label>
                    <input class="form-control" id="in_stock" name="in_stock" type="text" value="{{ old('name', $article->in_stock) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Mindestbestand:</label>
                    <input class="form-control" id="min_stock" name="min_stock" type="text" value="{{ old('name', $article->min_stock) }}">
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" id="stockTracking" name="stockTracking" type="checkbox" value="1" @if($article->stock_tracking == 1) checked @endif>
                    <label class="form-check-label" for="flexCheckChecked">Bestand tracken</label>
                </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Abbrechen</button>
                    <button class="btn btn-primary" type="submit">Speichern</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- show Article Data, button is in area down below -->
    <div class="row">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Stammdaten</div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table border mb-0">
                                <tr class="align-middle">
                                    <th>Preis:</th>
                                    <td>{{number_format($article->price,2)}}&#8364;</td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Kategorie:</th>
                                    <td>
                                        @if($article->category != null)
                                            {{$article->category}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Status:</th>
                                    <td>
                                        @if($article->status == 1)
                                            <span class="badge me-1 bg-success">Aktiv</span>
                                        @else
                                            <span class="badge me-1 bg-secondary">Nicht aktiv</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button class="btn btn-outline-primary mt-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#changeArticleData">
                            <svg class="icon me-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
                            </svg>Stammdaten ändern
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- show Article Stock Data -->
    <div class="container-lg">
        <div class="card mb-4">
            <div class="card-header">Bestandsdaten</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table border mb-0">
                            <tr class="align-middle">
                                <th>Aktueller Bestand:</th>
                                <td>{{$article->in_stock}}</td>
                            </tr>
                            <tr class="align-middle">
                                <th>Mindestbestand:</th>
                                <td>{{$article->min_stock}}</td>
                            </tr>
                            <tr class="align-middle">
                                <th>Bestandstracking:</th>
                                <td>
                                    @if($article->stock_tracking == 1)
                                        <span class="badge me-1 bg-success">Aktiviert</span>
                                    @else
                                        <span class="badge me-1 bg-secondary">Deaktiviert</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        </div>
                        <button class="btn btn-outline-primary mt-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#changeStockData">
                        <svg class="icon me-2">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
                        </svg>Bestandsdaten ändern
                    </button>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection