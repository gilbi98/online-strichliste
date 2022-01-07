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
                                @if(session()->has('message'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
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
