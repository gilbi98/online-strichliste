@extends('admin.master')

@section('currentSide')
    Artikel
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


<div class="modal fade" id="newArticle" tabindex="-1" aria-labelledby="newArticle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Artikel hinzufügen</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('createArticle') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name:</label>
                    <input class="form-control" id="name" name="name" type="text" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Kategorie:</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Keine Kategorie</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="price">Preis:</label>
                    <input class="form-control" id="price" name="price" type="text" placeholder="Preis">
                </div>
                <div class="row">
                    <label class="form-label" for="price">Bestand:</label>
                    <div class="col">
                        <input class="form-control" type="text" placeholder="Aktueller Bestand" aria-label="min" id="in_stock" name="in_stock">
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" placeholder="Mindestbestand" aria-label="Last name" id="min_stock" name="min_stock">
                    </div>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" id="stockTracking" name="stockTracking" type="checkbox" value="1" checked>
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
<div class="modal fade" id="newFillUp" tabindex="-1" aria-labelledby="newFillUp" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Artikel auffüllen</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('refillArticle') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="category">Artikel:</label>
                    <select class="form-select" aria-label="Default select example" id="article" name="article">
                        <option>Artikel wählen</option>
                        @foreach($articles as $article)
                            <option value="{{$article->id}}">{{$article->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                <label class="form-label" for="price">Menge:</label>
                    <div class="col">
                        <input class="form-control" type="text" placeholder="Menge" aria-label="min" id="quantity" name="quantity">
                    </div>
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
<div class="container-lg">
    <button class="btn btn-secondary mb-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#newArticle">
        <svg class="icon me-2">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
        </svg>Neuer Artikel
    </button>
    <button class="btn btn-primary mb-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#newFillUp">
        <svg class="icon me-2">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
        </svg>Artikel auffüllen
    </button>

    <div class="card mb-4">
        <div class="card-header">Alle Artikel</div>
            <div class="card-body">
                <div class="row">
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>#</th>
                                <th>Bezeichnung</th>
                                <th>Kategorie</th>
                                <th>Bestand</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr class="align-middle">
                                <td>
                                    {{$article->id}}
                                </td>
                                <td>
                                    <div>{{$article->name}}</div>
                                    <div class="small text-medium-emphasis"><span>{{number_format($article->price,2)}}&#8364;</span></div>
                                </td>
                                <td>
                                    <div>
                                        @if($article->category == null)
                                             -
                                        @else
                                            {{$article->category}}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($article->stock_tracking == 1)
                                        {{$article->in_stock}}
                                        @if($article->over_min > 0)
                                            <span class="badge me-1 bg-success">Min: {{$article->over_min}}</span>
                                        @else
                                            <span class="badge me-1 bg-danger">Min: {{$article->over_min}}</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Bearbeiten</a>
                                        <a class="dropdown-item" href="#">Bestand ändern</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection