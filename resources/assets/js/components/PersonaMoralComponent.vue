<template>

    <div class="container-fluid">

        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">

                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nombre">Nombre</label>
                    <input  class="form-control form-control-sm" type="text" name="nombre" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombre') || this.validacionesback.nombre}" v-model="nombre" placeholder="Ingrese el nombre" v-validate="'required'" autocomplete="off" @blur="calcularRfc" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre')}}</span>
                    <span v-if="this.validacionesback.nombre!=undefined" class="text-danger">{{ String(this.validacionesback.nombre)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="fechaCreacion">Fecha de creación</label>
                    <input class="form-control form-control-sm" type="date" v-model="fechaCreacion" name="fechaCreacion" data-vv-name="fecha de creación" v-validate="'date_format:YYYY-MM-DD|before:' + today" :class="{ 'border border-danger': errors.has('fecha de creación') || this.validacionesback.fechaCreacion}" @blur="calcularRfc" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('fecha de creación')" class="text-danger">{{ errors.first('fecha de creación')}}</span>
                    <span v-if="this.validacionesback.fechaCreacion!=undefined" class="text-danger">{{ String(this.validacionesback.fechaCreacion)}}</span>
                </div>
                <div class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="rfc">RFC</label>
                    <input type="text" name="rfc" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('rfc') || this.validacionesback.rfc}" v-model="rfc" placeholder="Ingrese el RFC" v-validate="'required'" autocomplete="off" @blur="searchPersona" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('rfc')" class="text-danger">{{ errors.first('rfc')}}</span>
                    <span v-if="this.validacionesback.rfc!=undefined" class="text-danger">{{ String(this.validacionesback.rfc)}}</span>
                </div>
                <div class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="homoclave">Homoclave</label>
                    <input type="text" name="homoclave" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('homoclave') || this.validacionesback.homo}" v-model="homoclave" placeholder="Homoclave" v-validate="'required'" autocomplete="off" @blur="searchPersona" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('homoclave')" class="text-danger">{{ errors.first('homoclave')}}</span>
                    <span v-if="this.validacionesback.homo!=undefined" class="text-danger">{{ String(this.validacionesback.homo)}}</span>
                </div>



                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="telefono">Teléfono</label>
                    <input class="form-control form-control-sm" type="text" name="teléfono" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('teléfono') || this.validacionesback.telefono}" v-model="telefono" placeholder="Ingrese el teléfono" v-validate="'required|numeric'" autocomplete="off">
                    <span v-show="errors.has('teléfono')" class="text-danger">{{ errors.first('teléfono')}}</span>
                    <span v-if="this.validacionesback.telefono!=undefined" class="text-danger">{{ String(this.validacionesback.telefono)}}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="representanteLegal">Representante legal</label>
                    <input class="form-control form-control-sm" type="text" name="representanteLegal" data-vv-name="representante legal" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('representante legal') || this.validacionesback.representanteLegal}" v-model="representanteLegal" placeholder="Ingrese el representante legal" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('representante legal')" class="text-danger">{{ errors.first('representante legal')}}</span>
                    <span v-if="this.validacionesback.representanteLegal!=undefined" class="text-danger">{{ String(this.validacionesback.representanteLegal)}}</span>
                </div>

            </div>


            <button type="submit" class="btn btn-primary mt-2">{{botonGuardarModificar}}</button>



        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
import moment from 'moment'
import { mapState } from "vuex";
    export default {
        data(){
             return{
                today: moment().format('YYYY-MM-DD'),
                nombre: '',
                fechaCreacion: '',
                rfc:'',
                homoclave:'',
                telefono:'',
                representanteLegal:'',
                personaExiste:'',              
                validacionesback:'',
                systemUser:'TEST',
                url:'./api'
            }
        },
        props:{
            sistema: {
                default:false
            },
            tipo: {
                default:false
            },
            carpeta:{
                default:''
            } 
        },
        mounted: function(){
        //    this.getNacionalidades();
        },
        methods:{
            searchPersona: function(){
                if(this.$store.state.moralEncontrada==true){return}
                if(this.rfc.length==9 && this.homoclave.length==3){
                    var urlBuscarPersona = this.url+'/searchPersonaMoral';
                    this.buscarCarpetasMoral()
                    axios.post(urlBuscarPersona,{
                        rfc: this.rfc+this.homoclave
                    }).then(response => {
                        this.personaExiste=response.data
                        if(this.personaExiste!=''){          
                            this.$store.commit('asignarIdMoral',{idPersona:'', tipo:this.tipo ,moralEncontrada:true})                             
                            swal({
                                title: '¡Persona moral encontrada!',
                                text: 'Ésta persona moral ya fue registrada anteriormente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            this.nombre = this.personaExiste.nombre,
                            this.fechaCreacion = this.personaExiste.fechaCreacion,
                            this.rfc=this.personaExiste.rfc.slice(0,-3),
                            this.homoclave = this.personaExiste.rfc.slice(-3),
                            this.telefono = this.personaExiste.telefono,
                            this.representanteLegal = this.personaExiste.representanteLegal
                        }
                    });
                }
            },
            calcularRfc(){
                if(this.nombre!='' && this.fechaCreacion!=''){
                    if(this.nombre.length<2){
                        swal({
                            title: '¡Ingrese otro nombre!',
                            text: 'Para calcular el rfc el nombre debe contener mas caracteres.',
                            type: 'warning',
                            confirmButtonText: 'Ok'
                        })
                        return
                    }
                    var urlRfcMoral = this.url+'/rfcMoral';
                    axios.post(urlRfcMoral,{
                        nombre: this.nombre,
                        fechaCreacion: this.fechaCreacion
                    }).then(response =>{
                        this.rfc = response.data.res.slice(0, -3);                        
                        this.homoclave=response.data.res.slice(-3);
                        this.searchPersona();
                    });
                }
            },
            buscarCarpetasMoral:function(){
                var post = this.url+'/moralCarpetasRfc';
                axios.post(post,{
                    rfc:this.rfc+this.homoclave,                       
                }).then(response =>{
                    if(response.data){
                            this.$store.commit('asignarCarpetasLigadas',{carpetas:response.data,tipo:'moral'})
                        // swal({
                        //     title: 'Hay carpteas ligadas a esta persona!',
                        //     text: 'Existen carpetas.',
                        //     type: 'success',
                        //     confirmButtonText: 'Ok'
                        // })
                    }
                });
            },
            getDomicilios(){
                var urlGetDomicilios=this.url+'/getDomiciliosPersonaMoral'
                axios.post(urlGetDomicilios, {
                    rfc:this.rfc+this.homoclave                      
                })
                .then((response) =>{
                    console.log(response.data)
                    if(response.data){
                        this.$store.commit('asignarDomicilios',response.data)
                    }
                })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.CrearEmpresa();
                        return;
                    } 
                    swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta empresa no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            CleanFields() {
                this.nombre='',
                this.fechaCreacion='',
                this.rfc='',
                this.homoclave='',
                this.telefono='',
                this.representanteLegal='',
                this.$validator.reset();
            },
            CrearEmpresa: function(){
                this.validacionesback='';
                var urlCrearMoral = this.url+'/'+this.tipo+this.sistema;
                    axios.post(urlCrearMoral,{                        
                        nombre: this.nombre.toUpperCase(),
                        fechaCreacion: this.fechaCreacion,
                        rfc:this.rfc,
                        homo:this.homoclave,
                        telefono: this.telefono,
                        representanteLegal: this.representanteLegal.toUpperCase(),
                        sistema: this.sistema,
                        tipo: this.tipo,
                        idCarpeta:this.carpeta,
                        idPersona:this.$store.state.idPersonaMoral,
                        usuario:this.systemUser
                    })
                    .then (response =>{
                        this.$store.commit('asignarIdMoral',{idPersona:response.data,tipo:this.tipo})
                        swal({
                            title: '¡Guardado correctamente!',
                            text: 'Ésta empresa fue guardada exitosamente.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                        if(this.$store.state.moralEncontrada){
                            this.getDomicilios()
                        }
                    }).catch((error)=>{
                        this.validacionesback = error.response.data.errors
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona moral no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        })
                    });
            }
       },
       watch: {
            idPersonaFisica() {
                if(this.$store.state.idPersonaFisica!=''){
                    this.CleanFields();
                }
            },
            moralEncontrada(){
            if(this.$store.state.moralEncontrada==''){this.CleanFields()}
            },
            idPersonaMoral(){
                (this.$store.state.idPersonaMoral=='')?this.CleanFields():''
            }
       },
       computed: Object.assign({
        botonGuardarModificar(){
             if(this.$store.state.idPersonaMoral==''){
                 return 'Guardar'
             }
             else{
                 return 'Modificar'
             }
         }  
       },mapState(['idPersonaFisica','idPersonaMoral','moralEncontrada']))
    //    computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>