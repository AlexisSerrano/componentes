<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

<div class="form-row">
   <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="identidad">Identidad resguardada</label>    
        <v-select :options="ident" label="identidad" v-model="identidad" name="identidad" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('identidad')}"></v-select>
        <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>
        <!-- <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span> -->
    </div>

    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="tipoSolicitante">Tipo de solicitante</label>    
        <v-select :options="solicitantes" label="nombre" v-model="tipoSolicitante" name="tipoSolicitante" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('tipoSolicitante')}" ></v-select>
        <span v-show="errors.has('tipoSolicitante')" class="text-danger">{{ errors.first('tipoSolicitante')}}</span>
        <!-- <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span> -->
    </div>

    <div class="form-group col-md-12">
        <label class="col-form-label col-form-label-sm" for="descripcionHechos">Descripcion de los hechos</label>
        <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcionHechos" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcionHechos')}" v-model="descripcionHechos" placeholder="Ingrese la descripcion de los hechos" v-validate="'required'" autocomplete="off"></textarea>
        <span v-show="errors.has('descripcionHechos')" class="text-danger">{{ errors.first('descripcionHechos')}}</span>
        <!-- <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span> -->
    </div>

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
                ident:['No','Si'],
                identidad:'',                
                solicitantes:['Victima','Ofendido'],
                tipoSolicitante:'',
                descripcionHechos:'',                
                url:'http://localhost/componentes/public/api',
                confirm:''
            }
        },
        props:{
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
                        this.guardarExtra();
                        return;
                    }
                    swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Éror al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
            },
            guardarExtra: function(){  
                var urlGuardarDenunciante = this.url+'/guardarDenunciante';                
                var data = {
                    idVariablesPersona:1,                    
                    idNotificacion:1,
                    idAbogado:0,
                    victima: (this.tipoSolicitante=="Victima" ? 1 : 0),
                    reguardarIdentidad:this.identidad,
                    narracion: this.descripcionHechos
                    };
                    axios.post(urlGuardarDenunciante,data)
                    .then (response =>{
                        this.confirm = response.data
                        if(this.confirm){
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                        }
                        else{
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Éror al guardar.',
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
                
            }
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>