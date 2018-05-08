<template>
    <div class="container mt-3">
        <div v-if="mostrarSearch" class="form-row align-items-end">
            <div class="form-group col-md-4">
                <label for="persona">Buscar Persona</label>
                <input type="text" class="form-control" id="persona" :value="persona" @input="persona = $event.target.value" placeholder="Ingrese el R.F.C o Curp">
            </div>
            <div class="form-group col-md-5">
                <button v-on:click="searchPersona" type="submit" class="btn mr-1">Buscar</button>
                <button v-on:click="mostrarForm=true,mostrarSearch=false, persona='',personaExiste=[]" class="btn">
                <img src="../../images/registro.svg" class="icons"> Registrar Persona</button> 
            </div>
            <div class="form-group col-md-4">
                <h5>{{(Object.keys(this.personaExiste).length === 1)?personaExiste[0].nombres+" "+personaExiste[0].primerAp+" "+personaExiste[0].segundoAp:''}}</h5>
            </div>
        </div>

        <form v-on:submit.prevent="crearPersona">

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombres') }" id="nombres" v-model="nombres" placeholder="Ingrese el nombre" v-validate="'required'">
                    <span v-if="errors.has('nombres')" class="text-danger">{{ errors.first('nombres') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="primerAp">Primer Apellido</label>
                    <input type="text" name="primerAp" data-vv-name="Primer Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Primer Apellido') }" id="primerAp" v-model="primerAp" placeholder="Ingrese el primer apellido" v-validate="'required'">
                    <span v-if="errors.has('Primer Apellido')" class="text-danger">{{ errors.first('Primer Apellido') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="segundoAp">Segundo Apellido</label>
                    <input type="text" name="segundoAp" data-vv-name="Segundo Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Segundo Apellido') }" id="segundoAp" v-model="segundoAp" placeholder="Ingrese el segundo apellido" v-validate="'required'">
                    <span v-if="errors.has('Segundo Apellido')" class="text-danger">{{ errors.first('Segundo Apellido') }}</span>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-4">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento">
                </div>
                <div class="form-group col-md-4">
                    <label for="sexos">Sexo</label>    
                    <v-select :options="sexos" label="nombre" v-model="sexo" name="sexo" v-validate="'required'" :class="{ 'border border-danger': errors.has('sexo') }" placeholder="Seleccione un sexo"></v-select>
                    <span v-show="errors.has('sexo')" class="text-danger">{{ errors.first('sexo') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">R.F.C</label>
                    <!-- <input type="text" class="form-control" id="rfc" :value="rfc" @input="rfc = $event.target.value" placeholder="R.F.C"> -->
                    <input type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') }" id="rfc" v-model="rfc" placeholder="Ingrese el rfc" v-validate="'required'">
                    <span v-if="errors.has('rfc')" class="text-danger">{{ errors.first('rfc') }}</span>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-4">
                    <label for="curp">Curp</label>
                    <input type="text" name="curp" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('curp') }" id="curp" v-model="curp" placeholder="Ingrese el curp" v-validate="'required'">
                    <span v-if="errors.has('curp')" class="text-danger">{{ errors.first('curp') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <v-select :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" v-validate="'required'" :class="{ 'border border-danger': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <span v-show="errors.has('nacionalidad')" class="text-danger">{{ errors.first('nacionalidad') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select :options="estados" label="nombre" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('estado') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <span v-show="errors.has('estado')" class="text-danger">{{ errors.first('estado') }}</span>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-4">
                    <label for="municipio">Municipio de Origen</label>    
                    <v-select :options="municipios" label="nombre" v-model="municipio" name="municipio" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') }" placeholder="Seleccione un municipio"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="etnia">Etnia</label>    
                    <v-select label="nombre" :options="etnias" v-model="etnia" placeholder="Seleccione una etnia" class="select"></v-select>
                </div>
                <div class="form-group col-md-4">
                    <label for="lengua">Lengua</label>    
                    <v-select label="nombre" :options="lenguas" v-model="lengua" placeholder="Seleccione una lengua" class="select"></v-select>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-4">
                    <label for="esEmpresa">Es Empresa</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="si" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" v-model="esEmpresa" id="si" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="no" style="padding-right: 5px">No</label>
                        <input class="form-check-input" type="radio" v-model="esEmpresa" id="no" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="mostrarForm" class="form-row">
                <div v-if="mostrarForm" class="form-group col-md-5">
                    <button type="submit" class="btn mr-1">Guardar</button>
                    <button v-on:click="mostrarForm=false,mostrarSearch=true" class="btn">
                    <img src="../../images/flecha.svg" class="icons"> Regresar a buscar</button> 
                </div>
            </div>
            <!-- <button v-if="mostrarForm" type="submit" class="btn">Guardar</button> -->
            <!-- <h1>{{(Object.keys(this.personaExiste).length === 1)?personaExiste:''}}</h1> -->
        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
       data(){
           return{
               nacionalidades: [],
               estados: [],
               municipios: [],
               etnias: [],
               lenguas: [],
               sexos: [],
               persona:'',
               personaExiste:'',
               nombres: '',
               primerAp: '',
               segundoAp: '',
               fechaNacimiento: '',
               prueba:'',
               sexo:null,
               rfc:'',
               curp: '',
               mostrarSearch:true,
               mostrarForm:false,
               nacionalidad:{ "nombre": "MEXICANA", "id": 1 },
               estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
               municipio:null,
               etnia:{ "nombre": "SIN INFORMACIÓN", "id": 13 },
               lengua:{ "nombre": "SIN INFORMACIÓN", "id": 69 },
               esEmpresa: ''
           }
       },

    //    PROBANDO PROPS
    //    props:{
    //        mostrarForm: {
    //            default:false
    //        }
    //    },
    
       mounted: function(){
           this.getNacionalidades();
           this.getEstados();
           this.getEtnias();
           this.getLenguas();
           this.getSexos();
       },
        methods:{
            searchPersona: function(){
                if(this.persona!=''){
                    var urlBuscarPersona = 'searchPersona/'+this.persona;
                    axios.get(urlBuscarPersona,{
                        persona: this.persona
                    }).then(response => {
                        this.personaExiste=response.data;
                        if(Object.keys(this.personaExiste).length === 1){
                            swal({
                                title: 'Persona Encontrada!',
                                text: 'Esta persona ya fue registrada anteriormente',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            this.mostrarForm=false;
                        }
                        else{
                            swal({
                                title: 'Persona No Encontrada!',
                                text: 'Esta persona no a sido registrada, favor de intentar de nuevo o registrarla',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    })
                }
                else{
                    swal({
                        title: 'No ha ingresado información!',
                        text: 'Ingrese un R.F.C o Curp',
                        type: 'warning',
                        confirmButtonText: 'Ok'
                    })
                }
                this.persona=''
            },
            getNacionalidades: function(){
                var urlNacionalidades = 'getNacionalidades';
                axios.get(urlNacionalidades).then(response => {
                    this.nacionalidades = response.data
                });
            },
            getEstados: function(){
                var urlEstados = 'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    this.municipio=null
                    var urlMunicipios = 'getMunicipios/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    this.municipio=null,
                    this.municipios=[]
                }
            },
            getEtnias: function(){
                var urlEtnias = 'getEtnias';
                axios.get(urlEtnias).then(response => {
                    this.etnias = response.data
                });
            },
            getLenguas: function(){
                var urlLenguas = 'getLenguas';
                axios.get(urlLenguas).then(response => {
                    this.lenguas = response.data
                });
            },
            getSexos: function(){
                var urlSexos = 'getSexos';
                axios.get(urlSexos).then(response => {
                    this.sexos = response.data
                });
            },
            getPersonas: function(){
                var urlPersonas = 'getPersonas';
                axios.get(urlPersonas).then(response => {
                    this.personas = response.data
                });
            },
            crearPersona: function(){
                var urlCrearPersona = 'addPersona';
                axios.post(urlCrearPersona,{
                    nombres: this.nombres,
                    primerAp: this.primerAp,
                    segundoAp: this.segundoAp,
                    fechaNacimiento: this.fechaNacimiento,
                    sexo: this.sexo.id,
                    rfc:this.rfc,
                    curp: this.curp,
                    nacionalidad: this.nacionalidad.id,
                    municipio: this.municipio.id,
                    etnia: this.etnia.id,
                    lengua: this.lengua.id,
                    esEmpresa: this.esEmpresa
                }).then(response => {
                    this.nacionalidad=null,
                    this.estado=null,
                    this.municipio=null,
                    this.etnia=null,
                    this.lengua=null,
                    this.nombres='',
                    this.primerAp='',
                    this.segundoAp='',
                    this.fechaNacimiento='',
                    this.sexo='',
                    this.rfc='',
                    this.curp='',
                    this.esEmpresa=''
                    swal({
                        title: 'Guardado Correctamente!',
                        text: 'Esta persona fue guardada exitosamente',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    })
                }).catch(error => {
                     swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Esta persona no fue posible guardarla',
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
h5{
    color: #138c13;
}
.icons{
    height: 1rem;
    margin-bottom: 3px;
}
</style>