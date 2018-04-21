<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container mt-3">
        <form>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estados">Entidad Federativa</label>    
                    <select class="estados" name="estados" id="estados" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipios">Municipios</label>    
                    <select class="municipios" name="municipios" id="municipios" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="localidades">Localidades</label>    
                    <select class="localidades" name="localidades" id="localidades" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="codigoPostal">Codigo Postal</label>    
                    <select class="codigoPostal" name="codigoPostal" id="codigoPostal" style="width: 100%">
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="colonias">Colonias</label>    
                    <select class="colonias" name="colonias" id="colonias" style="width: 100%">
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="calle">Calle</label>    
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle">
                </div>
                <div class="form-group col-md-3">
                    <label for="numExterno">Número Externo</label>    
                    <input type="text" class="form-control" name="numExterno" id="numExterno" placeholder="Número Externo">
                </div>
                <div class="form-group col-md-3">
                    <label for="numInterno">Número Interno</label>    
                    <input type="text" class="form-control" name="numInterno" id="numInterno" placeholder="Número Interno">
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
$('.estados').select2({
    placeholder:'Selecciona una opcion',
  ajax: {
    url: 'http://localhost:8000/fge-api/estados',
    dataType: 'json',
    type:'post'
  }
});
$('.municipios').select2({
    placeholder:'Selecciona una opcion',
  ajax: {
    url: 'http://localhost:8000/fge-api/municipios',
    dataType: 'json',
    type:'post'
  }
});
$('.localidades').select2({
    placeholder:'Selecciona una opcion',
  ajax: {
    url: 'http://localhost:8000/fge-api/localidades',
    dataType: 'json',
    type:'post'
  }
});
$('.codigoPostal').select2({
    placeholder:'Selecciona una opcion',
  ajax: {
    url: 'http://localhost:8000/fge-api/cpostal',
    dataType: 'json',
    type:'post'
  }
});
$('.colonias').select2({
    placeholder:'Selecciona una opcion',
  ajax: {
    url: 'http://localhost:8000/fge-api/colonias',
    dataType: 'json',
    type:'post'
  }
});
    </script>
  </body>
</html>