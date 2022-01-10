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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

   <SCRIPT TYPE="text/javascript">
        <!--
        var downStrokeField;
        function autojump(fieldName,nextFieldName,fakeMaxLength)
        {
        var myForm=document.forms[document.forms.length - 1];
        var myField=myForm.elements[fieldName];
        myField.nextField=myForm.elements[nextFieldName];

        if (myField.maxLength == null)
        myField.maxLength=fakeMaxLength;

        myField.onkeydown=autojump_keyDown;
        myField.onkeyup=autojump_keyUp;
        }

        function autojump_keyDown()
        {
        this.beforeLength=this.value.length;
        downStrokeField=this;
        }

        function autojump_keyUp()
        {
        if (
        (this == downStrokeField) && 
        (this.value.length > this.beforeLength) && 
        (this.value.length >= this.maxLength)
        )
        this.nextField.focus();
        downStrokeField=null;
        }
        //-->
    </SCRIPT>

</head>

<body id="page-top" >
   
    <main class="py-0">        
        <div class="container-fluid mt-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    
                        <!-- check if tallysheet has articles to show different forms -->
                        @if($articles->count() > 0)
                            <!-- check if categories exist for showing categories or not -->
                                                
                            @if($categories->count() > 0)
                                                    
                                <form method="post" action="{{route('createPurchaseWithCategory')}}">
                                    @csrf
                                    <!-- if no categories exist only one dropdown is necessary -->
                                    <div class="form-group">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahme eintragen</div>
                                                            
                                            <select class="form-control" id="category" name="category">
                                                <option value="null"> </option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                                        
                                            <select class="form-control mt-2" id="article" name="article">
                                                <option value="null"> </option>
                                                    @foreach($articles as $article)
                                                    <option value="{{$article->id}}">{{$article->name}}</option>
                                                    @endforeach
                                            </select>

                                            <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>

                                        </div>
                                                    
                                        <div class="row justify-content-center">
                 
                                            <div class="col-xl-12">
                                                <div class="card card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>                                              
                                                                <div class="container py-0">
                                                                    <div class="row">

                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_1" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                    
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_2" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                    
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_3" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                    
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_4" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Speichern</button>
    
                                </form>

                                <SCRIPT TYPE="text/javascript">
                                    <!--
                                    autojump('ssn_1', 'ssn_2', 3);
                                    autojump('ssn_2', 'ssn_3', 2);
                                    autojump('ssn_3', 'ssn_4', 4);
                                    //-->
                                </SCRIPT>

                            @else

                                <form method="post" action="{{route('createPurchaseWithoutCategoryOutside')}}">
                                    
                                    @csrf
                                    <!-- if no categories exist only one dropdown is necessary -->
                                    <div class="form-group">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Entnahme eintragen</div>
                                            <select class="form-control" id="article" name="article">
                                                <option value="null"> </option>
                                                @foreach($articles as $article)
                                                <option value="{{$article->id}}">{{$article->name}}</option>
                                                @endforeach
                                            </select>

                                            <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>

                                        <div class="row justify-content-center">
                    
                                            <div class="col-xl-12">
                                                <div class="card card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>                                              
                                                                <div class="container py-0">
                                                                    <div class="row">
                                                                        
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_1" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                        
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_2" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                        
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_3" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                                        
                                                                        <div class="col">
                                                                            <INPUT TYPE=PASSWORD NAME="ssn_4" MAXLENGTH=1 SIZE=1 pattern="[0-9]*" inputmode="numeric">
                                                                        </div>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                            
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Speichern</button>
                                </form>

                                <SCRIPT TYPE="text/javascript">
                                    <!--
                                    autojump('ssn_1', 'ssn_2', 3);
                                    autojump('ssn_2', 'ssn_3', 2);
                                    autojump('ssn_3', 'ssn_4', 4);
                                    //-->
                                </SCRIPT>

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
