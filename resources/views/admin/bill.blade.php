@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
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
    
    <div class="modal fade" id="setPayment" tabindex="-1" aria-labelledby="newArticle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Bezahlung eintragen</h5>
            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('billToPaid', $bill->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Zahlungsdatum:</label>
                    <input class="form-control" id="date" name="date" type="date" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Zahlungsmethode:</label>
                    <select class="form-select" aria-label="Default select example" name="method" id="method">
                        <option value="1">Bar</option>
                        <option value="2">Überweisung</option>
                        <option value="3">Paypal (Manuell)</option>
                    </select>
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

                                <th>Zahlungsdatum</th>
                                <td>
                                    @if($bill->payment_date != null) {{date('d.m.Y', strtotime($bill->payment_date))}}
                                    @else -
                                    @endif
                                </td>
                            </tr>

                            <tr class="align-middle">
                                <th>Rechnungsstellung</th>
                                <td>{{date('d.m.Y', strtotime($bill->created_at))}}</td>
                                
                                <th>Zahlungsmethode</th>
                                <td>
                                    @if($bill->payment_method != null)
                                        @if($bill->payment_method == 1) Bar @endif
                                        @if($bill->payment_method == 2) Überweisung @endif
                                        @if($bill->payment_method == 3) Paypal (Manuell) @endif
                                        @if($bill->payment_method == 1) Paypal (Automatisch) @endif
                                    @else - @endif
                                </td>
                            </tr>

                            <tr class="align-middle">
                                <th>Frist</th>
                                <td>{{date('d.m.Y', strtotime($bill->term))}}</td>

                                <th>Zahlungsfeststeller</th>
                                <td>
                                    @if($bill->payment_entry_by != null) {{$bill->payment_entry_by}}
                                    @else -
                                    @endif
                                </td>
                            </tr>

                            <tr class="align-middle">
                                <th>Status</th>
                                <td>
                                    @if($bill->open == 1)
                                        Offen
                                    @else
                                        Geschlossen
                                    @endif
                                </td>

                                <th></th>
                                <td></td>
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
            
            <a class="btn btn-outline-primary m-3" href="{{ route('downloadBill', Auth::user()->id)}}" type="button">download</a>

            <button class="btn btn-outline-primary" type="button" data-coreui-toggle="modal" data-coreui-target="#setPayment">
                <svg class="icon me-2">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-contrast"></use>
                </svg>Bezahlt
            </button>
        </div>
    </div>
@endsection