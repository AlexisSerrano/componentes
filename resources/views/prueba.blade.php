<!doctype html>
<html lang="es">
  <head>
    <title>Persona</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body style="">
    <div class="container mt-3">
        <form>
            <div class="form-row">
            <div class="form-group col-md-3">
                <label for="nombres">Nombre</label>
                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group col-md-3">
                <label for="primerAp">Primer Apellido</label>
                <input type="text" class="form-control" id="primerAp" name="primerAp" placeholder="Ingrese el primer apellido">
            </div>
            <div class="form-group col-md-3">
                <label for="segundoAp">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundoAp" name="segundoAp" placeholder="Ingrese el segundo apellido">
            </div>
            <div class="form-group col-md-3">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
            </div>
            </div>


            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="sexo">Sexo</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="hombre" style="padding-right: 5px">Hombre</label>
                            <input class="form-check-input" type="radio" name="sexo" id="hombre" value="hombre">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="mujer" style="padding-right: 5px">Mujer</label>
                            <input class="form-check-input" type="radio" name="sexo" id="mujer" value="mujer">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="rfc">R.F.C</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="R.F.C">
                </div>
                <div class="form-group col-md-3">
                    <label for="rfc">Curp</label>
                    <input type="text" class="form-control" id="curp" name="curp" placeholder="Curp">
                </div>
                <div class="form-group col-md-3">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <select class="nacionalidad" name="nacionalidad" id="nacionalidad" style="width: 100%">
                    </select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="municipioOrigen">Municipio de Origen</label>    
                    <select class="municipioOrigen" name="municipioOrigen" id="municipioOrigen" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="etnia">Etnia</label>    
                    <select class="etnia" name="etnia" id="etnia" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="lengua">Lengua</label>    
                    <select class="lengua" name="lengua" id="lengua" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="esEmpresa">Es Empresa</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label" for="si" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" name="esEmpresa" id="si" value="si">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="no" style="padding-right: 5px">No</label>
                        <input class="form-check-input" type="radio" name="esEmpresa" id="no" value="no">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="stylesheet" href="{{asset('js/app.js')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
$('.nacionalidad').select2({
    placeholder:'Selecciona tu nacionalidad',
  ajax: {
    url: 'http://localhost/componentes/nacionalidad',
    dataType: 'json',
    type:'post'
  }
});
$('.municipioOrigen').select2({
    placeholder:'Selecciona tu municipio de origen',
  ajax: {
    url: 'http://localhost/componentes/municipios',
    dataType: 'json',
    type:'post'
  }
});
$('.etnia').select2({
    placeholder:'Selecciona tu etnia',
  ajax: {
    url: 'http://localhost/componentes/etnias',
    dataType: 'json',
    type:'post'
  }
});
$('.lengua').select2({
    placeholder:'Selecciona tu lengua',
  ajax: {
    url: 'http://localhost/lengua/componentes',
    dataType: 'json',
    type:'post'
  }
});
    </script>
  </body>
</html>