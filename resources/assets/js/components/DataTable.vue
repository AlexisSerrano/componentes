<template>
<div class="container"> 
    <div class="form-row">
        <input type="text" name="alias" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Alias') }" id="alias" v-model="datoAlias" placeholder="Ingresa el alias" v-validate="'required'" autocomplete="off" data-vv-name="Alias" v-on:blur="mostrarTable()" style="width:12em;" > 
        <div style="cursor:pointer"> <span class="badge badge-dark" id="match" v-on:click="mostrarTable(1)"></span>  </div>
    </div>        
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" style="width:100%">
                <div class="modal-header">                
                    <h3>Coincidencias con el alias</h3>
                </div>
                <div class="modal-body">
                    <div v-if="DataTable!=undefined">
                        <div v-if="!DataTable.charging">    
                            <table class="table table-responsive">                
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
                                 {name:"idPersona",show:false},
                                 {name:"idvar_persona",show:false},
                                 {name:"nombres",show:true,replace:"Nombres"},
                                 {name:"primerAp",show:true,replace:"Primer apellido"},
                                 {name:"segundoAp",show:true,replace:"Segundo apellido"},
                                 {name:"fechaNacimiento",show:true,replace:"Fecha nacimiento"},
                                 {name:"rfc",show:true,replace:"RFC"},
                                 {name:"curp",show:true,replace:"CURP"},
                                 {name:"sexo",show:true,replace:"Sexo"},
                                 {name:"nacionalidad",show:true,replace:"Nacionalidad"},
                                 {name:"etnia",show:true,replace:"Etnia"},
                                 {name:"municipioOrigen",show:true,replace:"Municipio origen"},
                                 {name:"edad",show:true,replace:"Edad"},
                                 //{name:"telefono",show:true,replace:"Teléfono"},
                                 {name:"motivoEstancia",show:true,replace:"Motivo estancia"},
                                 {name:"ocupacion",show:true,replace:"Ocupacion"},
                                 {name:"estadoCivil",show:true,replace:"Estado civil"},
                                 {name:"escolaridad",show:true,replace:"Escolaridad"},
                                 {name:"religion",show:true,replace:"Religión"},
                                 {name:"docIdentificacion",show:true,replace:"Doc identificación"},
                                 {name:"numDocIdentificacion",show:true,replace:"Num doc identif."},
                                 {name:"lugarTrabajo",show:true,replace:"Lugar trabajo"},
                                 {name:"idDomicilioTrabajo",show:false,replace:"idDomicilio"},
                                 //{name:"telefonoTrabajo",show:true,replace:"Teléfono trabajo"},
                                 {name:"alias",show:true,replace:"Alias"}                                 

                             //name:colname,show:showInTable,replace:NweNameInTable
                             ],
                             skip:0,//skip
                             limit:5,//limit
                             filters:{},//search where like (correct name col)
                             nfilters:{},//search where no like (correct name col)
                             //tablename:"cat_municipio"
                             //tablename:"cat_estado"
                             tablename:"persona_completa_actual"
                             },
                     current:0,
                     maxpage:0,
                     charging:false,
                     message:"Cargando...",
                     options:{title:"opciones",links:[
                     {func:function(obj){
                         alert(obj.id);
                         },
                     text:"alert" }]}
                 },
                 datoAlias:''
            }
        },
        props: {
            title: String,
            aliasReceived: Boolean,
            isPublished: Boolean,
            commentIds: Array,
            author: Object
        },
        mounted(){
            //INIT METHOD
                /*if(this.dt!=undefinned){
                    this.DataTable.url=this.isexits(this.dt.url,this.DataTable.url);
                    this.DataTable.params=this.isexits(this.dt.params,this.DataTable.params);
                    this.DataTable.options=this.isexits(this.dt.options,this.DataTable.options);
                }*/                                
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
                            console.log("Dentro del getData  "+ this.DataTable.data.count); 
                            if(this.DataTable.columns==undefined){
                                this.DTallcols();
                            }
                            this.DataTable.maxpage=parseInt(this.DataTable.data.count/this.DataTable.params.limit);
                            this.DataTable.maxpage+=this.DataTable.data.count%this.DataTable.params.limit==0?0:1;                    
                            this.DataTable.charging=false;   
                        }else{
                            this.DataTable.message="No hay datos para mostrar";                            
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
            },
            mostrarTable:function(triger){
                if(triger!=undefined){
                    this.DTGetData(0)
                    $("#myModal").modal();
                    return;
                }  
                this.datoAlias=this.datoAlias.trim()  
                if((this.datoAlias.length) > 0){                    
                    /*this.DataTable.params.filters={"alias":this.datoAlias}
                    this.DTGetData(0)
                    console.log("Resultados: "+ this.DataTable.data.count);                    
                    $("#myModal").modal();  */
                    this.DataTable.params.filters={"alias":this.datoAlias}
                    var DT;                              
                    axios.post(this.DataTable.url, this.DataTable.params).then(response=>{
                        DT=response.data;
                    }).finally(()=>{
                        if(DT!=undefined){
                            if(DT.count>0){
                                console.log("Se encontraron: "+DT.count+" Resultados");     
                                $('#match').html(DT.count)                           
                            }else{
                                console.log("No hay datos"); 
                                $('#match').html('')                                                                                   
                            }                     
                        }else{
                            console.log("Sin informacion");
                        }                    
                    });


                }else{
                    console.log("No hay datos en el input");
                }                   
            }
        }
    }
</script>