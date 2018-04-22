<!doctype html>
<html lang="es">
  <head>
    <title>Persona</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    
  </head>
  <body style="">
    <div class="container mt-3">
        <form method="post" action="{{url('addPersona')}}">
            @csrf
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
                        <option>Seleccione nacionalidad</option>
                        @forelse($nacionalidades as $nacionalidad)
                            <option value="{{$nacionalidad->id}}">{{$nacionalidad->nombre}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="municipio">Municipio de Origen</label>    
                    <select class="municipio" name="municipio" id="municipio" style="width: 100%">
                        <option>Seleccione nacionalidad</option>
                        @forelse($municipios as $municipio)
                            <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="etnia">Etnia</label>    
                    <select class="etnia" name="etnia" id="etnia" style="width: 100%">
                        <option>Seleccione nacionalidad</option>
                        @forelse($etnias as $etnia)
                            <option value="{{$etnia->id}}">{{$etnia->nombre}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="lengua">Lengua</label>    
                    <select class="lengua" name="lengua" id="lengua" style="width: 100%">
                        <option>Seleccione nacionalidad</option>
                        @forelse($lenguas as $lengua)
                            <option value="{{$lengua->id}}">{{$lengua->nombre}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="esEmpresa">Es Empresa</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                          <label class="form-check-label" for="si" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" name="esEmpresa" id="si" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="no" style="padding-right: 5px">No</label>
                        <input class="form-check-input" type="radio" name="esEmpresa" id="no" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/app.js')}}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        Vue.component('persona',{

        })
        let
        $("select").select2();
    </script>
  </body>
</html>