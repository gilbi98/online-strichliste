@extends('admin.master')

@section('title')
    Kategorien
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

    <!-- modal for create category button -->
    <div class="modal fade" id="newCategory" tabindex="-1" aria-labelledby="newCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Neue Kategorie</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('createCategory') }}">
                @csrf
                <div class="row">
                <label class="form-label" for="price">Name:</label>
                    <div class="col">
                        <input class="form-control" type="text" placeholder="Name der Kategorie" aria-label="min" id="name" name="name">
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

    <!-- content of site -->
    <button class="btn btn-outline-primary mb-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#newCategory">
    <i class="cil-plus"></i> Neue Kategorie
    </button>
    <div class="card mb-2">
        <div class="card-header">Alle Kategorien</div>
            <div class="card-body">
            @if($articles != null)
                <div class="row">
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>#</th>
                                <th>Bezeichnung</th>
                                <th>Artikel</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($articles as $article)
                            
                            <tr class="align-middle">
                                <td>
                                    <div>{{$article['category']}}</div>
                                </td>
                                <td>
                                    <div>{{$article['name']}}</div>
                                </td>
                                <td>
                                    <div>
                                        {{$article['articlesList']}}       
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="">Bearbeiten</a>
                                        <a class="dropdown-item" href="#">Bestand ändern</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
        @else
            Keine Kategorien vorhanden
        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection