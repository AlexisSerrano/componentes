<template>
    <div class="container mt-3">
        <div v-if="mostrarSearch" class="form-row align-items-end">
            <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                <label for="persona">Buscar Persona</label>
                <input type="text" class="form-control" id="persona" :value="persona" @input="persona = $event.target.value" placeholder="Ingrese el R.F.C o Curp">
            </div>
            <div v-if="qrr==0 && conocido==0" class="form-group col-md-5">
                <button v-on:click="searchPersona" type="submit" class="btn mr-1">Buscar</button>
                <button v-on:click="mostrarForm=true,mostrarSearch=false, persona='',personaExiste=[]" class="btn">
                <img src="../../images/registro.svg" class="icons"> Registrar Persona</button> 
            </div>
            <div class="form-group col-md-4">
                <h5>{{(Object.keys(this.personaExiste).length === 1)?personaExiste[0].nombres+" "+personaExiste[0].primerAp+" "+personaExiste[0].segundoAp:''}}</h5>
            </div>
        </div>

        <form v-on:submit.prevent="validateBeforeSubmit" v-if="mostrarForm || qrr==true || conocido==true">

            <div class="form-row">
                <div v-if="qrr==0" class="form-group col-md-4">
                    <label for="nombres">Nombres</label>
                    <input v-if="nombresV" type="text" name="nombres" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombres') }" id="nombres" v-model="nombres" placeholder="Ingrese el nombre" v-validate="'required'">
                    <input v-else type="text" name="nombres" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombres') }" id="nombres" v-model="nombres" placeholder="Ingrese el nombre">
                    <span v-if="errors.has('nombres')" class="text-danger">{{ errors.first('nombres') }}</span>
                </div>
                <div v-if="qrr==0" class="form-group col-md-4">
                    <label for="primerAp">Primer Apellido</label>
                    <input v-if="primerApV" type="text" name="primerAp" data-vv-name="Primer Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Primer Apellido') }" id="primerAp" v-model="primerAp" placeholder="Ingrese el primer apellido" v-validate="'required'">
                    <input v-else type="text" name="primerAp" data-vv-name="Primer Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Primer Apellido') }" id="primerAp" v-model="primerAp" placeholder="Ingrese el primer apellido">
                    <span v-if="errors.has('Primer Apellido')" class="text-danger">{{ errors.first('Primer Apellido') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="segundoAp">Segundo Apellido</label>
                    <input v-if="segundoApV" type="text" name="segundoAp" data-vv-name="Segundo Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Segundo Apellido') }" id="segundoAp" v-model="segundoAp" placeholder="Ingrese el segundo apellido" v-validate="'required'">
                    <input v-else type="text" name="segundoAp" data-vv-name="Segundo Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Segundo Apellido') }" id="segundoAp" v-model="segundoAp" placeholder="Ingrese el segundo apellido">
                    <span v-if="errors.has('Segundo Apellido')" class="text-danger">{{ errors.first('Segundo Apellido') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input v-if="fechaNacimientoV" type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento" name="fechaNacimiento" data-vv-name="Fecha de Nacimiento" v-validate="'required'" :class="{ 'border border-danger': errors.has('Fecha de Nacimiento') }">
                    <input v-else type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento" name="fechaNacimiento" data-vv-name="Fecha de Nacimiento" :class="{ 'border border-danger': errors.has('Fecha de Nacimiento') }">
                    <span v-show="errors.has('Fecha de Nacimiento')" class="text-danger">{{ errors.first('Fecha de Nacimiento') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="sexos">Sexo</label>    
                    <v-select v-if="sexoV" :options="sexos" label="nombre" v-model="sexo" name="sexo" v-validate="'required'" :class="{ 'border border-danger': errors.has('sexo') }" placeholder="Seleccione un sexo"></v-select>
                    <v-select v-else :options="sexos" label="nombre" v-model="sexo" name="sexo" :class="{ 'border border-danger': errors.has('sexo') }" placeholder="Seleccione un sexo"></v-select>
                    <span v-show="errors.has('sexo')" class="text-danger">{{ errors.first('sexo') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="rfc">R.F.C</label>
                    <input v-if="rfcV" type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') }" id="rfc" v-model="rfc" placeholder="Ingrese el rfc" v-validate="'required'">
                    <input v-else type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') }" id="rfc" v-model="rfc" placeholder="Ingrese el rfc">
                    <span v-if="errors.has('rfc')" class="text-danger">{{ errors.first('rfc') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="curp">Curp</label>
                    <input v-if="curpV" type="text" name="curp" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('curp') }" id="curp" v-model="curp" placeholder="Ingrese el curp" v-validate="'required'">
                    <input v-else type="text" name="curp" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('curp') }" id="curp" v-model="curp" placeholder="Ingrese el curp">
                    <span v-if="errors.has('curp')" class="text-danger">{{ errors.first('curp') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <v-select v-if="nacionalidadV" :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" v-validate="'required'" :class="{ 'border border-danger': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <v-select v-else :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" :class="{ 'border border-danger': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <span v-show="errors.has('nacionalidad')" class="text-danger">{{ errors.first('nacionalidad') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select v-if="estadoV" :options="estados" label="nombre" data-vv-name="Entidad Federativa" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('Entidad Federativa') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <v-select v-else :options="estados" label="nombre" data-vv-name="Entidad Federativa" v-model="estado" name="estado" @input="getMunicipios" :class="{ 'border border-danger': errors.has('Entidad Federativa') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <span v-show="errors.has('Entidad Federativa')" class="text-danger">{{ errors.first('Entidad Federativa') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="municipio">Municipio de Origen</label>    
                    <v-select v-if="municipioV" :options="municipios" label="nombre" v-model="municipio" name="municipio" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') }" placeholder="Seleccione un municipio"></v-select>
                    <v-select v-else :options="municipios" label="nombre" v-model="municipio" name="municipio" :class="{ 'border border-danger': errors.has('municipio') }" placeholder="Seleccione un municipio"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio') }}</span>
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="etnia">Etnia</label>    
                    <v-select v-if="etniaV" label="nombre" :options="etnias" v-model="etnia" name="etnia" v-validate="'required'" :class="{ 'border border-danger': errors.has('etnia') }" placeholder="Seleccione una etnia" class="select"></v-select>
                    <v-select v-else label="nombre" :options="etnias" v-model="etnia" name="etnia" :class="{ 'border border-danger': errors.has('etnia') }" placeholder="Seleccione una etnia" class="select"></v-select>
                    <span v-show="errors.has('etnia')" class="text-danger">{{ errors.first('etnia') }}</span> 
                </div>
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
                    <label for="lengua">Lengua</label>    
                    <v-select v-if="lenguaV" label="nombre" :options="lenguas" v-model="lengua" name="lengua" v-validate="'required'" :class="{ 'border border-danger': errors.has('lengua') }" placeholder="Seleccione una lengua" class="select"></v-select>
                    <v-select v-else label="nombre" :options="lenguas" v-model="lengua" name="lengua" :class="{ 'border border-danger': errors.has('lengua') }" placeholder="Seleccione una lengua" class="select"></v-select>
                    <span v-show="errors.has('lengua')" class="text-danger">{{ errors.first('lengua') }}</span> 
                </div>
            </div>

            <div class="form-row">
                <div v-if="qrr==0 && conocido==0" class="form-group col-md-4">
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
            <div class="form-row">
                <div class="form-group col-md-5">
                    <button type="submit" class="btn mr-1">Guardar</button>
                    <button v-if="qrr==0 && conocido==0" type="button" v-on:click="mostrarForm=false,mostrarSearch=true" class="btn">
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
                esEmpresa: '',
                nombresV:false,
                primerApV:false,
                segundoApV:false,
                fechaNacimientoV:false,
                sexoV:false,
                rfcV:false,
                curpV:false,
                nacionalidadV:false,
                estadoV:false,
                municipioV:false,
                etniaV:false,
                lenguaV:false,
                esEmpresaV:false,
                validaciones:[],
            }
        },

        // props: ['sistema','tipo'],
        props:{
            sistema: {
                default:5
            },
            tipo: {
                default:5
            },
            qrr: {
                default:false
            },
            conocido: {
                default:false
            }
        },

        mounted: function(){
           this.getNacionalidades();
           this.getEstados();
           this.getEtnias();
           this.getLenguas();
           this.getSexos();
           this.getValidaciones();
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
            getSexos: function(){
                var urlSexos = 'getSexos';
                axios.get(urlSexos).then(response => {
                    this.sexos = response.data
                });
            },
            getValidaciones: function(){
                var urlValidaciones = 'getValidaciones/'+this.sistema+'/'+this.tipo;
                axios.get(urlValidaciones).then(response => {
                    // this.validaciones = response.data,
                    // this.nombresV=this.validaciones.nombresV,
                    // this.primerApV=this.validaciones.primerApV,
                    // this.segundoApV=this.validaciones.segundoApV,
                    // this.fechaNacimientoV=this.validaciones.fechaNacimientoV,
                    // this.sexoV=this.validaciones.sexoV,
                    // this.rfcV=this.validaciones.sexoV,
                    // this.curpV=this.validaciones.curpV,
                    // this.nacionalidadV=this.validaciones.nacionalidadV,
                    // this.estadoV=this.validaciones.estadoV,
                    // this.municipioV=this.validaciones.municipioV,
                    // this.etniaV=this.validaciones.etniaV,
                    // this.lenguaV=this.validaciones.lenguaV,
                    // this.esEmpresaV=this.validaciones.esEmpresaV
                    this.validaciones = response.data,
                    this.nombresV=this.validaciones,
                    this.primerApV=this.validaciones,
                    this.segundoApV=this.validaciones,
                    this.fechaNacimientoV=this.validaciones,
                    this.sexoV=this.validaciones,
                    this.rfcV=this.validaciones,
                    this.curpV=this.validaciones,
                    this.nacionalidadV=this.validaciones,
                    this.estadoV=this.validaciones,
                    this.municipioV=this.validaciones,
                    this.etniaV=this.validaciones,
                    this.lenguaV=this.validaciones,
                    this.esEmpresaV=this.validaciones
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearPersona();
                        this.CleanFields();
                        swal({
                            title: 'Guardado Correctamente!',
                            text: 'Esta persona fue guardada exitosamente',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                        return;
                    }
                    swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Esta persona no fue posible guardarla',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            CleanFields() {
                this.nacionalidad={ "nombre": "MEXICANA", "id": 1 },
                this.estado={ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                this.municipio=null,
                this.etnia={ "nombre": "SIN INFORMACIÓN", "id": 13 },
                this.lengua={ "nombre": "SIN INFORMACIÓN", "id": 69 },
                this.nombres='',
                this.primerAp='',
                this.segundoAp='',
                this.fechaNacimiento='',
                this.sexo=null,
                this.rfc='',
                this.curp='',
                this.esEmpresa=''
                this.$validator.reset();
            },
            crearPersona: function(){
                var urlCrearPersona = 'addPersona';
                if(this.qrr==false && this.conocido==false){
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
                    })
                }
                else if(this.qrr==false && this.conocido==true){
                    axios.post(urlCrearPersona,{
                        nombres: this.nombres,
                        primerAp: this.primerAp
                    })   
                }
                else if(this.qrr==1){
                    axios.post(urlCrearPersona,{
                        qrr: this.qrr
                    }) 
                }
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