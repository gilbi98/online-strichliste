@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <span>Entnahmen</span>
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
    
    <div class="card mb-2">
        <div class="card-header">Offene Entnahmen seit letzter Abrechnung am {{date('d.m.Y', strtotime($last_invoiceDate))}}</div>
            <div class="card-body">
                <div class="row">
                    <table class="table border mb-0">
                        @if(count($purchases) > 0)
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Artikel</th>
                                <th>Menge</th>
                                <th>Umsatz</th>
                            </tr>
                        </thead>
                        @else
                            Keine Entnahmen seit letzter Abrechnung
                        @endif
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr class="align-middle">
                                <td>
                                    <div>{{$purchase['name']}}</div>
                                        <div class="small text-medium-emphasis">
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{$purchase['quantity']}}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                    {{number_format($purchase['costs'],2)}}&#8364;
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if(count($purchases) > 0)
        <button class="btn btn-outline-primary mb-2 py-0" type="button" data-coreui-toggle="modal" data-coreui-target="#newInvoice">
        <i class="cil-money"></i> Abrechnen
        </button>
        @endif
    </div>

    <div class="modal fade" id="newInvoice" tabindex="-1" aria-labelledby="newInvoice" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Entnahmen abrechnen</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                @if($last_invoiceInterval != null)
                    Letzte Abrechnung: {{$last_invoiceInterval}}
                @else
                Letzte Abrechnung: -
                @endif<br>
                Empfohlene Abrechnung: {{date('d.m.Y', strtotime($last_invoiceDate))}} - {{date('d.m.Y', strtotime($currentDate))}}
                </div>
                <form method="post" action="{{ route('createInvoice') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Von:</label>
                    <input class="form-control" id="start" name="start" type="date" placeholder="Von">
                </div>
                <div class="mb-3">    
                    <label class="form-label" for="name">Bis:</label>
                    <input class="form-control" id="end" name="end" type="date" placeholder="Bis">
                </div>
                <label class="form-label" for="name">Zahlungsfrist:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Datum</span>
                    <input class="form-control" type="date" aria-label="Datum" id="term_date" name="term_date">
                    <span class="input-group-text">Tage</span>
                    <input class="form-control" type="text" aria-label="Tage" id="term_days" name="term_days">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Abbrechen</button>
                    <button class="btn btn-primary" type="submit">Speichern</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection