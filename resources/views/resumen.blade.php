<!doctype html>
<html lang="es">
  <head>
    <title>Persona</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div id="app">
        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home">Victima u ofendido</a></li>
            <li><a data-toggle="pill" href="#menu1">Investigado</a></li>
            <li><a data-toggle="pill" href="#menu2">Domicilio</a></li>
            <li><a data-toggle="pill" href="#menu3">Datos laborales</a></li>
            <li><a data-toggle="pill" href="#menu4">Datos de contacto</a></li>
          </ul>
          
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <persona :sistema="2" :tipo="4"></persona>
            </div>
            <div id="menu1" class="tab-pane fade">
                <persona :sistema="1" :tipo="10"></persona>
            </div>
            <div id="menu2" class="tab-pane fade">
                <domicilio></domicilio>
            </div>
            <div id="menu3" class="tab-pane fade">
                <datoslaborales></datoslaborales>
            </div>
            <div id="menu4" class="tab-pane fade">
                <datoscontactos></datoscontactos>
            </div>
          </div>
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