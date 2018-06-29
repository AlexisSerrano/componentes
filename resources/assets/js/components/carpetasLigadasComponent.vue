<template>

<div class="container">
            <div class="form-row">
            <div v-if="tipo=='fisica'"><label for="rfc">RFC persona fisica</label><input type="text" v-model="rfc" v-on:blur="buscarCarpetasFisica('rfc')"></div>
            <div v-if="tipo=='fisica'"><label for="homoclave">Homoclave persona fisica</label><input type="text" v-model="homoclave" v-on:blur="buscarCarpetasFisica('rfc')"></div>
            <div v-if="tipo=='fisica'"><label for="curp">CURP persona fisica</label><input type="text" v-model="curp" v-on:blur="buscarCarpetasFisica('curp')"></div>
            <div v-if="tipo=='moral'"><label for="rfcMoral">RFC persona moral</label><input type="text" v-model="rfc" v-on:blur="buscarCarpetasMoral"></div>
            <div v-if="tipo=='moral'"><label for="homoclaveMoral">Homoclave persona moral</label><input type="text" v-model="homoclave" v-on:blur="buscarCarpetasMoral"></div>
            </div>

  <h2>Carpetas encontradas</h2>         
  <table class="table">
    <thead v-if="tipo=='fisica'">
      <tr>
        <th>Nombres</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>R.F.C.</th>
        <th>C.U.R.P.</th>
        <th>ID Carpeta</th>
        <th>Sistema</th>
        <th>Tipo de involucrado</th>
        <th>N.U.C.</th>
        <th>Tipo de determinación</th>
      </tr>
    </thead>
        <thead v-if="tipo=='moral'">
      <tr>
        <th>Nombre</th>
        <th>R.F.C.</th>        
        <th>Representante legal</th> 
        <th>ID Carpeta</th>
        <th>Sistema</th>
        <th>Tipo de involucrado</th>
        <th>N.U.C.</th>
        <th>Tipo de determinación</th>
      </tr>
    </thead>
    <tbody v-if="tipo=='fisica'" >
      <tr v-for="value in carpetasLigadas" :key="value.rfc">
        <td>{{ value.nombres }}</td>
        <td>{{ value.primerAp }}</td>
        <td>{{ value.segundoAp }}</td>
        <td>{{ value.rfc }}</td>
        <td>{{ value.curp }}</td>
        <td>{{ value.idCarpeta }}</td>
        <td>{{ value.sistema }}</td>
        <td>{{ value.tipoInvolucrado }}</td>
        <td>{{ value.nuc }}</td>
        <td>{{ value.tipoDeterminacion }}</td>
      </tr>
      <tr v-show="carpetasLigadas==''" ><td colspan="10" style="text-align:center;">Sin resultados</td></tr>
    </tbody>
    <tbody v-if="tipo=='moral'">
      <tr  v-for="value in carpetasLigadas" :key="value.rfc">
        <td>{{ value.nombre }}</td>
        <td>{{ value.rfc }}</td>
        <td>{{ value.representanteLegal }}</td>
        <td>{{ value.idCarpeta }}</td>
        <td>{{ value.sistema }}</td>
        <td>{{ value.tipoInvolucrado }}</td>
        <td>{{ value.nuc }}</td>
        <td>{{ value.tipoDeterminacion }}</td>
      </tr>
      <tr v-show="carpetasLigadas==''" ><td colspan="10" style="text-align:center;">Sin resultados</td></tr>
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
                homoclave:'',                
                curp:'',
                url:'http://localhost/componentes/public/api',                     
                carpetasLigadas:''             
            }
        },
        props:{
            tipo: {
                required:true
            }
        },        
        mounted: function () {          
        },
        methods:{
            buscarCarpetasFisica:function(param){
                if(param=='rfc' && this.rfc!='' && this.homoclave!='' ){  
                    console.log();                  
                    var post = this.url+'/fisicaCarpetasRfc';
                    axios.post(post,{
                        rfc:this.rfc+this.homoclave,                        
                }).then(response =>{
                    this.carpetasLigadas=response.data;                  
                    if(this.carpetasLigadas!=''){
                        swal({
                            title: 'Hay carpteas ligadas a esta persona!',
                            text: 'Existen carpetas.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })                        
                    }
                });
                }else if(param=='curp' && this.curp!=''){                              
                    var post = this.url+'/fisicaCarpetasCurp';
                    axios.post(post,{
                        curp:this.curp                                              
                }).then(response =>{
                    this.carpetasLigadas=response.data;                    
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
                if(this.rfc!='' && this.homoclave!=''){                                              
                    var post = this.url+'/moralCarpetasRfc';
                    axios.post(post,{
                        rfc:this.rfc+this.homoclave,                       
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
            }
                        
        },        
    }
</script>
<style>

</style>