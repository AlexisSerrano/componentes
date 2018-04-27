<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearDomicilio">

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Entidad Federativa</label>    
                    <select class="estado" id="estado" style="width: 100%">
                        <option value="0">Seleccione su entidad federativa</option>
                        <option v-for="estado in estados" :value="estado.id" :key="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipios</label>    
                    <select class="municipio" id="municipio" style="width: 100%">
                        <option value="0">Seleccione su municipio</option>
                        <option v-for="municipio in municipios" :value="municipio.id" :key="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="localidad">Localidades</label>    
                    <select class="localidad" id="localidad" style="width: 100%">
                        <option value="0">Seleccione su localidad</option>
                        <option v-for="localidad in localidades" :value="localidad.id" :key="localidad.id">{{localidad.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="codigoPostal">Codigo Postal</label>    
                    <select class="codigoPostal" id="codigoPostal" style="width: 100%">
                        <option value="0">Seleccione su codigo postal</option>
                        <option v-for="codigoPostal in codigosPostales" :value="codigoPostal.id" :key="codigoPostal.id">{{codigoPostal.nombre}}</option>
                    </select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="colonia">Colonias</label>    
                    <select class="colonia" id="colonia" style="width: 100%">
                        <option value="0">Seleccione su colonia</option>
                        <option v-for="colonia in colonias" :value="colonia.id" :key="colonia.id">{{colonia.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" v-model="calle" placeholder="Ingrese la calle">
                </div>
                <div class="form-group col-md-3">
                    <label for="numExterno">Número Externo</label>
                    <input type="text" class="form-control" id="numExterno" v-model="numExterno" placeholder="Ingrese el número externo">
                </div>
                <div class="form-group col-md-3">
                    <label for="numInterno">Número Interno</label>
                    <input type="text" class="form-control" id="numInterno" v-model="numInterno" placeholder="Ingrese el número interno">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
       data(){
           return{
               estados: [],
               municipios: [],
               localidades: [],
               codigosPostales: [],
               colonias: [],
               calle: '',
               numExterno: '',
               numInterno: ''
           }
       },
       created: function(){
           this.getEstados();
           this.getMunicipios();
           this.getLocalidades();
           this.getCodigosPostales();
           this.getColonias();
       },
        mounted() {
            $("select").select2({
                placeholder:"Seleccione una opción"
            });
        },
        methods:{
            getEstados: function(){
                var urlEstados = 'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                var urlMunicipios = 'getMunicipios';
                axios.get(urlMunicipios).then(response => {
                    this.municipios = response.data
                });
            },
            getLocalidades: function(){
                var urlLocalidades = 'getLocalidades';
                axios.get(urlLocalidades).then(response => {
                    this.localidades = response.data
                });
            },
            getColonias: function(){
                var urlColonias = 'getColonias';
                axios.get(urlColonias).then(response => {
                    this.colonias = response.data
                });
            },
          getCodigosPostales: function(){
                var urlCodigosPostales = 'getCodigosPostales';
                axios.get(urlCodigosPostales).then(response => {
                    this.codigosPostales = response.data
                });
            },
            crearDomicilio: function(){
                var urlDomicilio = 'addDomicilio';
                var estadoS = $("#estado").select2('data')[0].id;
                var municipioS = $("#municipio").select2('data')[0].id;
                var localidadS = $("#localidad").select2('data')[0].id;
                var coloniaS = $("#colonia").select2('data')[0].id;
                var codigoPostalS = $("#codigoPostal").select2('data')[0].id;
                axios.post(urlDomicilio,{
                    estado: estadoS,
                    municipio: municipioS,
                    localidad: localidadS,
                    colonia: coloniaS,
                    codigoPostal: codigoPostalS,
                    calle: this.calle,
                    numExterno: this.numExterno,
                    numInterno: this.numInterno,
                }).then(response => {
                    $('select').val(0).trigger('change');
                    this.calle='',
                    this.numExterno='',
                    this.segundoAp='',
                    this.numInterno='',
                    swal({
                        title: 'Guardado Correctamente!',
                        text: 'Este domicilio fue guardado exitosamente',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    })
                }).catch(error => {
                     swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Este domicilio no fue posible guardarse',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                })
            }
       }
    }
</script>
<style>

</style>
