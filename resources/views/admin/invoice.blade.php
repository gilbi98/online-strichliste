@extends('admin.master')

@section('currentSide')

    <span>Rechnungen</span>
       
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
    
    <!-- open bills -->
    <div class="row">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Offene Rechnungen</div>
                    <div class="card-body">
                        <div class="row">
                        @if($open_bills->count() > 0)
                        <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Rechnungsnummer</th>
                                <th>Nutzer</th>
                                <th>Gesamtbetrag</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($open_bills as $bill)
                            <tr class="align-middle">
                                <td>
                                    <div>
                                        {{$bill->number}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{$bill->firstname}} {{$bill->lastname}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($bill->amount,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>

                                        <a class="btn btn-primary" href="{{route('billAdmin', $bill->id)}}" type="button"><i class="cil-arrow-right"></i></a>
                                    </div>
                                   
                                </td>
                                
                            </tr>
                            @endforeach
                        @else
                            Keine offenen Rechnungen vorhanden
                        @endif
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($closed_bills->count() > 0)
    <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Geschlossene Rechnungen</div>
                    <div class="card-body">
                        <div class="row">
                        <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>Rechnungsnummer</th>
                                <th>Nutzer</th>
                                <th>Gesamtbetrag</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($closed_bills as $bill)
                            <tr class="align-middle">
                                <td>
                                    <div>
                                        {{$bill->number}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{$bill->firstname}} {{$bill->lastname}}
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        {{number_format($bill->amount,2)}}&#8364;
                                    </div>
                                </td>
                                
                                <td>
                                    <div>
                                        <a class="btn btn-primary" href="{{route('billAdmin', $bill->id)}}" type="button"><i class="cil-arrow-right"></i></a>
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
    </div>
   @endif
</div>

@endsection