<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>La Vendimia</title>
    <script src="{{ asset("public/js/jquery.js") }}"></script>
    <script src="{{ asset("public/js/mine.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{asset("public/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("public/css/styles.css")}}">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
</head>
<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand dropdown" href="{{url('/')}}">La Vendimia</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">        
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inicio<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{url('/ventas')}}">Ventas</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/clientes')}}">Clientes</a></li>
                        <li><a href="{{url('/articulos')}}">Articulos</a></li>
                        <li><a href="{{url('/configuracion')}}">Configuración</a></li>
                    </ul>
                </li>
            </ul>     
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">Fecha: {{ date('d/m/Y') }}</li> 
                <li><a href="http://www.9gag.com" target="_blank"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a></li>
            </ul>
        </div>
    </div>
    </nav>

<div class="container-fluid">
    <div class="col-md-10 col-md-offset-1">
       @yield('content')
    </div>
</div>

<footer>
    <center><hr>Proyect &copy; 2017</center>
</footer>
<script src="{{ asset("public/js/bootstrap.js") }}"></script>
</body>
</html>