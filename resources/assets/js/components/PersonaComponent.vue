<template>
    <div class="container mt-3">
        <div v-if="mostrarSearch" class="form-row align-items-end">
            <div class="form-group col-md-3">
                <label for="persona">Buscar Persona</label>
                <input type="text" class="form-control" id="persona" :value="persona" @input="persona = $event.target.value" placeholder="Ingrese el R.F.C o Curp">
            </div>
            <div class="form-group col-md-4">
                <button v-on:click="searchPersona" type="submit" class="btn mr-1">Buscar</button>
                <button v-on:click="mostrarForm=true,mostrarSearch=false" class="btn">Registrar Persona</button> 
            </div>
            <div class="form-group col-md-4">
            <h5>{{(Object.keys(this.personaExiste).length === 1)?personaExiste:''}}</h5>
            </div>
        </div>

        <form v-on:submit.prevent="crearPersona">

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-3">
                    <label for="nombres">Nombre</label>
                    <input type="text" class="form-control" id="nombres" :value="nombres" @input="nombres = $event.target.value" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group col-md-3">
                    <label for="primerAp">Primer Apellido</label>
                    <input type="text" class="form-control" id="primerAp" :value="primerAp" @input="primerAp = $event.target.value" placeholder="Ingrese el primer apellido">
                </div>
                <div class="form-group col-md-3">
                    <label for="segundoAp">Segundo Apellido</label>
                    <input type="text" class="form-control" id="segundoAp" :value="segundoAp" @input="segundoAp = $event.target.value" placeholder="Ingrese el segundo apellido">
                </div>
                <div class="form-group col-md-3">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento">
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-3">
                    <label for="sexo">Sexo</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="hombre" style="padding-right: 5px">Hombre</label>
                            <input class="form-check-input" type="radio" v-model="sexo" id="hombre" value="HOMBRE">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="mujer" style="padding-right: 5px">Mujer</label>
                            <input class="form-check-input" type="radio" v-model="sexo" id="mujer" value="MUJER">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="rfc">R.F.C</label>
                    <input type="text" class="form-control" id="rfc" :value="rfc" @input="rfc = $event.target.value" placeholder="R.F.C">
                </div>
                <div class="form-group col-md-3">
                    <label for="curp">Curp</label>
                    <input type="text" class="form-control" id="curp" :value="curp" @input="curp = $event.target.value" placeholder="Curp">
                </div>
                <div class="form-group col-md-3">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <v-select label="nombre" :options="nacionalidades" v-model="nacionalidad" placeholder="Seleccione una nacionalidad" class="select">                    </v-select>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Estados</label>    
                    <v-select label="nombre" :options="estados" v-model="estado" @input="getMunicipios" placeholder="Seleccione un estado" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipio de Origen</label>    
                    <v-select label="nombre" :options="municipios" v-model="municipio" placeholder="Seleccione un municipio" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="etnia">Etnia</label>    
                    <v-select label="nombre" :options="etnias" v-model="etnia" placeholder="Seleccione una etnia" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="lengua">Lengua</label>    
                    <v-select label="nombre" :options="lenguas" v-model="lengua" placeholder="Seleccione una lengua" class="select"></v-select>
                </div>
            </div>

            <div v-if="mostrarForm" class="form-row">
                <div class="form-group col-md-3">
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
                    <button v-on:click="mostrarForm=false,mostrarSearch=true" class="btn">Regresar a buscar</button> 
                </div>
            </div>
            <!-- <button v-if="mostrarForm" type="submit" class="btn">Guardar</button> -->
            <!-- <h1>{{(Object.keys(this.personaExiste).length === 1)?personaExiste:''}}</h1> -->
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
               nacionalidades: [],
               estados: [],
               municipios: [],
               etnias: [],
               lenguas: [],
               persona:'',
               personaExiste:'',
               nombres: '',
               primerAp: '',
               segundoAp: '',
               fechaNacimiento: '',
               prueba:'',
               sexo: '',
               rfc:'',
               curp: '',
               mostrarSearch:true,
               mostrarForm:false,
               nacionalidad:{ "nombre": "MEXICANA", "id": 1 },
               estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
               municipio:'',
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
                    sexo: this.sexo,
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
    color: #138c13
}
</style>