@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <span>{{$bill->number}} {{$bill->firstname}} {{$bill->lastname}}</span>
        </li>
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
    
    <div class="row">
        
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Stammdaten</div>
                    <div class="card-body">
                        <div class="row">
                        <table class="table border mb-0">
                            
                            <tr class="align-middle">
                                <th>Aussteller</th>
                                <td>-</td>

                                <th>Status</th>
                                <td>
                                    @if($bill->open == 1)
                                        Offen
                                    @else
                                        Geschlossen
                                    @endif
                                </td>
                            </tr>

                            <tr class="align-middle">
                                <th>Rechnungsstellung</th>
                                <td>{{date('d.m.Y', strtotime($bill->created_at))}}</td>
                                
                                <th>Zahlungsdatum</th>
                                <td>-</td>
                            </tr>

                            <tr class="align-middle">
                                <th>Frist</th>
                                <td>{{date('d.m.Y', strtotime($bill->term))}}</td>

                                <th>Zahlungsmethode</th>
                                <td>-</td>
                            </tr>

                            
                        
                       
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Positionen</div>
                    <div class="card-body">
                        <div class="row">
                        <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Artikel</th>
                                <th>Menge</th>
                                <th>Kosten</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($positions as $position)
                            <tr class="align-middle">
                                <td>{{$position->article}}</td>
                                <td>{{$position->quantity}}</td>
                                <td>{{number_format($position->amount,2)}}&#8364;</td>
                            </tr>                       
                        @endforeach
                        </tbody> 
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection