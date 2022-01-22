@extends('admin.master')

@section('currentSide')
    Artikel
@endsection

@section('content')

<div class="container-lg">
    <button class="btn btn-secondary mb-2 py-0" type="button">
        <svg class="icon me-2">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
        </svg>Neuer Artikel
    </button>
    <button class="btn btn-primary mb-2 py-0" type="button">
        <svg class="icon me-2">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
        </svg>Artikel auffüllen
    </button>
    <div class="card mb-4">
        <div class="card-header"> Alle Artikel</div>
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
                                    Getränke
                                </td>
                                <td>
                                    8 <span class="badge me-1 bg-success">über Min</span>
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