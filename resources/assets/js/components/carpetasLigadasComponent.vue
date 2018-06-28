<template>

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

<script>
import swal from 'sweetalert2'
import { mapState } from "vuex";
    export default {
        data(){
            return{
                rfc:'',
                rfcMoral:'',
                curp:'',
                url:'http://localhost/componentes/public/api',                     
                carpetasLigadas:[]              
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