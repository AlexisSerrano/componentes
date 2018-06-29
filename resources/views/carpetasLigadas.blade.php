<!doctype html>
<html lang="es">
  <head>
    <title>Carpetas ligadas a una persona</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  
        
  </head>
  <body>
	    <div id="app">
            <carpetas></carpetas>
	    </div>
  </body> 

  <script src="{{asset('js/app.js')}}"></script>
</html>