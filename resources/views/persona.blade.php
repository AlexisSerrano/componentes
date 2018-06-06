<!doctype html>
<html lang="es">
  <head>
    <title>Persona</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  

  </head>
    <div id="app">
        <!--UAT-->
        <persona :sistema="1" :tipo="10"></persona>
        <!--UIPJ <persona :sistema="2" :tipo="1"></persona>-->
    </div>
  </body> 
    <script src="{{asset('js/app.js')}}"></script>
</html>