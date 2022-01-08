@extends('user.master')

@section('content')

@section('head')
    <!-- accordion style -->
    <style>
        .accordion {
            background-color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
            transition: 0.4s;
        }
        .active, .accordion:hover {
            background-color: #eee;
        }
        .panel {
            padding: 0 18px;
            background-color: white;
            display: none;
            overflow: hidden;
            width: 100%;
        }
    </style>
  
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    	<div class="col-xl-8 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body">
                    
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12">
                             <!-- check if tallysheet has articles -->
                            @if($articles->count() > 0)
                                        <!-- check if categories exist for showing categories or not -->
                                        @if($categories_exist == true)
                                            

                                        @else

                                            <form method="post" action="{{route('createPurchaseWithoutCategory')}}">
                                                @csrf
                                                <!-- if no categories exist only one dropdown is necessary -->
                                                <div class="form-group">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahme eintragen</div>
                                                    <select class="form-control" id="article" name="article">
                                                        @foreach($articles as $article)
                                                            <option value="{{$article->id}}">{{$article->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                                                        @foreach($articles as $article)
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Speichern</button>
                                            </form>

                                        @endif
                            @else
                                Keine Artikel hinterlegt. Wenden Sie sich bitte an Ihren Administrator.
                            @endif
                                
                            @if(session()->has('message'))
                                <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }}">
                                    {{session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                                                                    
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");
            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
            panel.style.display = "none";
            } else {
            panel.style.display = "block";
            }
        });
    }
</script>

@endsection
