@extends('admin.master')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6 col-lg-3">
    <div class="card mb-4 text-white bg-primary">
      <div class="card-body pb-0 d-flex justify-content-between align-items-start mb-4">
        <div>
          <div class="fs-4 fw-semibold">{{$user}}<span class="fs-6 fw-normal">
              <svg class="icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-bottom"></use>
              </svg></span></div>
          <div>Nutzer</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card mb-4 text-white bg-info">
      <div class="card-body pb-0 d-flex justify-content-between align-items-start mb-4">
        <div>
          <div class="fs-4 fw-semibold">{{$articles}}<span class="fs-6 fw-normal">
              </div>
          <div>Artikel</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card mb-4 text-white bg-warning">
      <div class="card-body pb-0 d-flex justify-content-between align-items-start mb-4">
        <div>
          <div class="fs-4 fw-semibold">{{$purchases}} / {{number_format($purchasesAmount,2)}}&#8364;<span class="fs-6 fw-normal">
             </div>
          <div>Offene Entnahmen</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- /.col-->
  <div class="col-sm-6 col-lg-3">
    <div class="card mb-4 text-white bg-danger">
      <div class="card-body pb-0 d-flex justify-content-between align-items-start mb-4">
        <div>
          <div class="fs-4 fw-semibold">{{$openBills}} / {{number_format($openBillsAmount,2)}}&#8364;<span class="fs-6 fw-normal">
              <svg class="icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-bottom"></use>
              </svg></span></div>
          <div>Offene Rechnungen</div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
<div class="row">
    <div class="col-sm-6 col-lg-6">
        <div class="card mb-2">
            <div class="card-header">Aufzufüllende Artikel</div>
                <div class="card-body">
                    <div class="row">
                        @if(count($criticalArticles) > 0)
                        <table class="table border mb-0">
                       
                            <thead class="table-light fw-semibold">
                                <tr class="align-middle">
                                    <th>Artikel</th>
                                    <th>Bestand</th>
                                    <th>Soll</th>
                                    <th>Differenz</th>
                                    <th></th>
                                </tr>
                            </thead>
                        
                            <tbody>
                            @foreach($criticalArticles as $article)
                            <tr class="align-middle">
                                <td>
                                    {{$article->name}}  
                                </td>
                                <td>
                                    {{$article->in_stock}}  
                                </td>
                                <td>
                                    {{$article->min_stock}}  
                                </td>
                                <td>
                                    {{$article->over_min}}  
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                        <i class="cil-check">Alle Artikel sind mindestens mit 3 Stück über dem Mindestbestand</i>
                        @endif
                    </div>
                </div>  
            </div>
        </div>
    
    <div class="col-sm-6 col-lg-6">
        <div class="card mb-2">
            <div class="card-header">Nutzer mit hohen Beträgen</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table border mb-0">
                       
                            <thead class="table-light fw-semibold">
                                <tr class="align-middle">
                                    <th>Nutzer</th>
                                    <th>Offene Entnahmen</th>
                                    <th>Offene Rechnungen</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection