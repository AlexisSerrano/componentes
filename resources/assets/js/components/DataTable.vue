<template>
<div class="container">
    <table class="table">
        <tr>
            <td>Nombre</td>
        </tr>
        <tr v-for="item in dtp":key="item.id">
            <td>{{item.nombre}}</td>
        </tr>
    </table>
    <span class="btn btn-primary" v-on:click="GetData()">buscar</span>
    </div>
</template>

<script>
    export default {        
        beforeMount(){
            //this.GetData(0,0);
        },
        methods:{
            GetData:function(s,l,f){
                var datarequest;
                axios.post("/api/test/SearchUndefined",{
                    "skip":s==undefined?0:s,
                    "limit":l==undefined?0:l,
                    "filters":f==undefined?[]:f
                }).then(function(response){                
                    datarequest=response.data.src;
                }).finally(function(){
                    dtp=datarequest;
                    console.log(datarequest);
                });
            }
        },
        data(){
            return {
                dtp:[{nombre:"primero",id:1},{nombre:"segundo",id:2}]
            };
        },
    }
</script>
