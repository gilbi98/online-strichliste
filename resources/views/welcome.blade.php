<!DOCTYPE html>
<html lang="en">

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


</head>

<body id="page-top" style="background-color: #F8F7F7;">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top">
                    <div class="container container-fluid m-0">
                    
                    </div>

                    <ul class="navbar-nav ml-auto">

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home_frontend') }}"><i class="bi bi-house-door fa-2x"></i></a></a>
                    @else
                        <a href="{{ route('login') }}">Login </a>

                        
                    @endauth
                </div>
            @endif
   
</li>

<li class="nav-item dropdown no-arrow ml-2">
@if (Route::has('login'))
                <div class="top-right links">
                @auth
                        
                    @else
                    <a href="{{ route('register') }}">Register </a>

                        
                    @endauth
                            
                </div>
            @endif
   
</li>

</ul>
                    

                </nav>
                

                <main class="py-0">

                <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-12 mb-2 ml-0 mt-2">
            <div class="card h-100 py-1">
                <div class="card-body bg-warning">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-danger">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>                                              
                            
                            TESTSYSTEM
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   	</div>
</div>


                </main>
                
                
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit">Logout</button>
</form>
                </div>
            </div>
        </div>
    </div>

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




