<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

<div class="form-row">
    	
    
    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="antiguedad">Antigüedad (Años)</label>
        <input type="number" min="0" name="antiguedad" step="1" :class="{'form-control form-control-sm':true, 'border border-danger': errors.has('antiguedad')}" v-model="antiguedad" placeholder="Ingrese el horario laboral" v-validate="'required'" autocomplete="off">
        <span v-show="errors.has('antiguedad')" class="text-danger">{{ errors.first('antiguedad')}}</span>
        <!-- <span v-if="this.validacionesback.antiguedad!=undefined" class="text-danger">{{ String(this.validacionesback.antiguedad)}}</span>-->
    </div>

   <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="rango">Rango</label>    
        <v-select :options="rangos" label="rango" v-model="rango" name="rango" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('rango')}" placeholder="Seleccione un rango"></v-select>
        <span v-show="errors.has('rango')" class="text-danger">{{ errors.first('rango')}}</span>
        <!-- <span v-if="this.validacionesback.rango!=undefined" class="text-danger">{{ String(this.validacionesback.rango)}}</span>-->
    </div>
    
    <div class="form-group col-md-3">
        <label class="col-form-label col-form-label-sm" for="horarioLaboral">Horario laboral</label>    
        <input type="text" name="horarioLaboral" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('horarioLaboral')}" v-model="horarioLaboral" placeholder="Ingrese el horario laboral" v-validate="'required'" autocomplete="off">
        <span v-show="errors.has('horarioLaboral')" class="text-danger">{{ errors.first('horarioLaboral')}}</span>
        <!-- <span v-if="this.validacionesback.horarioLaboral!=undefined" class="text-danger">{{ String(this.validacionesback.horarioLaboral)}}</span> -->
    </div>

    <div v-if="sistema=='uat'" class="form-group col-md-12">
        <label class="col-form-label col-form-label-sm" for="descripcionHechos">Descripcion de hechos</label>
        <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcionHechos" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcionHechos')}" v-model="descripcionHechos" placeholder="Ingrese la descripcion de los hechos" v-validate="'required'" autocomplete="off"></textarea>
        <span v-show="errors.has('descripcionHechos')" class="text-danger">{{ errors.first('descripcionHechos')}}</span>
        <!-- <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span>-->
    </div> 

    <div class="form-row mt-3">
        <div class="form-group col-md-5">
            <button type="submit" class="btn btn-primary mr-1">Guardassr</button>
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
                antiguedad:'',                                             
                rangos:['CABO','COMANDANTE'],
                rango:'',
                horarioLaboral:'',                                
                descripcionHechos:'',
                validacionesback:[],
                url:'http://localhost/componentes/public/api',
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
            validateBeforeSubmit(){
               this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtraAutoridad();
                        /*console.log("Antiguedad:" + this.antiguedad);
                        console.log("Rango:" +this.rango);
                        console.log("Horario laboral: "+this.horarioLaboral);
                        console.log("Descripcion:" +this.descripcionHechos);*/
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
            guardar:function(){
                console.log("Guardando a la persona");
            },
            guardarExtraAutoridad: function(){  
                var urlGuardarAutoridad = this.url+'/guardarExtrasAutoridad';                
                var data = {
                    idVariablesPersona:1,                    
                    antiguedad:this.antiguedad,
                    rango:this.rango,
                    horarioLaboral: this.horarioLaboral,
                    narracion:this.descripcionHechos
                    };
                    axios.post(urlGuardarAutoridad,data)
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
                
            }
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>