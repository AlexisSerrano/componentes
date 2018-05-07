<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearDomicilio">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select :options="estados" label="nombre" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('estado') }"></v-select>
                    <span v-show="errors.has('estado')" class="text-danger">{{ errors.first('estado') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipios</label>  
                    <v-select :options="municipios" label="nombre" v-model="municipio" name="municipio" @input="getLocalidades" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') }"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="localidad">Localidades</label>    
                    <v-select :options="localidades" label="nombre" v-model="localidad" name="localidad" @input="getCodigosPostales" v-validate="'required'" :class="{ 'border border-danger': errors.has('localidad') }"></v-select>
                    <span v-show="errors.has('localidad')" class="text-danger">{{ errors.first('localidad') }}</span>
                    </div>
                <div class="form-group col-md-3">
                    <label for="cp">Codigo Postal</label>    
                    <v-select :options="cp" label="codigoPostal" v-model="codigo_postal" name="codigo_postal" @input="getColonias" v-validate="'required'" :class="{ 'border border-danger': errors.has('codigo_postal') }"></v-select>
                    <span v-show="errors.has('codigo_postal')" class="text-danger">{{ errors.first('codigo_postal') }}</span>                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="colonia">Colonias</label>    
                    <v-select :options="colonias" label="nombre" v-model="colonia" name="colonia" v-validate="'required'" :class="{ 'border border-danger': errors.has('colonia') }"></v-select>
                    <span v-show="errors.has('colonia')" class="text-danger">{{ errors.first('colonia') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="calle">Calle</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('calle') }" id="calle" name="calle" v-model="calle" placeholder="Ingrese la calle" v-validate="'required'">
                    <span v-if="errors.has('calle')" class="text-danger">{{ errors.first('calle') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="numExterno">Número Externo</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('numExterno') }" id="numExterno" name="numExterno" v-model="numExterno" placeholder="Ingrese el número externo" v-validate="'required'">
                    <span v-if="errors.has('numExterno')" class="text-danger">{{ errors.first('numExterno') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="numInterno">Número Interno</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Numero Interno') }" id="numInterno" data-vv-name="Numero Interno" name="numInterno" v-model="numInterno" placeholder="Ingrese el número interno" v-validate="'required'">
                    <span v-if="errors.has('Numero Interno')" class="text-danger">{{ errors.first('Numero Interno') }}</span>
                    <span v-if="errornumInterno!=''" class="text-danger">{{ errornumInterno }}</span>
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
                numInterno: '',
                errornumInterno: '',
            }
        },
        mounted: function () {
            this.getEstados()
        },
        methods:{
            getEstados: function(){
                var urlEstados = 'http://localhost/componentes/public/getEstados2';
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
                    var urlMunicipios = 'http://localhost/componentes/public/getMunicipios2/'+this.estado.id;
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
                    var urlLocalidades = 'http://localhost/componentes/public/getLocalidades2/'+this.municipio.id;
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
                    var urlCodigosPostales = 'http://localhost/componentes/public/getCodigosPostales2/'+this.municipio.id;
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
                    var urlColonias = 'http://localhost/componentes/public/getColonias2/'+this.codigo_postal.id;
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
                var urlDomicilio = 'http://localhost/componentes/public/addDomicilio';
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
                    this.errornumInterno = error.response.data.errors.numInterno;
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