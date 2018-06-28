<template>

    <div class="container-fluid">

        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">


                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="tipo">Tipo</label>    
                    <v-select :options="tipos" label="nombre" v-model="tipo" name="tipo" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('tipo')|| this.validacionesback.tipo}" placeholder="Seleccione un tipo"></v-select>
                    <span v-show="errors.has('tipo')" class="text-danger">{{ errors.first('tipo')}}</span>
                    <span v-if="this.validacionesback.tipo!=undefined" class="text-danger">{{ String(this.validacionesback.tipo)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="sector">Sector</label>    
                    <v-select :options="sectores" label="nombre" v-model="sector" name="sector" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('sector')|| this.validacionesback.sector}" placeholder="Seleccione un sector"></v-select>
                    <span v-show="errors.has('sector')" class="text-danger">{{ errors.first('sector')}}</span>
                    <span v-if="this.validacionesback.sector!=undefined" class="text-danger">{{ String(this.validacionesback.sector)}}</span>
                </div>

                 <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="cedula">Cédula profesional</label>                    
                    <input type="text" name="cedula" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('cedula')  || this.validacionesback.cedula}" v-model="cedula" placeholder="Ingrese el cedula" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('cedula')" class="text-danger">{{ errors.first('cedula')}}</span>
                    <span v-if="this.validacionesback.cedula!=undefined" class="text-danger">{{ String(this.validacionesback.cedula)}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="correo">Correo</label>                    
                    <input type="text" name="correo" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('correo')  || this.validacionesback.correo}" v-model="correo" placeholder="Ingrese el correo" v-validate="'required|email'" autocomplete="off">
                    <span v-show="errors.has('correo')" class="text-danger">{{ errors.first('correo')}}</span>
                    <span v-if="this.validacionesback.correo!=undefined" class="text-danger">{{ String(this.validacionesback.correo)}}</span>
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
                tipo: '',
                sector: '',
                cedula:'',
                correo:'',
                idExtrasAbogado:0,
                validacionesback:[],
                systemUser:'TEST',
                tipos:['ASESOR JURIDICO', 'ABOGADO DEFENSOR'],
                sectores:['PÚBLICO','PARTICULAR'],
                //url:'/api'
                url:'http://localhost/componentes/public/api'
            }
        },
        props:{
            sistema: {
                default:''
            }
        },
        methods:{
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                   if (result) {
                        if(this.idExtrasAbogado>0)
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
                var urlGuardarAbogado = this.url+'/guardarExtrasAbogado';       
                var data = {
                    idVariablesPersona:1,        
                    cedulaProf:this.cedula.toUpperCase(),
                    sector:this.sector,
                    correo:this.correo,
                    tipo:this.tipo,
                    sistema:this.sistema.toUpperCase(),
                    usuario:this.systemUser
                };
                    axios.post(urlGuardarAbogado,data)
                    .then (response =>{
                        this.confirm = response.data
                        if(this.confirm){
                            this.idExtrasAbogado=this.confirm;
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
                            })
                        }
                    }).catch((error)=>{    
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        })
                    });
                
            },
            actualizarExtra: function(){
                var urlGuardarAbogado = this.url+'/actualizarExtrasAbogado';                
                var data = {
                    id:this.idExtrasAbogado,
                    cedulaProf:this.cedula.toUpperCase(),
                    sector:this.sector,
                    correo:this.correo,
                    tipo:this.tipo,
                    sistema:this.sistema.toUpperCase(),
                    usuario:this.systemUser
                };
                    axios.post(urlGuardarAbogado,data)
                    .then (response =>{
                        this.confirm = response.data
                        if(this.confirm){
                            this.idExtrasAbogado=this.confirm;
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
                this.cedula='',
                this.sector='',
                this.correo='',
                this.tipo='',
                this.$validator.reset();
            }
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>