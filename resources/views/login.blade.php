<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
  {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"> --}}
  <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
  {{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  {{-- <link href="../assets/css/nucleo-icons.css" rel="stylesheet" /> --}}
  <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
  {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('css/material-dashboard.css?v=3.0.4')}}" rel="stylesheet" />
  {{-- <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" /> --}}
</head>

<body class="bg-gray-200">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesión</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST" action="{{route('validar')}}">
                  @csrf      
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                  @if($errors->first('email'))
                    <p class="text text-danger">Ingresar correo</p>
                  @endif
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  @if($errors->first('password'))
                    <p class="text text-danger">Ingresar contraseña</p>
                    @endif
                    
                    @if(Session::has('mensaje'))
                    <div class="form-check form-switch d-flex align-items-center mb-3">
                      {{-- <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                      <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label> --}}                    
                      <p class="text text-danger">{{Session::get('mensaje')}}</p>
                    </div>                 
                    @endif
                    
                    @if(Session::has('mensajecorrecto'))                                               
                      <p class="text text-success">{{Session::get('mensajecorrecto')}}</p>
                    @endif

                  <div class="text-center">
                    {{-- <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button> --}}
                    <input type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" value="Ingresar">
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Olvidaste tu contraseña?
                    <a href="{{route('restaurar_vista')}}" class="text-primary text-gradient font-weight-bold">Restaurar</a>
                  </p>
                  <p class="mt-4 text-sm text-center">
                    No tienes cuenta?
                    <a href="../pages/sign-up.html" class="text-primary text-gradient font-weight-bold">Crear una cuenta</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('js/core/popper.min.js')}}"></script>
  <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard.min.js?v=3.0.4')}}"></script>
</body>

</html>