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
<<<<<<< HEAD
        <persona :sistema="1" :tipo="4"></persona>
=======
        <persona :sistema="1" :tipo="1"></persona>
>>>>>>> 7190812c84e4ed3d2c9ea016a74758bfcd93b445
        <!-- <button id="btn2">click</button> -->
    </div>
  </body> 

    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script>
      $( "#btn2" ).click(function() {
        console.log($("#pruebavue").text());
      });
    </script> -->
</html>