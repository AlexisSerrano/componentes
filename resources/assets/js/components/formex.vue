<template>
<div class="container">
    <input v-model="alias" v-on:blur="search()">
    <div id="r-td-1"></div>
</div>
</template>
<script>
import init from 'rendata'
    export default {        
        data(){
            return{
                alias:""
            }
        },
        mounted (){},
        methods:{             
            search:function(){
                console.log(this.alias);
                init(
                {
                    url:"/api/SearchUndefined",
                    params:{
                        filters:{"alias":this.alias},
                        tablename:"persona_completa_actual"
                    }
                },1);
            }
        } 
    }
</script>