<template>
<div>
    <button v-on:dt="SetDTs">cargar</button>
    <render-datatable :dts="dts"  ></render-datatable>
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
                alert("exe") 
            }
        }
    }
</script>