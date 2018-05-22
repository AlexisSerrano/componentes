<template>
<div>
    <button v-on:click="SetDTs()">cargar</button>
    <render-datatable :dts="dts" v-on:dt="dts" ></render-datatable>
</div>
</template>
<script>
    export default {        
        data(){
            return{
                dts:{}
            }
        },
        methods:{
            SetDTs:function(){
                this.dts.params={tablename:'sistemas'};
                this.dts.url="new url";
            }
        }
    }
</script>