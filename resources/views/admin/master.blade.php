
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.0.2
* @link https://coreui.io
* Copyright (c) 2021 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Dashboard</title>

    <link rel="manifest" href="{{ asset('css/admin/manifest.json') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Vendors styles-->
    
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar-content.css') }}">
    
    <!-- Main styles for this application-->
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-118965717-1');
    </script>
    <link href="{{ asset('css/admin/chartsjs.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a>
        </li>
        <li class="nav-title">Bestandsmanagement</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('articles') }}">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
            </svg> Artikel</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
            </svg> Kategorien</a>
        </li>
        <li class="nav-title">Abrechnungsmanagement</li>
        <li class="nav-item"><a class="nav-link" href="typography.html">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
            </svg> Entnahmen</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="typography.html">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
            </svg> Abrechnungen</a>
        </li>
        <li class="nav-title">Usermanagement</li>
        <li class="nav-item"><a class="nav-link" href="typography.html">
            <svg class="nav-icon">
            <i class="cil-child"></i>
            </svg> User</a>
    </li>
        
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg></a>
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Bestände</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Abrechnungen</a></li>
          </ul>
          <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                </svg></a></li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg></a></li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md bg-success text-white" style="border-radius: 25px;">GH</div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                 
                <a class="dropdown-item" href="{{ route('home') }}">
                  <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg> User-Bereich</a>

                  <a class="dropdown-item" href="{{ route('logout') }}">
                    <svg class="icon me-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg> Logout</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>@yield('currentSide')</span>
              </li>
            </ol>
          </nav>
        </div>
        
      </header>
      
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          
            @yield('content')
            
        </div>
      </div>

    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('css/admin/bundle.min.js') }}"></script>
    <script src="{{ asset('css/admin/simplebar.min.js') }}"></script>

    <!-- We use those scripts to show code examples, you should remove them in your application.-->
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/unescaped-markup/prism-unescaped-markup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('css/admin/chart.min.js') }}"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="{{ asset('css/admin/main.js') }}"></script>
    <script>
    </script>

  </body>
</html>