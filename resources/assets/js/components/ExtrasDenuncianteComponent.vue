<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

<div class="form-row">
   <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="identidad">Identidad resguardada</label>    
        <v-select :options="ident" label="identidad" v-model="identidad" name="identidad" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('identidad') || this.validacionesback.periodo}"></v-select>
        <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>
        <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span>
    </div>

    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="tipoSolicitante">Tipo de solicitante</label>    
        <v-select :options="solicitantes" label="nombre" v-model="tipoSolicitante" name="tipoSolicitante" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('tipoSolicitante') || this.validacionesback.periodo}" ></v-select>
        <span v-show="errors.has('tipoSolicitante')" class="text-danger">{{ errors.first('tipoSolicitante')}}</span>
        <span v-if="this.validacionesback.periodo!=undefined" class="text-danger">{{ String(this.validacionesback.periodo)}}</span>
    </div>

    <div class="form-group col-md-12">
        <label class="col-form-label col-form-label-sm" for="descripcionHechos">Descripcion de los hechos</label>
        <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcionHechos" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcionHechos') || this.validacionesback.particulares}" v-model="descripcionHechos" placeholder="Ingrese la descripcion de los hechos" v-validate="'required'" autocomplete="off"></textarea>
        <span v-show="errors.has('descripcionHechos')" class="text-danger">{{ errors.first('descripcionHechos')}}</span>
        <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span>
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
                validacionesback:[]
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
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>