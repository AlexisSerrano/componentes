<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearDomicilio">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select :options="estados" label="nombre" :key="(estado!=null)?estado.id:0" v-model="estado" placeholder="Seleccione un estado" @input="getMunicipios" class="select"></v-select>
                </div>
                <div class="form-group col-md-4">
                    <label for="municipio">Municipios</label>  
                    <v-select :options="municipios" label="nombre" :key="(municipio!=null)?municipio.id:0" v-model="municipio" placeholder="Seleccione un municipio" @input="getLocalidades" class="select"></v-select>
                </div>
                <div class="form-group col-md-4">
                    <label for="localidad">Localidades</label>    
                    <v-select :options="localidades" label="nombre" :key="(localidad!=null)?localidad.id:0" v-model="localidad" placeholder="Seleccione una localidad" @input="getCodigosPostales" class="select"></v-select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cp">Codigo Postal</label>    
                    <v-select :options="cp" label="codigoPostal" :key="(codigo_postal!=null)?codigo_postal.id:0" v-model="codigo_postal" placeholder="Seleccione un codigo postal" @input="getColonias" class="select"></v-select>
                </div>
                <div class="form-group col-md-4">
                    <label for="colonia">Colonias</label>    
                    <v-select :options="colonias" label="nombre" :key="(colonia!=null)?colonia.id:0" v-model="colonia" placeholder="Seleccione una colonia" class="select"></v-select>
                </div>
                <div class="form-group col-md-4">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" :value="calle | uppercase" @input="calle = $event.target.value" placeholder="Ingrese la calle">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="numExterno">Número Externo</label>
                    <input type="text" class="form-control" id="numExterno" v-model="numExterno" placeholder="Ingrese el número externo">
                </div>
                <div class="form-group col-md-4">
                    <label for="numInterno">Número Interno</label>
                    <input type="text" class="form-control" id="numInterno" v-model="numInterno" placeholder="Ingrese el número interno">
                </div>
            </div>
            <!-- <h1>{{(estado!=null)?estado.id:estado}}</h1> -->
            <button type="submit" class="btn">Guardar</button>
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
                estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                municipio:null,
                localidad:null,
                codigo_postal:null,
                colonia:null,
                estados: [],
                municipios: [],
                localidades: [],
                cp: [],
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
            getEstados: function(){
                var urlEstados = 'getEstados2';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    this.municipio=null,
                    this.localidad=null,
                    this.codigo_postal=null,
                    this.colonia=null
                    var urlMunicipios = 'getMunicipios2/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    this.municipio=null,
                    this.localidad=null,
                    this.codigo_postal=null,
                    this.colonia=null,
                    this.municipios=[],
                    this.localidades=[],
                    this.cp=[],
                    this.colonias=[]
                }
            },
            getLocalidades: function(){
                if(this.municipio!=null){
                    this.localidad=null,
                    this.codigo_postal=null,
                    this.colonia=null
                    var urlLocalidades = 'getLocalidades2/'+this.municipio.id;
                    axios.get(urlLocalidades).then(response => {
                        this.localidades = response.data
                    });
                }
                else{
                    this.localidad=null,
                    this.codigo_postal=null,
                    this.colonia=null,
                    this.localidades=[],
                    this.cp=[],
                    this.colonias=[]
                }
            },
            getCodigosPostales: function(){
                if(this.municipio!=null){
                    this.codigo_postal=null
                    this.colonia=null
                    var urlCodigosPostales = 'getCodigosPostales2/'+this.municipio.id;
                    axios.get(urlCodigosPostales).then(response => {
                        this.cp = response.data
                    });
                }
                else{
                    this.codigo_postal=null,
                    this.colonia=null
                    this.cp=[],
                    this.colonias=[]
                }
            },
            getColonias: function(){
                if(this.codigo_postal!=null){
                    this.colonia=null
                    var urlColonias = 'getColonias2/'+this.codigo_postal.id;
                    axios.get(urlColonias).then(response => {
                        this.colonias = response.data
                    });
                }
                else{
                    this.colonia=null,
                    this.colonias=[]
                }
            },
            crearDomicilio: function(){
                var urlDomicilio = 'addDomicilio';
                axios.post(urlDomicilio,{
                    estado: this.estado.id,
                    municipio: this.municipio.id,
                    localidad: this.localidad.id,
                    colonia: this.colonia.id,
                    codigo_postal: this.codigo_postal.id,
                    calle: this.calle,
                    numExterno: this.numExterno,
                    numInterno: this.numInterno,
                }).then(response => {
                    this.calle='',
                    this.numExterno='',
                    this.numInterno='',
                    this.estado=null,
                    this.municipio=null,
                    this.localidad=null,
                    this.codigo_postal=null,
                    this.colonia=null
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
.form-control:focus {
  color: #6d6d6d;
  background-color: #fff;
  border-color: #828282;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(66, 66, 66, 0.25);
}
button{
    background-color: #424242;
    border-color: #424242;
    color: white;
}
</style>