@extends('admin.master')

@section('currentSide')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <span>Rechnungen</span>
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
    
    <!-- open bills -->
    <div class="row">
        @if($open_bills->count() > 0)
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-header">Offene Rechnungen</div>
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
                                        <a href="{{ route('billAdmin', $bill->id)}}">einsehen</a>
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
                                        <a href="{{ route('billAdmin', $bill->id)}}">einsehen</a>
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