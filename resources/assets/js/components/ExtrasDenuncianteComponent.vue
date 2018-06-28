<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

<div class="form-row">
   <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="identidad">Identidad resguardada</label>    
        <v-select :options="ident" label="identidad" v-model="identidad" name="identidad" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('identidad')}" placeholder="Seleccione identidad"></v-select>
        <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>
        <!-- <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span> -->
    </div>

    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="solicitante">Tipo de solicitante</label>    
        <v-select :options="solicitantes" label="nombre" v-model="solicitante" name="solicitante" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('solicitante')}" placeholder="Seleccione tipo solicitante" ></v-select>
        <span v-show="errors.has('solicitante')" class="text-danger">{{ errors.first('solicitante')}}</span>
        <!-- <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span> -->
    </div>

   <!-- <div class="form-group col-md-12">
        <label class="col-form-label col-form-label-sm" for="descripcion">Descripcion de los hechos</label>
        <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcion')}" v-model="descripcion" placeholder="Ingrese la descripcion de los hechos" v-validate="'required'" autocomplete="off"></textarea>
        <span v-show="errors.has('descripcion')" class="text-danger">{{ errors.first('descripcion')}}</span>
        <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span>
    </div>-->

    <div class="form-row mt-3">
        <div class="form-group col-md-5">
            <button type="submit" class="btn btn-primary mr-1">Guardar</button>
        </div>
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
                ident:['NO','SI'],
                identidad:'',                
                solicitantes:['Víctima','Ofendido'],
                solicitante:'',
                descripcion:'',                
                url:'http://localhost/componentes/public/api',                
                idreturn:''
            }
        },
        props:{            
            tipo: {
                required:true
            },
            sistema: {
                default:''
            }        
        },
        created: function(){
//            this.getPuestos();
        },
        methods:{
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if(this.idreturn==''){                            
                            this.guardarExtra();
                        }else{                                                      
                            this.updateExtra();
                        }                                                
                    }else{
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                    }
        
                });
            },
            guardarExtra: function(){
                if(this.tipo=='fisica'){
                    var urlGuardarDenunciante = this.url+'/guardarExtrasDenuncianteFisico';
                }else if (this.tipo=='moral'){
                    var urlGuardarDenunciante = this.url+'/guardarExtrasDenuncianteMoral';                  
                }else{
                    return;
                }
                var data = {
                    idVariablesPersona:1,                    
                    idAbogado:1,
                    reguardarIdentidad:this.identidad,
                    victima: (this.solicitante=="Víctima" ? 1 : 0),
                    sistema:this.sistema.toUpperCase(),
                    usuario:'TEST'                                                                       
                    };
                    axios.post(urlGuardarDenunciante,data)
                    .then (response =>{
                        this.idreturn = response.data;
                        if(this.idreturn){                            
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            //limpiarCampos                                                        
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
            updateExtra: function(){
                
                if(this.tipo=='fisica'){
                    var urlGuardarDenunciante = this.url+'/updateExtrasDenuncianteFisico';
                }else if (this.tipo=='moral'){
                    var urlGuardarDenunciante = this.url+'/updateExtrasDenuncianteMoral';
                }else{
                    return;
                }                                
                var data = {
                    idVariablesPersona:this.idreturn,                    
                    idAbogado:1,
                    reguardarIdentidad:this.identidad,
                    victima: (this.solicitante=="Victima" ? 1 : 0),
                    sistema:this.sistema.toUpperCase(),
                    usuario:'TEST'                   
                    };
                    axios.post(urlGuardarDenunciante,data)
                    .then (response =>{
                        this.idreturn = response.data
                        if(this.idreturn){                            
                            swal({
                                title: '¡Actualizado correctamente!',
                                text: 'Ésta persona fue actualizada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            //limpiarCampos                                                        
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
                        text: 'No fue posible actualizar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        })
                    });
                
            },
            limpiarCampos:function(){
                this.solicitante="";
                this.descripcion="";
                this.identidad="";
            }
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>