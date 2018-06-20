<template>

<div class="container-fluid">
<form v-on:submit.prevent="validateBeforeSubmit">

    <div class="form-row">

	    <div class="form-group col-md-3">		
            <label class="col-form-label col-form-label-sm" for="identidad"> Identidad resguardada </label>           		
            <v-select :options="ident" label="nombre" v-model="identidad" name="identidad" v-validate="'required'" :class="{'border border-danger rounded': errors.has('identidad')}" placeholder="Seleccione" ></v-select>
            <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>            
	    </div>


<div class="form-group col-md-3">		
            <label class="col-form-label col-form-label-sm" for="identidad"> Tipo de solicitante </label>           		
            <v-select :options="ident" label="nombre" v-model="identidad" name="identidad" v-validate="'required'" :class="{'border border-danger rounded': errors.has('identidad')}" placeholder="Seleccione" ></v-select>
            <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>            
</div>

	<div class="col-12">
		<div class="form-group">
            <label class="col-form-label-sm">Descripcion de los hechos</label>
            <textarea v-model="descripcionHechos" cols="30" rows="5" class="form-control form-control-sm" placeholder="Ingrese la descripcón de los hechos"></textarea>
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
                identidadRes: '',
                tipoSolicitante: '',
                descripcionHechos:'',  
                ident:['No','Si'],
                validacionesback:[],
                identidad:'',
                //url:'/api'
                url:'http://localhost/componentes/public/api'
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