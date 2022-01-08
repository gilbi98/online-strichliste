@extends('user.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
    
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Übersicht</div>
        
                    <table class="table">
                        <tr class="font-weight-bold">
                            <td>Artikel</td>
                            <td>Menge</td>
                            <td>Preis </td>
                            <td>Kosten</td></tr>
                        </tr>

                        @foreach($positions as $position)
                            <tr>
                                <td>{{$position->name}}</td>
                                <td>{{$position->quantity}}</td>                
                                <td>{{$position->price}}&#8364;</td>
                                <td>{{$position->amount}}&#8364;</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
