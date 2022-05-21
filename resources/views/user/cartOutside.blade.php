<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @yield('head')

</head>

<body id="page-top" >
    
                

    <main class="py-0">
        
    @section('head')
     @livewireStyles
    @endsection


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8 mb-2 ml-0 mt-2">
                @if($name != null)
                <div class="card h-100 py-1">
                    <div class="card-body">
                        <div class="text-xl text-success">Moin {{$name}}, gönn dir was schönes </div>
                    </div>
                </div>
                @else
                <div class="alert alert-danger mt-3" role="alert">
                    Lieber Unbekannter, auf diesem Gerät ist kein Cookie hinterlegt! <a href="{{ route('login') }}">Zum Login</a>
                </div>
                @endif
            </div>
        </div>   

       @if($name != null)
        <div class="row justify-content-center">
    	    <div class="col-xl-8 mb-2 ml-0 mt-2">
                <div class="card h-100 py-1">
                    <div class="card-body">
                    
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                <!-- check if tallysheet has articles -->
                                @if($articles->count() > 0)
                                        
                                    @livewire('category-article-outside')

                                @else
                                    Keine Artikel hinterlegt. Wenden Sie sich bitte an Ihren Administrator.
                                @endif
                                
                                @if(session()->has('message'))
                                    <div class="alert mt-2 {{ Session::get('alert-class', 'alert-info') }}">
                                        {{session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert mt-2 {{ Session::get('alert-class', 'alert-danger') }}">
                                            {{$error}}
                                        </div>
                                    @endforeach
                                @endif
                                                                                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>

    </div>

    @livewireScripts

    </main>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
