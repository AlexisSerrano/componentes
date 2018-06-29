<template>

    <div class="container-fluid">

        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">


                <div v-if="sistema=='uipj'" class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="puesto">Puesto</label>    
                    <v-select :options="puestos" label="nombre" v-model="puesto" name="puesto" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('puesto')|| this.validacionesback.puesto}" placeholder="Seleccione un puesto" @input="getPuestos"></v-select>
                    <span v-show="errors.has('puesto')" class="text-danger">{{ errors.first('puesto')}}</span>
                    <span v-if="this.validacionesback.puesto!=undefined" class="text-danger">{{ String(this.validacionesback.puesto)}}</span>
                </div>

                 <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="alias">Alias</label>                    
                    <input type="text" name="alias" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('alias')  || this.validacionesback.alias}" v-model="alias" placeholder="Ingrese el alias" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('alias')" class="text-danger">{{ errors.first('alias')}}</span>
                    <span v-if="this.validacionesback.alias!=undefined" class="text-danger">{{ String(this.validacionesback.alias)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="dependientes">Dependientes económicos</label>
                    <input type="number" name="dependientes" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('dependientes') || this.validacionesback.dependientes}" v-model="dependientes" placeholder="dependientes" v-validate="'required|numeric'">
                    <span v-show="errors.has('dependientes')" class="text-danger">{{ errors.first('dependientes')}}</span>
                    <span v-if="this.validacionesback.dependientes!=undefined" class="text-danger">{{ String(this.validacionesback.dependientes)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="ingreso">Ingreso</label>                    
                    <input type="text" name="ingreso" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('ingreso')  || this.validacionesback.ingreso}" v-model="ingreso" placeholder="Ingrese el ingreso" v-validate="'required|numeric'" autocomplete="off">
                    <span v-show="errors.has('ingreso')" class="text-danger">{{ errors.first('ingreso')}}</span>
                    <span v-if="this.validacionesback.ingreso!=undefined" class="text-danger">{{ String(this.validacionesback.ingreso)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="periodo">Periodo de ingreso</label>    
                    <v-select :options="periodos" label="nombre" v-model="periodo" name="periodo" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('periodo') || this.validacionesback.periodo}" placeholder="Seleccione un periodo" ></v-select>
                    <span v-show="errors.has('periodo')" class="text-danger">{{ errors.first('periodo')}}</span>
                    <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="residencia">Residencia anterior</label>
                    <input  class="form-control form-control-sm" type="text" name="residencia" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('residencia') || this.validacionesback.residencia}" v-model="residencia" placeholder="Ingrese la residencia" v-validate="'required'" autocomplete="off" >
                    <span v-show="errors.has('residencia')" class="text-danger">{{ errors.first('residencia')}}</span>
                    <span v-if="this.validacionesback.residencia!=undefined" class="text-danger">{{ String(this.validacionesback.residencia)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <div>
                        <label class="col-form-label col-form-label-sm" for="residencia">¿Perseguido penalmente?</label>
                    </div>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="perseguidoSi" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" v-model="perseguido" id="perseguidoSi" value="1" name="perseguido" v-validate="'required'">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="perseguidoNo" style="padding-right: 5px">No</label>
                            <input class="form-check-input" type="radio" v-model="perseguido" id="perseguidoNo" value="0" name="perseguido" v-validate="'required'">
                        </div>
                    </div>
                    <div>
                        <span v-show="errors.has('perseguido')" class="text-danger">{{ errors.first('perseguido')}}</span>
                        <span v-if="this.validacionesback.perseguido!=undefined" class="text-danger">{{ String(this.validacionesback.perseguido)}}</span>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="vestimenta">Vestimenta</label>
                    <input  class="form-control form-control-sm" type="text" name="vestimenta" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('vestimenta') || this.validacionesback.vestimenta}" v-model="vestimenta" placeholder="Ingrese la vestimenta" v-validate="'required'" autocomplete="off" >
                    <span v-show="errors.has('vestimenta')" class="text-danger">{{ errors.first('vestimenta')}}</span>
                    <span v-if="this.validacionesback.vestimenta!=undefined" class="text-danger">{{ String(this.validacionesback.vestimenta)}}</span>
                </div>

                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="particulares">Señas particulares</label>
                    <textarea class="form-control form-control-sm" name="particulares" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('particulares') || this.validacionesback.particulares}" v-model="particulares" placeholder="Ingrese el particulares" v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('particulares')" class="text-danger">{{ errors.first('particulares')}}</span>
                    <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <button type="submit" class="btn btn-primary mr-1">Guardar</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
             return{
                puesto: '',
                alias: '',
                dependientes:'',
                ingreso:'',
                periodo:'',
                residencia:'',
                perseguido:'',              
                vestimenta:'SIN INFORMACIÓN',
                particulares:'SIN INFORMACIÓN',
                hechos:'',
                idExtrasInvestigado:0,
                validacionesback:[],
                systemUser:'TEST',
                puestos:[],
                periodos:['DIARIO','SEMANAL','QUINCENAL','MENSUAL'],
                //url:'/api'
                url:'http://localhost/componentes/public/api'
            }
        },
        props:{
            sistema: {
                default:''
            },
            tipo:{
                required:true
            }
        },
        created: function(){
//            this.getPuestos();
        },
        methods:{
            getPuestos:function (){
                var urlPuestos = this.url+'/getPuestos';
                axios.post(urlPuestos).then(response => {
                    this.puestos = response.data
                });
                
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if(this.idExtrasInvestigado>0)
                            this.actualizarExtra();
                        else
                            this.guardarExtra();
                        return;
                    }
                    swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
            },
            guardarExtra: function(){
                var urlGuardarInvestigado = this.url;
                if(this.tipo=='fisica')
                    urlGuardarInvestigado +='/guardarExtrasInvestigadoFisico';
                else if(this.tipo=='moral')
                    urlGuardarInvestigado +='/guardarExtrasInvestigadoMoral';
                var data = {
                    idVariablesPersona:1,        
                    idNotificacion:0,            
                    idPuesto:(this.puesto!=''?this.puesto:9),
                    alias:this.alias.toUpperCase(),
                    personasBajoSuGuarda:this.dependientes,
                    ingreso:this.ingreso,
                    periodoIngreso:this.periodo,
                    residenciaAnterior:this.residencia.toUpperCase(),
                    perseguidoPenalmente:this.perseguido,              
                    vestimenta:this.vestimenta.toUpperCase(),
                    senasPartic:this.particulares.toUpperCase(),
                    sistema:this.sistema.toUpperCase(),
                    usuario:this.systemUser
                    };
                    axios.post(urlGuardarInvestigado,data)
                    .then (response =>{
                        this.confirm = response.data
                        if(this.confirm){
                            this.idExtrasInvestigado=this.confirm;
                            //this.CleanFields();
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            });
                        }
                        else{
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Error al guardar.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }).catch((error)=>{                        
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        });
                    });
            },
            actualizarExtra: function(){
                var urlGuardarInvestigado = this.url;
                if(this.tipo=='fisica')
                    urlGuardarInvestigado +='/actualizarExtrasInvestigadoFisico';
                else if(this.tipo=='moral')
                    urlGuardarInvestigado +='/actualizarExtrasInvestigadoMoral';
                var data = {
                    id:this.idExtrasInvestigado,        
                    idNotificacion:0,            
                    idPuesto:(this.puesto!=''?this.puesto:9),
                    alias:this.alias.toUpperCase(),
                    personasBajoSuGuarda:this.dependientes,
                    ingreso:this.ingreso,
                    periodoIngreso:this.periodo,
                    residenciaAnterior:this.residencia.toUpperCase(),
                    perseguidoPenalmente:this.perseguido,              
                    vestimenta:this.vestimenta.toUpperCase(),
                    senasPartic:this.particulares.toUpperCase(),
                    sistema:this.sistema.toUpperCase(),
                    usuario:this.systemUser
                    };
                    axios.post(urlGuardarInvestigado,data)
                    .then (response =>{
                        this.confirm = response.data
                        if(this.confirm){
                            this.idExtrasInvestigado=this.confirm;
                            //this.CleanFields();
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            });
                        }
                        else{
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Error al guardar.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }).catch((error)=>{                        
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        });
                    });
            },
            CleanFields() {
                this.puesto='',
                this.alias='',
                this.dependientes='',
                this.ingreso='',
                this.periodo='',
                this.residencia='',
                this.perseguido='',
                this.vestimenta='',
                this.particulares='',
                this.hechos='',
                this.$validator.reset();
            }
       }
    }
</script>
<style>
input,textarea{
    text-transform: uppercase
}
</style>