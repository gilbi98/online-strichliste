@extends('admin.master')

@section('title')
    Abrechnungen
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
                <div class="card-header">Offene Abrechnungen ({{count($open_invoices)}})</div>
                    <div class="card-body">
                        <div class="row">
                        @if($open_invoices->count() > 0)
                        <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Zeitraum</th>
                                <th>Frist</th>
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
                                
                                <td>
                                    <div>
                                    @if(Carbon\Carbon::now() > $invoice->term) <span class="badge me-1 rounded-pill bg-danger">&nbsp;</span> @endif
                                    {{date('d.m.Y', strtotime($invoice->term))}} 
                                    </div>
                                </td>
                                
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
                                                <div class="progress-bar bg-info" role="progressbar" style="width: @if($invoice->bills_total > 0) {{100-(($invoice->bills_open) / ($invoice->bills_total))*100}}% @else 0 @endif" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <a class="btn btn-primary" href="{{ route('invoice', $invoice->id)}}" type="button"><i class="cil-arrow-right"></i></a>
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
            <div class="card-header">Geschlossene Abrechnungen ({{count($closed_invoices)}})</div>
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
                                
                                <td>
                                    <div>
                                        {{date('d.m.Y', strtotime($invoice->term))}} 
                                    </div>
                                </td>
                                
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
                                                <div class="progress-bar bg-info" role="progressbar" style="width: @if($invoice->bills_total > 0) {{100-(($invoice->bills_open) / ($invoice->bills_total))*100}}% @else 0 @endif" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                    </div>
                                </td>

                                <td>
                                    
                                    <a class="btn btn-primary" href="{{ route('invoice', $invoice->id)}}" type="button"><i class="cil-arrow-right"></i></a>
                                    
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