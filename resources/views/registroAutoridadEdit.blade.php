<!doctype html>
<html lang="es">
  <head>
    <title>Registro</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  
    <link rel="icon" href="{{ asset('img/logo.png') }}">
  </head>
  <body>
	    <div id="app">
      <registro :sistema="'uipj'" :carpeta="'xx'" :tipo="'autoridad'" :usuario="'usuario'" :idcarpeta="20" :idvarpersona="27" :empresa="false"></registro>
        </div>
  </body> 

  <script src="{{asset('js/app.js')}}"></script>
</html>