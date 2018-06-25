<template>

    <div class="container-fluid">

        <spring-spinner v-if="loader" class="centrar" :animation-duration="1500" :size="60" :color="'#828282'"/>
        <form v-on:submit.prevent="validateBeforeSubmit" v-if="loader!=true">
            
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="estado">Entidad federativa</label>    
                    <v-select :options="estados" label="nombre" data-vv-name="entidad federativa" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('entidad federativa') || this.validacionesback.idEstado}" placeholder="Seleccione una entidad federativa"></v-select>
                    <span v-show="errors.has('entidad federativa')" class="text-danger">{{ errors.first('entidad federativa') }}</span>
                    <span v-if="this.validacionesback.idEstado!=undefined" class="text-danger">{{ String(this.validacionesback.idEstado)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="municipio">Municipio</label>  
                    <v-select :options="municipios" label="nombre" v-model="municipio" name="municipio" @input="getLocalidades" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') || this.validacionesback.idMunicipio}" placeholder="Seleccione un municipio"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio')}}</span>
                    <span v-if="this.validacionesback.idMunicipio!=undefined" class="text-danger">{{ String(this.validacionesback.idMunicipio)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="localidad">Localidad</label>    
                    <v-select :options="localidades" label="nombre" v-model="localidad" name="localidad" @input="getCodigosPostales" v-validate="'required'" :class="{ 'border border-danger': errors.has('localidad') || this.validacionesback.idLocalidad}" placeholder="Seleccione una localidad"></v-select>
                    <span v-show="errors.has('localidad')" class="text-danger">{{ errors.first('localidad')}}</span>
                    <span v-if="this.validacionesback.idLocalidad!=undefined" class="text-danger">{{ String(this.validacionesback.idLocalidad)}}</span>
                </div>



                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="codigoPostal">Código postal</label>    
                    <v-select :options="codigosPostales" label="codigoPostal" v-model="codigoPostal" name="codigoPostal" @input="getColonias"  v-validate="'required'" data-vv-name="código postal" :class="{ 'border border-danger': errors.has('código postal') || this.validacionesback.idCodigoPostal}" placeholder="Seleccione un código postal"></v-select>
                    <span v-show="errors.has('código postal')" class="text-danger">{{ errors.first('código postal') }}</span>
                    <span v-if="this.validacionesback.idCodigoPostal!=undefined" class="text-danger">{{ String(this.validacionesback.idCodigoPostal)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="colonia">Colonia</label>    
                    <v-select :options="colonias" label="nombre" v-model="colonia" name="colonia"  v-validate="'required'" :class="{ 'border border-danger': errors.has('colonia') || this.validacionesback.idColonia}" placeholder="Seleccione una colonia"></v-select>
                    <span v-show="errors.has('colonia')" class="text-danger">{{ errors.first('colonia')}}</span>
                    <span v-if="this.validacionesback.idColonia!=undefined" class="text-danger">{{ String(this.validacionesback.idColonia)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="calle">Calle</label>
                    <input type="text" name="calle" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('calle') || this.validacionesback.calle}" v-model="calle" placeholder="Ingrese la calle" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('calle')" class="text-danger">{{ errors.first('calle')}}</span>
                    <span v-if="this.validacionesback.calle!=undefined" class="text-danger">{{ String(this.validacionesback.calle)}}</span>
                </div>



                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="numExterno">Número externo</label>
                    <input type="text" data-vv-name="Número externo" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('Número externo') || this.validacionesback.numExterno}" v-model="numExterno" placeholder="Ingrese el número externo" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('Número externo')" class="text-danger">{{ errors.first('Número externo')}}</span>
                    <span v-if="this.validacionesback.numExterno!=undefined" class="text-danger">{{ String(this.validacionesback.numExterno)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="numInterno">Número interno</label>
                    <input type="text" name="numInterno" class="input form-control form-control-sm" v-model="numInterno" placeholder="Ingrese el número interno" autocomplete="off">
                </div>
                <div v-if="this.tipo!=''" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="input form-control form-control-sm" v-model="telefono" placeholder="Ingrese el teléfono" autocomplete="off">
                </div>



                <div v-if="tipo=='trabajo'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="lugarTrabajo">Lugar de trabajo</label>
                    <input type="text" name="lugarTrabajo" class="input form-control form-control-sm" v-model="lugarTrabajo" placeholder="Ingrese el lugar de trabajo" autocomplete="off">
                </div>
                <div v-if="tipo=='contacto'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="correo">Correo</label>
                    <input type="text" name="correo" class="input form-control form-control-sm" v-model="correo" placeholder="Ingrese el correo" autocomplete="off">
                </div>

            </div>
            <button type="submit" class="btn btn-primary mt-2">Guardar</button>

        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
import { SpringSpinner } from 'epic-spinners'
    export default {
        data(){
            return{
                estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
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
                numInterno: '',
                validacionesback:'',
                idDomicilio:'',
                loader:true,
                telefono:'',
                lugarTrabajo:'',
                correo:'',
                url:'/'
            }
        },
        props:{
            tipo:{
                default:''
            },
            empresa:{
                required:true
            }
        },
        components: {SpringSpinner},
        mounted: function () {
            this.getEstados()
        },
        methods:{
            getEstados: function(){
                var urlEstados = this.url+'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                    var self=this;
                    setTimeout(function(){ self.loader=false; }, 1100);                });
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    this.municipio=null,
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null
                    var urlMunicipios = this.url+'getMunicipios/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    this.municipio=null,
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null,
                    this.municipios=[],
                    this.localidades=[],
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getLocalidades: function(){
                if(this.municipio!=null){
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null
                    var urlLocalidades = this.url+'getLocalidades/'+this.municipio.id;
                    axios.get(urlLocalidades).then(response => {
                        this.localidades = response.data
                    });
                }
                else{
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null,
                    this.localidades=[],
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getCodigosPostales: function(){
                if(this.municipio!=null){
                    this.codigoPostal=null
                    this.colonia=null
                    var urlCodigosPostales = this.url+'getCodigosPostales/'+this.municipio.id;
                    axios.get(urlCodigosPostales).then(response => {
                        this.codigosPostales = response.data
                    });
                }
                else{
                    this.codigoPostal=null,
                    this.colonia=null
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getColonias: function(){
                if(this.codigoPostal!=null){
                    this.colonia=null
                    var urlColonias = this.url+'getColonias/'+this.codigoPostal.id;
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
                this.codigoPostal=null,
                this.colonia=null
                this.$validator.reset();
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearDomicilio();
                        return;
                    }
                    swal({
                        title: '¡Guardado Incorrecto!',
                        text: 'Éste domicilio no fue posible guardarse.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            crearDomicilio: function(){
                this.validacionesback='';
                var urlDomicilio = this.url+'addDomicilio';
                if(this.tipo==''){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase()
                    };
                }
                else if (this.tipo=='trabajo'){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase(),
                        telefonoTrabajo: this.telefono,
                        lugarTrabajo: this.lugarTrabajo.toUpperCase()
                    };
                }
                else if(this.tipo=='contacto'){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase(),
                        telefonoContacto: this.telefono,
                        correoContacto: this.correo.toUpperCase()
                    };
                }
                axios.post(urlDomicilio,data).then((response)=>{
                    this.idDomicilio = response.data
                    swal({
                        title: '¡Guardado Correctamente!',
                        text: 'Éste domicilio fue guardado exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.validacionesback = error.response.data.errors
                        swal({
                            title: '¡Guardado Incorrecto!',
                            text: 'Éste domicilio no fue posible guardarse.',
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
.dropdown-toggle{
    height: 36px;
    overflow: hidden;
}
input{
    text-transform: uppercase
}
input.form-control{
    width: 100% !important;
}
.dropdown{
    font-family: inherit;
    font-size: .875rem;
}
.centrar{
    position: absolute;
    top:50%;
    left:50%;
    margin-left: -30px;
    margin-top: -30px;
}
</style>