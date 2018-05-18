<template>
<div class="container">
    <div v-if="!DataTable.charging">    
        <table class="table">
            <tr >
                <td v-for="cols in DataTable.params.columns":key="cols.name" v-if="cols.show"><b>{{cols.replace==undefined?cols.name:cols.replace}}</b></td>
            </tr>
            <tr v-for="fields in DataTable.data.src":key="fields.id">
                <td v-for="cols in DataTable.params.columns":key="cols.name" v-if="cols.show">{{fields[cols.name]}}</td>
            </tr>
        </table>
        <button class="btn btn-default" :disabled="DTEnabled(DataTable.current - 1)" v-on:click="DTBackData()">&larr;</button>    
        <button class="btn btn-primary" disabled="true">{{DataTable.current + 1}}</button>
        <button class="btn btn-default" :disabled="DTEnabled(DataTable.current +1)" v-on:click="DTGetData(DataTable.current+1)">{{DataTable.current + 2}}</button>
        <button class="btn btn-default" :disabled="DTEnabled(DataTable.current +2)" v-on:click="DTGetData(DataTable.current+2)">{{DataTable.current + 3}}</button>
        <button class="btn btn-default" :disabled="DTEnabled(DataTable.current + 1)" v-on:click="DTNextData()">&rarr;</button>
    </div>
    <div v-else>
        <span>{{DataTable.message}}</span>
    </div>
</div>
</template>

<script>
    export default {        
        data(){
            return{
                DataTable:{
                    data:{
                        src:[],
                        count:0
                    },
                    url:"/api/test/SearchUndefined",
                    params:{columns:[//select columns in table (correct name col)
                                {name:"id",show:false},
                                {name:"nombre",show:true,replace:"Nombre del sistema"},
                                {name:"descripcion",show:true,replace:"Descripcion del sistema"}
                            //name:colname,show:showInTable,replace:NweNameInTable
                            ],
                            skip:0,//skip
                            limit:5,//limit
                            filters:{},//search where like (correct name col)
                            nfilters:{},//search where no like (correct name col)
                            //tablename:"cat_municipio"
                            //tablename:"cat_estado"
                            tablename:"sistemas"
                            },
                    current:0,
                    maxpage:0,
                    charging:false,
                    message:"Cargando..."              
                }
            }
        },
        mounted(){
            //INIT METHOD
            //if(this.DataTable.data.src==[]){
                this.DTGetData(0);
            //}
        },
        methods:{            
            DTEnabled:function(s){
                return !(s>=0&&s<this.DataTable.maxpage)
            },
            DTGetData:function(s){          
                this.DataTable.charging=true;      
                this.DataTable.current=s;
                this.DataTable.params.skip=this.DataTable.params.limit*s;
                var DT;
                axios.post(this.DataTable.url,this.DataTable.params).then(response=>{
                    DT=response.data;
                }).finally(()=>{
                    if(DT!=undefined){
                        this.DataTable.data=DT;
                        this.DataTable.maxpage=parseInt(this.DataTable.data.count/this.DataTable.params.limit);
                        this.DataTable.maxpage+=this.DataTable.data.count%this.DataTable.params.limit==0?0:1;                    
                        this.DataTable.charging=false;
                    }else{
                        this.DataTable.message="error al cargar la informacion";
                    }                    
                });
            },
            DTNextData:function(){
                this.DTGetData(this.DataTable.current+1);
            },
            DTBackData:function(){
                this.DTGetData(this.DataTable.current-1);
            }
        }
    }
</script>