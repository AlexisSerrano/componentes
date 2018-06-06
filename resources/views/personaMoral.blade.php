<!doctype html>
<html lang="es">
  <head>
    <title>Persona</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  

  </head>
  <body>
    <div id="app">
        <personamoral></personamoral>        
    </div>    
    <button id="btn2">console.log idvarpersonamoral</button>
  </body> 

    <script src="{{asset('js/app.js')}}"></script>
    <script>
      $( "#btn2" ).click(function() {
        console.log($("#idvarpermoral").val());
      });
    </script>
</html>