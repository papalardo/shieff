<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SCHIEFF') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
</head>
<body>

<div class="preloader-wrapper big active" id="pageLoad">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
<div id="app" style="display: none">
<nav>
    <div class="nav-wrapper cyan">
      <a class="brand-logo center">SHIEFF</a>

      <!-- Mobile -->
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="side-nav" id="mobile-demo">
        @if (Auth::user())
        <li><a class="dropdown-button" data-activates="pedidos-mobile">Pedidos<i class="material-icons right">arrow_drop_down</i></a></li>
            <!-- Menu Funcionário -->
              <ul id="pedidos-mobile" class="dropdown-content blue">
                <li><a href="{{ url('/dashboard/pedidos/aberto') }}">Abertos</a></li>
                <li><a href="{{ url('/dashboard/pedidos/pronto') }}">Pronto</a></li>
                <li><a href="{{ url('/dashboard/pedidos/aberto') }}">Finalizado</a></li>
              </ul>
               <li><a href="{{ url('pedido') }}">Novo Pedido</a></li>
              <li><a href="{{ url('meusPedidos') }}">Meus pedidos</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('logout') }}"
                 onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  Logout</a>
              </li>
        @else
            <li class="nav-item"><a class="waves-effect waves-light nav-link" href="{{ url('/login') }}">Login</a></li>
        @endif
        </ul>

      <!-- Desktop -->
      <ul class="right hide-on-med-and-down">
        @if (Auth::check() && Auth::user()->perfil_id == 10)
        <li><a class="dropdown-button" data-activates="pedidos">Pedidos<i class="material-icons right">arrow_drop_down</i></a></li>
          <!-- Menu Funcionário -->
          <ul id="pedidos" class="dropdown-content">
            <li><a href="{{ url('/dashboard/pedidos/aberto') }}">Abertos</a></li>
            <li><a href="{{ url('/dashboard/pedidos/pronto') }}">Pronto</a></li>
            <li><a href="{{ url('/dashboard/pedidos/aberto') }}">Finalizado</a></li>
          </ul>
        @endif
        @if (Auth::user())
         <li><a class="dropdown-button" href="#!" data-activates="cliente">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
            <ul id="cliente" class="dropdown-content">
              <li><a href="{{ url('pedido') }}">Novo Pedido</a></li>
              <li><a href="{{ url('meusPedidos') }}">Meus pedidos</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
              </li>
            </ul>

         @else
         <li class="nav-item"><a class="waves-effect waves-light nav-link" href="{{ url('/login') }}">Login</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
          @endif
      </ul>
          </div>
  </nav>
  <div id="login" class="modal">
    <div class="modal-content">
      <a href="{{url('/redirect')}}" class="btn blue">Login with Facebook</a>
      <a href="{{ url('/redirectInstagram') }}" class="btn btn-primary">Login with Instagram</a>
    </div>
  </div>
@yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

 @stack('scripts')

<script>
    $( document ).ready(function(){
    $('.modal').modal();
    $(".button-collapse").sideNav();    
    $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
    })

</script>
<style>
  
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</body>
</html>
