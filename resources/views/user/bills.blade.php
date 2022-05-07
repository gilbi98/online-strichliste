@extends('user.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        
        <div class="col-xl-2 col-md-3 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Guthaben</div>
                                
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{Auth::user()->credit}}&#8364;</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
               
        <div class="col-xl-2 col-md-3 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Offene Entnahmen</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total_positions,2)}}&#8364;</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-3 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Offene Rechnungen</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$open_bills}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-3 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Offene Beträge</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total_bills,2)}}&#8364;</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center">
    	<div class="col-xl-4 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahmen seit letzter Abrechnung am {{date('d.m.Y', strtotime($last_invoice))}}</div>
        
                    @if($purchases->count() > 0)
                        <table class="table">
                            <tr class="font-weight-bold">
                                <td>Artikel</td>
                                <td>Menge</td>
                                <td>Datum </td>
                            </tr>

                            @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->name}}</td>
                                <td>{{$purchase->quantity}}</td>                
                                <td>{{date('d.m.Y', strtotime($purchase->date))}}</td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        Keine Entnahmen seit der letzten Abrechnung vorhanden
                    @endif

                </div>
            </div>
        </div>

        <div class="col-xl-4 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Rechnungen</div>
        
                    @if($bills->count() > 0)

                        <table class="table">
                            <tr class="font-weight-bold">
                                <td>Datum</td>
                                <td>Betrag</td>
                                <td>Status</td>
                            </tr>

                            @foreach($bills as $bill)
                            <tr>
                                <td>
                                    <a href="{{ route('bill', $bill->id) }}">{{date('d.m.Y', strtotime($bill->created_at))}}</a>
                                </td>
                                <td>{{number_format($bill->total,2)}}&#8364;</td>                
                                <td>
                                    @if($bill->open == 0)
                                        <span class="badge badge-pill badge-success">beglichen</span>
                                    @else 
                                        <span class="badge badge-pill badge-secondary">nicht beglichen</span>
                                    @endif
                                </td>
                            </tr>
                                @endforeach
                            </table>

                    @else
                        Keine Rechnungen vorhanden
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
