<!doctype html>
<html lang="es">
  <head>
    <title>Familiar</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  

  </head>
  <body>
    <div id="app">
        <!--UAT-->
        <familiar></familiar>
        <!--UIPJ <persona :sistema="2" :tipo="1"></persona>-->
    </div>
    <!--<button id="btn">console.log idvarpersona</button>-->
  </body> 
    <script src="{{asset('js/app.js')}}"></script>
    <script>
     /* $("#btn").click(function(){
        console.log($("#idvarpersona").val());
      });*/
    </script>
</html>