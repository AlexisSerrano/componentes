<template>
<div class="container">
    <div v-if="!DataTable.charging">    
        <table class="table">
            <tr >
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
        <div v-if="Datatable.maxpage>0">
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
                    params:{
                            columns:[//select columns in table (correct name col)
                                {name:"id",show:false},
                                {name:"nombre",show:true,replace:"Nombre del sistema"},
                                {name:"descripcion",show:true,replace:"Descripcion del sistema"}
                            //name:colname,show:showInTable,replace:NweNameInTable
                            ],
                            skip:0,//skip
                            limit:5,//limit
                            filters:{nombre:"hdjdjh"},//search where like (correct name col)
                            nfilters:{},//search where no like (correct name col)
                            //tablename:"cat_municipio"
                            //tablename:"cat_estado"
                            tablename:"sistemas"
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
        props:{
            dt:{}
        },
        mounted(){
            //INIT METHOD
                /*if(this.dt!=undefinned){
                    this.DataTable.url=this.isexits(this.dt.url,this.DataTable.url);
                    this.DataTable.params=this.isexits(this.dt.params,this.DataTable.params);
                    this.DataTable.options=this.isexits(this.dt.options,this.DataTable.options);
                }*/
                this.DTGetData(0);
        },
        methods:{        
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