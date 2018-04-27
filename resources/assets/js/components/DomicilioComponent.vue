<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearDomicilio">

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Entidad Federativa</label>    
                    <select2 :options="estados" v-model="estado" @input="getMunicipios" id="estado"></select2>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipios</label>  
                    <select2 :options="municipios" v-model="municipio" @input="getLocalidades">
                        <option value="0">Seleccione Municipio</option>
                    </select2>
                </div>
                <div class="form-group col-md-3">
                    <label for="localidad">Localidades</label>    
                    <select2 :options="localidades" v-model="localidad" @input="getCodigosPostales">
                        <option value="0">Seleccione Localidad</option>
                    </select2>
                </div>
                <div class="form-group col-md-3">
                    <label for="codigoPostal">Codigo Postal</label>    
                    <select2 :options="codigosPostales" v-model="codigoPostal" @input="getColonias">
                        <option value="0">Seleccione Codigo Postal</option>
                    </select2>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="colonia">Colonias</label>    
                    <select2 :options="colonias" v-model="colonia">
                        <option value="0">Seleccione colonia</option>
                    </select2>
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
                estado:'',
                municipio:'0',
                localidad:'0',
                codigoPostal:'0',
                colonia:'0',
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
        mounted: function () {
            this.getEstados()
        },
        methods:{
            alerta: function(){
                swal({
                    title: 'Metodo Funcionando!',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
            },
            getEstados: function(){
                var urlEstados = 'getEstados2';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                if(this.estado!=''){
                    var urlMunicipios = 'getMunicipios2/'+this.estado;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                
            },
            getLocalidades: function(){
                if(this.municipio!=''){
                    var urlLocalidades = 'getLocalidades2/'+this.municipio;
                    axios.get(urlLocalidades).then(response => {
                        this.localidades = response.data
                    });
                }
            },
            getCodigosPostales: function(){
                if(this.municipio!=''){
                    var urlCodigosPostales = 'getCodigosPostales2/'+this.municipio;
                    axios.get(urlCodigosPostales).then(response => {
                        this.codigosPostales = response.data
                    });
                }
            },
            getColonias: function(){
                if(this.codigoPostal!=''){
                    var urlColonias = 'getColonias2/'+this.codigoPostal;
                    axios.get(urlColonias).then(response => {
                        this.colonias = response.data
                    });
                }
            },
            crearDomicilio: function(){
                var urlDomicilio = 'addDomicilio';
                axios.post(urlDomicilio,{
                    estado: this.estado,
                    municipio: this.municipio,
                    localidad: this.localidad,
                    colonia: this.colonia,
                    codigoPostal: this.codigoPostal,
                    calle: this.calle,
                    numExterno: this.numExterno,
                    numInterno: this.numInterno,
                }).then(response => {
                    $('select').val(0).trigger('change');
                    this.calle='',
                    this.numExterno='',
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
