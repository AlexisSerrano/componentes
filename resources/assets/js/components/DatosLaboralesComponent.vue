<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="validateBeforeSubmit">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="lugarTrabajo">Lugar de trabajo</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Lugar de Trabajo') || lugarTrabajoV}" id="lugarTrabajo" data-vv-name="Lugar de Trabajo" name="lugarTrabajo" v-validate="'required'" v-model="lugarTrabajo" placeholder="Ingrese el lugar de trabajo" autocomplete="off">
                    <span v-if="errors.has('Lugar de Trabajo') || lugarTrabajoV" class="text-danger">{{ errors.first('Lugar de Trabajo') || lugarTrabajoV[0]}}</span>
                </div>

                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('telefono') || telefonoV}" id="telefono" name="telefono" v-validate="'required|numeric'" v-model="telefono" placeholder="Ingrese el teléfono"  autocomplete="off">
                    <span v-if="errors.has('telefono') || telefonoV" class="text-danger">{{ errors.first('telefono') || telefonoV[0]}}</span>
                </div>

                <div class="form-group col-md-4">
                    <label for="estado">Entidad federativa</label>    
                    <v-select :options="estados" label="nombre" data-vv-name="Entidad Federativa" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('Entidad Federativa') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <span v-show="errors.has('Entidad Federativa')" class="text-danger">{{ errors.first('Entidad Federativa') }}</span>
                </div>

            </div>
            <div class="form-row">                
                <div class="form-group col-md-4">
                    <label for="municipio">Municipio</label>  
                    <v-select :options="municipios" label="nombre" v-model="municipio" name="municipio" @input="getLocalidades" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') || municipioV}" placeholder="Seleccione un municipio"></v-select>
                    <span v-show="errors.has('municipio') || municipioV" class="text-danger">{{ errors.first('municipio') || municipioV[0]}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="localidad">Localidad</label>    
                    <v-select :options="localidades" label="nombre" v-model="localidad" name="localidad" @input="getCodigosPostales" v-validate="'required'" :class="{ 'border border-danger': errors.has('localidad') || localidadV}" placeholder="Seleccione una localidad"></v-select>
                    <span v-show="errors.has('localidad')|| localidadV" class="text-danger">{{ errors.first('localidad') || localidadV[0]}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="cp">Código postal</label>    
                    <v-select :options="cp" label="codigoPostal" v-model="codigo_postal" name="codigo_postal" @input="getColonias"  v-validate="'required'" data-vv-name="codigo postal" :class="{ 'border border-danger': errors.has('codigo postal') }" placeholder="Seleccione un código postal"></v-select>
                    <span v-show="errors.has('codigo postal')" class="text-danger">{{ errors.first('codigo postal') }}</span>
                </div>
            </div>


            <div class="form-row">                
                <div class="form-group col-md-4">
                    <label for="colonia">Colonia</label>    
                    <v-select :options="colonias" label="nombre" v-model="colonia" name="colonia"  v-validate="'required'" :class="{ 'border border-danger': errors.has('colonia')|| coloniaV }" placeholder="Seleccione una colonia"></v-select>
                    <span v-show="errors.has('colonia')|| coloniaV" class="text-danger">{{ errors.first('colonia') || coloniaV[0]}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="calle">Calle</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('calle') || calleV}" id="calle" name="calle" v-validate="'required'" v-model="calle" placeholder="Ingrese la calle"  autocomplete="off">
                    <span v-if="errors.has('calle') || calleV" class="text-danger">{{ errors.first('calle') || calleV[0]}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="numExterno">Número externo</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Numero Externo') || numExternoV}" id="numExterno" data-vv-name="Numero Externo" name="numExterno" v-validate="'required'" v-model="numExterno" placeholder="Ingrese el número externo"  autocomplete="off">
                    <span v-if="errors.has('Numero Externo') || numExternoV" class="text-danger">{{ errors.first('Numero Externo') || numExternoV[0]}}</span>
                </div>
            </div>

            <div class="form-row">                
                <div class="form-group col-md-4">
                    <label for="numInterno">Número interno</label>
                    <input type="text" class="input form-control" id="numInterno" name="numInterno" v-model="numInterno" placeholder="Ingrese el número interno" autocomplete="off">
                </div>                
            </div>

            <div class="form-row">                
                <!--<div class="form-group col-md-4">
                    <label for="telefonoTrabajo">Teléfono de trabajo</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Télefono de Trabajo') || telefonoTrabajoV}" id="telefonoTrabajo" data-vv-name="Télefono de Trabajo" name="telefonoTrabajo" v-validate="'required|numeric'" v-model="telefonoTrabajo" placeholder="Ingrese el teléfono de trabajo" autocomplete="off">
                    <span v-if="errors.has('Télefono de Trabajo') || telefonoTrabajoV" class="text-danger">{{ errors.first('Télefono de Trabajo') || telefonoTrabajoV[0]}}</span>
                </div>-->
            </div>

            <!-- <h1>{{(estado!=null)?estado.id:estado}}</h1> -->
            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
</template>

<script>
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
                telefono:'',
                lugarTrabajo:'',
                telefonoTrabajo:'',
                municipioV:'',
                localidadV:'',
                coloniaV:'',
                calleV:'',
                numExternoV:'',
                telefonoV:'',
                telefonoTrabajoV:'',
                lugarTrabajoV:''
            }
        },
        mounted: function () {
            this.getEstados()
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
            CleanFields() {
                this.calle='',
                this.numExterno='',
                this.numInterno='',
                this.estado={ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                this.municipio=null,
                this.localidad=null,
                this.codigo_postal=null,
                this.colonia=null,
                this.telefono='',
                this.telefonoTrabajo='',
                this.lugarTrabajo=''
                this.$validator.reset();
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearDatosLaborales();
                        this.CleanFields();
                        return;
                    }
                    swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Éste domicilio no fue posible guardarse',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            crearDatosLaborales: function(){
                var urlDomicilio = 'addDatosLaborales';
                axios.post(urlDomicilio,{
                    estado: this.estado.id,
                    municipio: this.municipio.id,
                    localidad: this.localidad.id,
                    colonia: this.colonia.id,
                    codigo_postal: this.codigo_postal.id,
                    calle: this.calle.toUpperCase(),
                    numExterno: this.numExterno.toUpperCase(),
                    numInterno: this.numInterno.toUpperCase(),
                    telefono:this.telefono,
                    telefonoTrabajo:this.telefonoTrabajo,
                    lugarTrabajo:this.lugarTrabajo
                }).then((response)=>{
                    console.log(response.data)
                    swal({
                        title: 'Guardado Correctamente!',
                        text: 'Éste domicilio fue guardado exitosamente',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.municipioV = error.response.data.errors.municipio,
                        this.localidadV = error.response.data.errors.localidad,
                        this.coloniaV = error.response.data.errors.colonia,
                        this.calleV = error.response.data.errors.calle,
                        this.numExternoV = error.response.data.errors.numExterno
                        this.telefonoV = error.response.data.errors.telefono
                        this.telefonoTrabajoV = error.response.data.errors.telefonoTrabajo
                        this.lugarTrabajoV = error.response.data.errors.lugarTrabajo
                        swal({
                            title: 'Guardado Incorrecto!',
                            text: 'Éste domicilio no fue posible guardarse',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })
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
input{
    text-transform: uppercase
}
::placeholder{
    text-transform: none
}
</style>