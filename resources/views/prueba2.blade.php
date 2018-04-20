<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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