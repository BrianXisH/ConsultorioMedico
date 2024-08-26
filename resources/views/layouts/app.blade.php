<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/front/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('assets/front/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Dashboard by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/front/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet" />

</head>

<body class="">
  
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          UPGCH
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="{{ route('welcome') }}">
              <i class="now-ui-icons design_app"></i>
              <p>PANEL</p>
            </a>
          </li>
          <li>
            <a href="{{ route('paciente.registrar') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Registrar Usuario</p>
            </a>
          </li>
          <li>
            <a href="{{ route('consultas.nueva') }}">
              <i class="now-ui-icons location_map-big"></i>
              <p>Nueva Cosulta</p>
            </a>
          </li>
          <li>
            <a href="{{ route('consultas.existente') }}">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Consulta Existente</p>
            </a>
          </li>
          <li>
            <a href="{{ route('citas.create') }}">
              <i class="now-ui-icons users_single-02"></i>
              <p>Agendar Cita</p>
            </a>
          </li>
          <li>
            <a href="{{ route('citas.index')}}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Ver Citas</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          @guest
           @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
           @endif

           @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
           @endif
         @else
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <li class="navbar-brand" style="color :aliceblue">
                <span class="nav-link">{{Auth::user()->name }}</span>
            </li>
            
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                  <i class="now-ui-icons arrows-1_share-66"></i>
                  <p>
                    <span class="d-lg-none d-md-block">logout</span>
                  </p>
                </a>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endguest
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/front/js/core/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/front/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/front/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/front/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets/front/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/front/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/front/js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets/front/demo/demo.js') }}"></script>
  
  <script>
    $(document).ready(function() {
      demo.initDashboardPageCharts();

      // Ajustar el padding-top del main-panel dinámicamente según la altura del navbar
      function adjustMainPanelPadding() {
        const navbarHeight = document.querySelector('.navbar').offsetHeight;
        document.getElementById('main-panel').style.paddingTop = navbarHeight + 'px';
      }

      adjustMainPanelPadding();

      // Ajustar el padding cuando la ventana se redimensiona
      window.addEventListener('resize', adjustMainPanelPadding);
    });
  </script>
</body>

</html>