<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

<div class="form-row">
    	
    
    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="antiguedad">Antigüedad (Años)</label>
        <input type="number" min="0" name="antiguedad" step="1" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('antiguedad')  || this.validacionesback.antiguedad}" v-model="antiguedad" placeholder="Ingrese el horario laboral" v-validate="'required'" autocomplete="off">
        <span v-show="errors.has('antiguedad')" class="text-danger">{{ errors.first('antiguedad')}}</span>
        <span v-if="this.validacionesback.antiguedad!=undefined" class="text-danger">{{ String(this.validacionesback.antiguedad)}}</span>        
    </div>

   <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="rango">Rango</label>    
        <v-select :options="rangos" label="rango" v-model="rango" name="rango" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('rango') || this.validacionesback.rango}" placeholder="Seleccione un rango"></v-select>
        <span v-show="errors.has('rango')" class="text-danger">{{ errors.first('rango')}}</span>
        <span v-if="this.validacionesback.rango!=undefined" class="text-danger">{{ String(this.validacionesback.rango)}}</span>
    </div>
    
    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="identidad">Horario laboral</label>    
        <input type="text" name="horarioLaboral" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('horarioLaboral')  || this.validacionesback.alias}" v-model="horarioLaboral" placeholder="Ingrese el horario laboral" v-validate="'required'" autocomplete="off">
        <span v-show="errors.has('horarioLaboral')" class="text-danger">{{ errors.first('horarioLaboral')}}</span>
        <span v-if="this.validacionesback.horarioLaboral!=undefined" class="text-danger">{{ String(this.validacionesback.horarioLaboral)}}</span>
    </div>

    <div v-if="sistema=='uat'" class="form-group col-md-12">
        <label class="col-form-label col-form-label-sm" for="descripcionHechos">Descripcion de hechos</label>
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
                antiguedad:'',                                             
                rangos:['CABO','COMANDANTE'],
                rango:'',
                horarioLaboral:'',                                
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
            getPuestos:function (){
                var urlPuestos = this.url+'/getPuestos';
                axios.post(urlPuestos).then(response => {
                    this.puestos = response.data
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