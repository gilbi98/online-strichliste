@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <span>Abrechnungen</span>
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
    
    <!-- open invoices -->
    <div class="row">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Offene Abrechnungen</div>
                    <div class="card-body">
                        <div class="row">
                        @if($open_invoices->count() > 0)
                        <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Zeitraum</th>
                                <!--<th>Frist</th> -->
                                <th>Rechnungen</th>
                                <th>Betrag</th>
                                <th>Offene Rechnungen</th>
                                <th>Offener Betrag</th>
                                <th>Fortschritt</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($open_invoices as $invoice)
                            <tr class="align-middle">
                                <td>
                                    <div>
                                        {{date('d.m.Y', strtotime($invoice->start_date))}} -  {{date('d.m.Y', strtotime($invoice->end_date))}}
                                    </div>
                                </td>
                                <!--
                                <td>
                                    <div>
                                        
                                    </div>
                                </td>
                                -->
                                <td>
                                    <div>
                                        {{$invoice->bills_total}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($invoice->amount_total,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{$invoice->bills_open}} <i class="fa-thin fa-angle-right"></i>
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($invoice->amount_open,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        <div class="clearfix">
                                            <div class="progress progress-thin">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{100-(($invoice->bills_open) / ($invoice->bills_total))*100}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <a class="btn btn-primary" href="{{ route('invoice', $invoice->id)}}" type="button">einsehen</a>
                                    </div>
                                </td>
                                  
                            </tr>
                            @endforeach
                        @else
                            Keine offenen Abrechnungen vorhanden
                        @endif
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($closed_invoices->count() > 0)
   <!-- closed invoices -->
    <div class="container-lg">
        <div class="card mb-4">
            <div class="card-header">Geschlossene Abrechnungen</div>
                <div class="card-body">
                    <div class="row">
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Datum</th>
                                <th>Frist</th>
                                <th>Rechnungen</th>
                                <th>Betrag</th>
                                <th>Offene Rechnungen</th>
                                <th>Offener Betrag</th>
                                <th>Fortschritt</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        @foreach($closed_invoices as $invoice)
                            <tr class="align-middle">
                                <td>
                                    <div>
                                        {{date('d.m.Y', strtotime($invoice->start_date))}} - {{date('d.m.Y', strtotime($invoice->end_date))}}
                                    </div>
                                </td>
                                <!--
                                <td>
                                    <div>
                                        
                                    </div>
                                </td>
                                -->
                                <td>
                                    <div>
                                        {{$invoice->bills_total}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($invoice->amount_total,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{$invoice->bills_open}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($invoice->amount_open,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        <div class="clearfix">
                                            <div class="progress progress-thin">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{100-(($invoice->bills_open) / ($invoice->bills_total))*100}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                                </td>

                                <td>
                                    
                                    <a class="btn btn-primary" href="{{ route('invoice', $invoice->id)}}" type="button">einsehen</a>
                                    
                                </td>
                                  
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                        
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>

@endsection