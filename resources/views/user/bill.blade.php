@extends('user.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        
        <div class="col-xl-2 col-md-3 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Betrag</div>
                                
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($amount,2)}}&#8364;</div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Zeitraum</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d.m.Y', strtotime($start_date))}} - {{date('d.m.Y', strtotime($end_date))}}</div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Frist</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{date('d.m.Y', strtotime($term))}} </div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status</div>
                            
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($open == 1)
                                    <i class="bi bi-check-lg fa-2x "></i>
                                @else
                                    <i class="bi bi-check-lg fa-2x text-success"></i>
                                @endif
                            </div>
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
    	    <div class="col-xl-8 mb-2 ml-0 mt-2">
                <div class="card h-100 py-1">
                    <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Rechnungsposten</div>
        
                    @if($positions->count() > 0)
                        <table class="table">
                            <tr class="font-weight-bold">
                                <td>Artikel</td>
                                <td>Menge</td>
                                <td>Preis </td>
                                <td>Kosten</td></tr>
                            </tr>

                            @foreach($positions as $position)
                            <tr>
                                <td>{{$position->article}}</td>
                                <td>{{$position->quantity}}</td>                
                                <td>{{number_format(($position->amount/$position->quantity),2)}}&#8364;</td>
                                <td>{{number_format($position->amount,2)}}&#8364;</td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        Keine Rechnungsposten vorhanden. Bitte wenden Sie sich an Ihren Administrator.
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
