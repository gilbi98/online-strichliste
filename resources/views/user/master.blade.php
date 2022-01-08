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
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top border-bottom" style="border-color: #BABABA">
        <!-- nav bar fpr icons on the left -->
        <div class="container container-fluid m-0">
            <div class="row">
                <div class="col">
                    <a href="{{ route('home') }}" class="mr-1" data-toggle="tooltip" title="Home"><i class="bi bi-house-door fa-2x"></i></a>
                </div>
                <div class="col">
                    <a href="{{ route('cart') }}" class="mr-1" data-toggle="tooltip" title="Warenkorb"><i class="bi bi-cart fa-2x"></i></a>
                </div>
                <!--<div class="col">
                    <a href="" class="m-1" data-toggle="tooltip" title="Ident Verfahren"><i class="bi bi-upc-scan fa-2x"></i></a>
                </div>!-->
                <div class="col">
                    <a href="{{ route('bills') }}"  class="mr-1" data-toggle="tooltip" title="Abrechnung"><i class="bi bi-clipboard-x fa-2x"></i></a>
                </div>
            </div>
        </div>


        <!-- navbar on the right -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" class="btn btn-success btn-circle">{{Auth::user()->nickname}}</button>
                </a>
                       
                <!-- dropdown menu user icon -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 
                    <a class="dropdown-item" href="">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Profil
                    </a>
                                
                    <a class="dropdown-item" href="">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Admin Bereich
                    </a>
                                
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="bi bi-box-arrow-right"></i> Logout</a>    
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    </div>
            </li>
        </ul>

    </nav>
                

    <main class="py-0">
        @yield('content')
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
