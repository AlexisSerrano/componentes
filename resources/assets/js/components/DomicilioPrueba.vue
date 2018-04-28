<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearDomicilio">

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select :options="estados" label="text" v-model="estado" placeholder="Seleccione un estado" @input="alerta" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipios</label>  
                    <v-select :options="municipios" label="text" v-model="municipio" placeholder="Seleccione un municipio" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="localidad">Localidades</label>    
                    <v-select :options="localidades" label="text" v-model="localidad" placeholder="Seleccione una localidad" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="codigoPostal">Codigo Postal</label>    
                    <v-select :options="codigosPostales" label="text" v-model="codigoPostal" placeholder="Seleccione un codigo postal" class="select"></v-select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="colonia">Colonias</label>    
                    <v-select :options="colonias" label="text" v-model="colonia" placeholder="Seleccione una colonia" @input="alerta" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" :value="calle | uppercase" @input="calle = $event.target.value" placeholder="Ingrese la calle">
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

            <h1>{{estado}}</h1>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>

<script>
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import swal from 'sweetalert2'
    export default {
        data(){
            return{
                estado:null,
                municipio:null,
                localidad:null,
                codigoPostal:null,
                colonia:null,
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
        filters:{
            uppercase: function (str) {
                return str.toUpperCase()
            }
        },
        methods:{
            alerta: function(){
                swal({
                    title: 'Metodo Funcionando!',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
                // console.log(this.estado);
            },
            getEstados: function(){
                var urlEstados = 'getEstados2';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                // if(this.estado!=''){
                    var urlMunicipios = 'getMunicipios2/'+this.estado;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                // }
                
            },
            getLocalidades: function(){
                // if(this.municipio!=''){
                    var urlLocalidades = 'getLocalidades2/'+this.municipio;
                    axios.get(urlLocalidades).then(response => {
                        this.localidades = response.data
                    });
                // }
            },
            getCodigosPostales: function(){
                // if(this.municipio!=''){
                    var urlCodigosPostales = 'getCodigosPostales2/'+this.municipio;
                    axios.get(urlCodigosPostales).then(response => {
                        this.codigosPostales = response.data
                    });
                // }
            },
            getColonias: function(){
                // if(this.codigoPostal!=''){
                    var urlColonias = 'getColonias2/'+this.codigoPostal;
                    axios.get(urlColonias).then(response => {
                        this.colonias = response.data
                    });
                // }
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
.select{
    font-family: inherit
}
</style>
