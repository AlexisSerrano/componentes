<!--<template>

    <div class="container-fluid">
        
        <form>
            
            <div class="form-row">

            <label for="rfc">RFC persona fisica</label><input type="text" v-model="rfc" v-on:blur="buscarCarpetasFisica('rfc')">
            <label for="rfc">CURP persona fisica</label><input type="text" v-model="curp" v-on:blur="buscarCarpetasFisica('curp')">
            </div>

            <label for="rfc">RFC persona moral</label><input type="text" v-model="rfcMoral" v-on:blur="buscarCarpetasMoral">

            <pre>{{$data}}</pre>
            <button type="submit" class="btn btn-primary mt-2">Guardar</button>

        </form>
    </div>
</template>
-->




<template>

<div class="container">


            <div class="form-row">

            <label for="rfc">RFC persona fisica</label><input type="text" v-model="rfc" v-on:blur="buscarCarpetasFisica('rfc')">
            <label for="rfc">CURP persona fisica</label><input type="text" v-model="curp" v-on:blur="buscarCarpetasFisica('curp')">
            </div>

            <label for="rfc">RFC persona moral</label><input type="text" v-model="rfcMoral" v-on:blur="buscarCarpetasMoral">            

  <h2>Carpetas encontradas</h2>
  <p>Carpetas ligadas a la persona</p>            
  <table class="table">
    <thead>
      <tr>
       <div v-for="(value, key) in object">
            {{ key }}: {{ value }}
        </div>
      </tr>
    </thead>
    <tbody>
      <tr>        
        <td v-for="value in carpetasLigadas">
            {{ value }}
        </td>
      </tr>
    </tbody>
  </table>

</div>
</template>


<script>
import swal from 'sweetalert2'
import { mapState } from "vuex";
    export default {
        data(){
            return{
                rfc:'',
                rfcMoral:'',
                curp:'',
                carpetasLigadas: 
                    {
                    nombres: 'JUAN',
                    primerAp: 'APELLIDO2',
                    segundoAp: 'APELLIDO3',
                    rfc: 'AEAJ951212TUA',
                    curp: 'AEAJ951212HVZPPN05',                    
                    idCarpeta: 'xx',                                        
                    sistema: 'uat',
                    tipoInvolucrado: 'autoridad',
                    nuc: 'xxxxx',
                    tipoDeterminacion: 'POR DETERMINAR',
                    variablePersona: 3,
                    },
                url:'./api'
            }
        },
        props:{

        },        
        mounted: function () {          
        },
        methods:{
            buscarCarpetasFisica:function(param){
                if(param=='rfc'){
                    console.log("Se buscará la carpeta de persona fisica por RFC");
                    var post = this.url+'/fisicaCarpetasRfc';
                    axios.post(post,{
                        rfc:this.rfc,                        
                }).then(response =>{
                    this.carpetasLigadas=response.data                    
                    if(this.carpetasLigadas!=''){
                        swal({
                            title: 'Hay carpteas ligadas a esta persona!',
                            text: 'Existen carpetas.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                    }
                });
                }else{
                console.log("Se buscará la carpeta de persona fisica por CURP");
                    var post = this.url+'/fisicaCarpetasCurp';
                    axios.post(post,{
                        curp:this.curp,                        
                }).then(response =>{
                    this.carpetasLigadas=response.data                    
                    if(this.carpetasLigadas!=''){
                        swal({
                            title: 'Hay carpteas ligadas a esta persona!',
                            text: 'Existen carpetas.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                    }
                });
                }             
            },
            buscarCarpetasMoral:function(){
                console.log("Se buscará la persona moral por RFC");                
                    var post = this.url+'/moralCarpetasRfc';
                    axios.post(post,{
                        rfc:this.rfcMoral,                       
                }).then(response =>{
                    this.carpetasLigadas=response.data                    
                    if(this.carpetasLigadas!=''){
                        swal({
                            title: 'Hay carpteas ligadas a esta persona!',
                            text: 'Existen carpetas.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                    }
                });
            }            
        },        
    }
</script>
<style>

</style>