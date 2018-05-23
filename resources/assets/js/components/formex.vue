<template>
<div class="container">
    <input v-on:input="SearchByAlias()" v-model="alias"/>
    <div v-if="DataTable!=undefined">
    <div v-if="!DataTable.charging">    
        <table class="table">
            <tr>
                <th v-for="cols in DataTable.params.columns" :key="cols.name" v-if="cols.show">{{isexits(cols.replace,cols.name)}}</th>
                <th v-if="DataTable.options!=undefined">{{DataTable.options.title}}</th>
            </tr>
            <tr v-for="fields in DataTable.data.src" :key="fields.id">
                <td v-for="cols in DataTable.params.columns" :key="cols.name" v-if="cols.show">{{fields[cols.name]}}</td>
                <td v-if="DataTable.options!=undefined" v-for="opt in DataTable.options.links" :key="opt.text">
                    <a href="#" v-on:click="opt.func(fields)">{{opt.text}}</a>
                </td>
            </tr>
        </table>
        <div v-if="DataTable.maxpage>0">
            <button class="btn btn-default" :disabled="DTEnabled(DataTable.current - 1)" v-on:click="DTBackData()">&larr;</button>    
            <button class="btn btn-primary" disabled="true">{{DataTable.current + 1}}</button>
            <button class="btn btn-default" :disabled="DTEnabled(DataTable.current +1)" v-on:click="DTGetData(DataTable.current+1)">{{DataTable.current + 2}}</button>
            <button class="btn btn-default" :disabled="DTEnabled(DataTable.current +2)" v-on:click="DTGetData(DataTable.current+2)">{{DataTable.current + 3}}</button>
            <button class="btn btn-default" :disabled="DTEnabled(DataTable.current + 1)" v-on:click="DTNextData()">&rarr;</button>
        </div>
    </div>
    <div v-else>
        <span>{{DataTable.message}}</span>
    </div>
    </div>
</div>
</template>
<script>
    export default {        
        data(){
            return{
                alias:"",
                DataTable:{
                    data:{
                        src:[],
                        count:0
                    },
                    url:"/api/test/SearchUndefined",
                    params:{
                            columns:[//select columns in table (correct name col)
                                {name:"id",show:false},
                                {name:"alias",show:true,replace:"Alias"}
                            //name:colname,show:showInTable,replace:NweNameInTable
                            ],
                            skip:0,//skip
                            limit:5,//limit
                            filters:{nombre:"hdjdjh"},//search where like (correct name col)
                            nfilters:{},//search where no like (correct name col)
                            //tablename:"cat_municipio"
                            //tablename:"cat_estado"
                            tablename:"variables_persona"
                            },
                    current:0,
                    maxpage:0,
                    charging:false,
                    message:"Cargando...",
                    options:{title:"opciones",links:[
                    {func:function(obj){alert(obj.id);},text:"alert" }
                    ]}
                }
            }
        },
        methods:{ 
            SearchByAlias:function(){
                //this.DataTable.params.filters={alias:"alias"};
                this.DTGetData(0);
            },       
            DTallcols:function(){
                var cols=[];
                Object.keys(this.DataTable.data.src[0]).forEach(function(dt){
                    cols.push({name:dt,show:true});
                })  
                this.DataTable.params.columns=cols;             
            },
            isexits:function(value,defaultv){
                return value==undefined?defaultv:value;
            },    
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
                        if(DT.count>0){
                            this.DataTable.data=DT;
                            if(this.DataTable.columns==undefined){
                                this.DTallcols();
                            }
                            this.DataTable.maxpage=parseInt(this.DataTable.data.count/this.DataTable.params.limit);
                            this.DataTable.maxpage+=this.DataTable.data.count%this.DataTable.params.limit==0?0:1;                    
                            this.DataTable.charging=false;   
                        }else{
                            this.DataTable.message="sin datos";                            
                        }                     
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