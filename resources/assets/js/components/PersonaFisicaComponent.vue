<template>
    <div class="container-fluid"> 
        <form v-on:submit.prevent="validateBeforeSubmit" v-if="mostrarForm">

            <div class="form-row">
                <div v-if="tipo!='qrr'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nombres">Nombres</label>
                    <input type="text" name="nombres" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('nombres') }" v-model="nombres" placeholder="Ingrese el nombre" v-validate="nombresV" autocomplete="off" @blur="searchPersona" v-on:blur="generarCurp">
                    <span v-if="errors.has('nombres')" class="text-danger">{{ errors.first('nombres') }}</span>
                </div>
                <div v-if="tipo=='qrr'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nombres">Nombres</label>
                    <input type="text" class="form-control form-control-sm" v-model="qrr" readonly>
                </div>
                <div v-if="tipo!='qrr'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="primerAp">Primer apellido</label>
                    <input type="text" data-vv-name="primer apellido" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('primer apellido') }" v-model="primerAp" placeholder="Ingrese el primer apellido" v-validate="primerApV" autocomplete="off" @blur="searchPersona" v-on:blur="generarCurp">
                    <span v-if="errors.has('primer apellido')" class="text-danger">{{ errors.first('primer apellido') }}</span>
                </div>
                <div v-if="tipo!='qrr'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="segundoAp">Segundo apellido</label>
                    <input type="text" data-vv-name="segundo apellido" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('segundo apellido') }" v-model="segundoAp" placeholder="Ingrese el segundo apellido" v-validate="segundoApV" autocomplete="off" @blur="searchPersona" v-on:blur="generarCurp">
                    <span v-if="errors.has('segundo apellido')" class="text-danger">{{ errors.first('segundo apellido') }}</span>
                </div>
               <div v-if="tipo=='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="alias">Alias</label>                    
                    <input type="text" name="alias" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('alias') }" v-model="alias" placeholder="Ingrese el alias" v-validate="aliasV" autocomplete="off">
                    <span v-if="errors.has('alias')" class="text-danger">{{ errors.first('alias') }}</span>
                </div>






                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="fechaNacimiento">Fecha de nacimiento</label>
                    <input type="date" class="form-control form-control-sm" v-model="fechaNacimiento" data-vv-name="fecha de nacimiento" v-validate="fechaNacimientoV" :class="{ 'border border-danger': errors.has('fecha de nacimiento')}" @blur="searchPersona" v-on:blur="generarCurp(),generarEdad()">
                    <span v-show="errors.has('fecha de nacimiento')" class="text-danger">{{ errors.first('fecha de nacimiento') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-1">
                    <label class="col-form-label col-form-label-sm" for="edad">Edad</label>
                    <input type="number" min="16" max="150" name="edad" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('edad') }" v-model="edad" placeholder="Edad" v-validate="edadV">
                    <span v-if="errors.has('edad')" class="text-danger">{{ errors.first('edad') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="sexos">Sexo</label>    
                    <v-select :options="sexos" label="nombre" v-model="sexo" name="sexo" v-validate="sexoV" :class="{ 'border border-danger rounded': errors.has('sexo') }" placeholder="Seleccione un sexo" v-on:blur="generarCurp"></v-select>
                    <span v-show="errors.has('sexo')" class="text-danger">{{ errors.first('sexo') }}</span>
                </div>

                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="estado">Entidad federativa de origen</label>    
                    <v-select :options="estados" label="nombre" data-vv-name="entidad federativa de origen" v-model="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('entidad federativa de origen') }" placeholder="Seleccione una entidad federativa de origen" v-on:blur="generarCurp"></v-select>
                    <span v-show="errors.has('entidad federativa de origen')" class="text-danger">{{ errors.first('entidad federativa de origen') }}</span>
                </div>





                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="rfc">RFC</label>
                    <input type="text" name="rfc" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('rfc') }" v-model="rfc" placeholder="Ingrese el RFC" v-validate="rfcV" autocomplete="off">
                    <span v-if="errors.has('rfc')" class="text-danger">{{ errors.first('rfc') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="homoclave">Homoclave</label>
                    <input type="text" name="homoclave" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('homoclave') }" v-model="homoclave" placeholder="Homoclave" v-validate="rfcV" autocomplete="off">
                    <span v-if="errors.has('homoclave')" class="text-danger">{{ errors.first('homoclave') }}</span>
                </div>

                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="curp">CURP</label>
                    <input type="text" name="curp" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('curp') }" v-model="curp" placeholder="Ingrese el curp" v-validate="curpV" autocomplete="off">
                    <span v-if="errors.has('curp')" class="text-danger">{{ errors.first('curp') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nacionalidad">Nacionalidad</label>    
                    <v-select :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" v-validate="nacionalidadV" :class="{ 'border border-danger rounded': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <span v-show="errors.has('nacionalidad')" class="text-danger">{{ errors.first('nacionalidad') }}</span>
                </div>




                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="municipio">Municipio de origen</label>    
                    <v-select :options="municipios" label="nombre" v-model="municipio" name="municipio" v-validate="municipioV" :class="{ 'border border-danger rounded': errors.has('municipio') }" placeholder="Seleccione un municipio de origen"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="etnia">Etnia</label>    
                    <v-select label="nombre" :options="etnias" v-model="etnia" name="etnia" v-validate="etniaV" :class="{ 'border border-danger rounded': errors.has('etnia') }" placeholder="Seleccione una etnia"></v-select>
                    <span v-show="errors.has('etnia')" class="text-danger">{{ errors.first('etnia') }}</span> 
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="lengua">Lengua</label>    
                    <v-select label="nombre" :options="lenguas" v-model="lengua" name="lengua" v-validate="lenguaV" :class="{ 'border border-danger rounded': errors.has('lengua') }" placeholder="Seleccione una lengua"></v-select>
                    <span v-show="errors.has('lengua')" class="text-danger">{{ errors.first('lengua') }}</span> 
                </div>




                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="interprete">Intérprete</label>    
                    <v-select :options="interpretes" label="nombre" v-model="interprete" name="intérprete" v-validate="interpreteV" :class="{ 'border border-danger rounded': errors.has('intérprete') }" placeholder="Seleccione un intérprete"></v-select>
                    <span v-show="errors.has('intérprete')" class="text-danger">{{ errors.first('intérprete') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="motivoEstancia">Motivo de estancia</label>
                    <input type="text" data-vv-name="motivo de estancia" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('motivo de estancia') }" v-model="motivoEstancia" placeholder="Ingrese el motivo de estancia" v-validate="motivoEstanciaV" autocomplete="off">
                    <span v-if="errors.has('motivo de estancia')" class="text-danger">{{ errors.first('motivo de estancia') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="ocupacion">Ocupación</label>    
                    <v-select :options="ocupaciones" label="nombre" v-model="ocupacion" name="ocupacion" v-validate="ocupacionV" :class="{ 'border border-danger rounded': errors.has('ocupación') }" placeholder="Seleccione una ocupación"></v-select>
                    <span v-show="errors.has('ocupación')" class="text-danger">{{ errors.first('ocupación') }}</span>
                </div>




                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="estadoCivil">Estado civil</label>    
                    <v-select :options="estadosCiviles" label="nombre" v-model="estadoCivil" data-vv-name="estado civil" v-validate="estadoCivilV" :class="{ 'border border-danger rounded': errors.has('estado civil') }" placeholder="Seleccione un estado civil"></v-select>
                    <span v-show="errors.has('estado civil')" class="text-danger">{{ errors.first('estado civil') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="escolaridad">Escolaridad</label>    
                    <v-select :options="escolaridades" label="nombre" v-model="escolaridad" name="escolaridad" v-validate="escolaridadV" :class="{ 'border border-danger rounded': errors.has('escolaridad') }" placeholder="Seleccione una escolaridad"></v-select>
                    <span v-show="errors.has('escolaridad')" class="text-danger">{{ errors.first('escolaridad') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="religion">Religión</label>    
                    <v-select :options="religiones" label="nombre" v-model="religion" name="religion" v-validate="religionV" :class="{ 'border border-danger rounded': errors.has('religión') }" placeholder="Seleccione una religión"></v-select>
                    <span v-show="errors.has('religión')" class="text-danger">{{ errors.first('religión') }}</span>
                </div>


                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="identificacion">Identificación</label>    
                    <v-select :options="identificaciones" label="documento" v-model="identificacion" name="identificacion" v-validate="identificacionV" :class="{ 'border border-danger rounded': errors.has('identificación') }" placeholder="Seleccione una identificación"></v-select>
                    <span v-show="errors.has('identificación')" class="text-danger">{{ errors.first('identificación') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido' && tipo!='abogado'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="numIdentificacion">Número de identifación</label>
                    <input type="text" data-vv-name="número de identificación" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('número de identificación') }" v-model="numIdentificacion" placeholder="Ingrese el número de identificación" v-validate="numIdentificacionV" autocomplete="off">
                    <span v-if="errors.has('número de identificación')" class="text-danger">{{ errors.first('número de identificación') }}</span>
                </div>
                <div v-if="tipo!='qrr' && tipo!='conocido'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="teléfono">Teléfono</label>
                    <input type="text" name="teléfono" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('teléfono') }" v-model="telefono" placeholder="Ingrese el teléfono" v-validate="telefonoV" autocomplete="off">
                    <span v-if="errors.has('teléfono')" class="text-danger">{{ errors.first('teléfono') }}</span>
                </div>
            </div>


                <div>
                    <input type="hidden" v-model="personaExiste.idvar_persona" id="idvarpersona">              
                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-md-5">
                        <button type="submit" class="btn btn-primary mr-1">Guardar</button>
                    </div>
                </div>

        </form>
    </div>
</template>

<script>
import generaCurp from '../curp'
import swal from 'sweetalert2'
import { execn, draw } from "rendata";
    export default {
        data(){
             return{
                nacionalidades: [],
                estados: [],
                municipios: [],
                etnias: [],
                lenguas: [],
                interpretes: [],
                sexos: [],
                ocupaciones: [],
                estadosCiviles: [],
                escolaridades: [],
                religiones: [],
                identificaciones: [],
                personaExiste:[],
                nombres: '',
                primerAp: '',
                segundoAp: '',
                fechaNacimiento: '',
                edad: '',
                sexo:'',
                rfc:'',
                homoclave:'',
                curp: '',                
                mostrarForm:true,
                nacionalidad:{ "nombre": "MEXICANA", "id": 1 },
                estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                // estado:'',
                municipio:null,
                etnia:{ "nombre": "SIN INFORMACIÓN", "id": 13 },
                lengua:{ "nombre": "SIN INFORMACIÓN", "id": 69 },
                interprete:{ "nombre": "SIN INFORMACIÓN", "id": 1 },
                motivoEstancia:'',
                ocupacion:'',
                estadoCivil:'',
                escolaridad:'',
                religion:'',
                identificacion:'',
                numIdentificacion:'',
                alias:'',         
                telefono:'',                       
                nombresV:false,
                primerApV:false,
                segundoApV:false,
                fechaNacimientoV:false,
                edadV:false,
                sexoV:false,
                rfcV:false,
                curpV:false,
                nacionalidadV:false,
                estadoV:false,
                municipioV:false,
                etniaV:false,
                lenguaV:false,
                interpreteV:false,
                motivoEstanciaV:false,
                ocupacionV:false,
                estadoCivilV:false,
                escolaridadV:false,
                religionV:false,
                identificacionV:false,
                numIdentificacionV:false,
                aliasV:false,
                telefonoV:false,
                validaciones:[],
                denunciado:false,
                qrr:"QUIEN RESULTE RESPONSABLE",
                //url:'http://componentes.oo/api',
                //url:'http://componentes'
                url:'/api'
            }
        },

        // props: ['sistema','tipo'],
        props:{
            sistema: {
                default:false
            },
            tipo: {
                default:false
            }
        },
        mounted: function(){
            this.getCatalogos();              
            this.getValidaciones();             
        },
        methods:{
            getCatalogos: function(){
                var urlCatalogos = this.url+'/getCatalogos';
                axios.get(urlCatalogos).then(response => {
                    this.nacionalidades = response.data['nacionalidades'].original
                    this.estados = response.data['estados'].original
                    this.etnias = response.data['etnias'].original
                    this.lenguas = response.data['lenguas'].original
                    this.sexos = response.data['sexos'].original
                    this.ocupaciones = response.data['ocupaciones'].original
                    this.estadosCiviles = response.data['estadosciviles'].original
                    this.escolaridades = response.data['escolaridades'].original
                    this.religiones = response.data['religiones'].original
                    this.identificaciones = response.data['identificaciones'].original
                    this.interpretes = response.data['interpretes'].original
                });
            },
            searchPersona: function(){
                if(this.nombres!='' && this.primerAp!='' && this.segundoAp!='' && this.fechaNacimiento!=''){
                    var urlRfcFisico = this.url+'/rfcFisico';
                    axios.post(urlRfcFisico,{
                        nombres: this.nombres,
                        primerAp: this.primerAp,
                        segundoAp: this.segundoAp,
                        fechaNacimiento: this.fechaNacimiento
                    }).then(response =>{                                            
                        this.rfc = response.data.res.slice(0, -3);                        
                        this.homoclave=response.data.res.slice(-3);
                        var urlBuscarPersona = this.url+'/searchPersonaFisica';
                        axios.post(urlBuscarPersona,{
                            rfc: this.rfc
                        }).then(response => {
                            this.personaExiste=response.data
                            if(this.personaExiste!=''){
                                swal({
                                    title: '¡Persona Encontrada!',
                                    text: 'Ésta persona ya fue registrada anteriormente.',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                this.nombres= this.personaExiste.nombres,
                                this.primerAp=this.personaExiste.primerAp,
                                this.segundoAp=this.personaExiste.segundoAp,
                                // this.fechaNacimiento=this.personaExiste.fechaNacimiento,
                                this.edad=this.personaExiste.edad,
                                this.sexo=this.personaExiste.sexo,
                                this.rfc=this.personaExiste.rfc,
                                this.curp=this.personaExiste.curp,
                                this.nacionalidad=this.personaExiste.idNacionalidad,
                                this.estado=this.personaExiste.idEstado
                                this.municipio=this.personaExiste.idMunicipioOrigen,
                                this.etnia=this.personaExiste.idEtnia,
                                this.lengua=this.personaExiste.idLengua,
                                this.interprete=this.personaExiste.idInterprete,
                                this.motivoEstancia=this.personaExiste.motivoEstancia,
                                this.ocupacion=this.personaExiste.idOcupacion,
                                this.estadoCivil=this.personaExiste.idEstadoCivil,
                                this.escolaridad=this.personaExiste.idEscolaridad,
                                this.religion=this.personaExiste.idReligion,
                                this.identificacion=this.personaExiste.docIdentificacion,
                                this.numIdentificacion=this.personaExiste.numDocIdentificacion
                                this.alias=this.personaExiste.alias
                            }
                        })
                    });
                }
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    // this.municipio=null
                    var urlMunicipios = this.url+'/getMunicipios/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    // this.municipio=null,
                    this.municipios=[]
                }
            },
            generarCurp: function(){
                console.log("generacurp");
                var sex='';
                var edoArray= ['AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG', 'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 'YN', 'ZS', 'NE'	];
                var edo='';
                if( (this.sexo!=null)&&(this.sexo!=undefined) ) {
                    switch (this.sexo.id){
                        case 1:
                            sex='H';
                            break;
                        case 2:
                            sex="M";
                            break;
                        default:
                            sex='';
                    }
                }
                if(this.nombres!='' && this.primerAp!='' && this.segundoAp!='' && this.fechaNacimiento!='' && this.estado!=null &&this.estado!='' && this.sexo!=undefined & this.sexo!=null){
                    edo=edoArray[this.estado.id-1];
                    var fecha = this.fechaNacimiento;
                    var arr = fecha.split('-');
                    var curpAuto = generaCurp({
                        nombre            : this.nombres,
                        apellido_paterno  : this.primerAp,
                        apellido_materno  : this.segundoAp,
                        sexo              : sex,
                        estado            : edo,
                        fecha_nacimiento  : [arr[2], arr[1], arr[0]]
                    });
                    if(curpAuto)
                        this.curp=curpAuto;
                }
            },
            generarEdad: function() {
                var hoy = new Date();
                var fecha = new Date(this.fechaNacimiento);
                var feArr = this.fechaNacimiento;
                var fechaR = feArr.split('-');
                var edad = ( hoy.getFullYear() - fechaR[0] );
                if(isNaN( edad )){
                    this.edad='';
                }else{
                    if( edad>=16 ){
                        if( ( fechaR[2] == hoy.getDate() || (fechaR[2] <= hoy.getDate()) ) && ( fecha.getMonth() == hoy.getMonth() ) ){
                            this.edad=edad;
                            //console.log("PRIMER IF")
                            //console.log("fechaR Dia:"+fechaR[2]+" Mes: "+hoy.getMonth()+" FECHA Dia: "+fecha.getDate()+" Mes: "+fecha.getMonth()+"")
                        }else{
                            if( ( (fechaR[2] >= hoy.getDate()) || (fechaR[2] < hoy.getDate()) ) && ( fecha.getMonth() >= hoy.getMonth() ) ){
                                edad--;
                                this.edad=edad;
                                //console.log("SEGUNDO IF")
                                //console.log("fechaR Dia:"+fechaR[2]+" Mes: "+hoy.getMonth()+" FECHA Dia: "+fecha.getDate()+" Mes: "+fecha.getMonth()+"")
                            }else{
                                if( ( (fechaR[2] <= hoy.getDate()) || (fechaR[2] >= hoy.getDate()) ) && ( fecha.getMonth() <= hoy.getMonth() ) ){
                                    this.edad=edad;
                                    //console.log("TERCER IF")
                                    //console.log("fechaR Dia:"+fechaR[2]+" Mes: "+hoy.getMonth()+" FECHA Dia: "+fecha.getDate()+" Mes: "+fecha.getMonth()+"")
                                }
                            }
                        }
                    }else{
                        this.edad=16;
                    }
                }
            },
            getValidaciones: function(){
                var urlValidaciones = this.url+'/getValidaciones';
                axios.post(urlValidaciones, {
                    sistema: this.sistema,
                    tipo: this.tipo
                })
                .then (response =>{
                    this.validaciones = response.data
                    // console.log(this.validaciones.nombres)
                    this.nombresV= this.validaciones.nombres,
                    this.primerApV=this.validaciones.primerAp,
                    this.segundoApV=this.validaciones.segundoAp,
                    this.fechaNacimientoV=this.validaciones.fechaNacimiento,
                    this.rfcV=this.validaciones.rfc,
                    this.curpV=this.validaciones.curp,
                    this.sexoV=this.validaciones.sexo,
                    this.nacionalidadV=this.validaciones.idNacionalidad,
                    this.etniaV=this.validaciones.idEtnia,
                    this.lenguaV=this.validaciones.idLengua,
                    this.municipioV=this.validaciones.idMunicipioOrigen,
                    this.edadV=this.validaciones.edad,
                    this.motivoEstanciaV=this.validaciones.motivoEstancia,
                    this.ocupacionV=this.validaciones.idOcupacion,
                    this.estadoCivilV=this.validaciones.idEstadoCivil,
                    this.escolaridadV=this.validaciones.idEscolaridad,
                    this.religionV=this.validaciones.idReligion,
                    this.identificacionV=this.validaciones.docIdentificacion,
                    this.interpreteV=this.validaciones.idInterprete,
                    this.numIdentificacionV=this.validaciones.numDocIdentificacion
                    this.aliasV=this.validaciones.alias
                    this.telefonoV=this.validaciones.telefono
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearPersona();
                        return;
                    }
                    swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
            },
            CleanFields() {
                this.nacionalidad={ "nombre": "MEXICANA", "id": 1 },
                this.estado={ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                this.municipio=null,
                this.etnia={ "nombre": "SIN INFORMACIÓN", "id": 13 },
                this.lengua={ "nombre": "SIN INFORMACIÓN", "id": 69 },
                this.interprete={ "nombre": "SIN INFORMACIÓN", "id": 1 },
                this.nombres='',
                this.primerAp='',
                this.segundoAp='',
                this.fechaNacimiento='',
                this.edad='',
                this.sexo=null,
                this.rfc='',
                this.curp='',
                this.motivoEstancia='',
                this.ocupacion='',
                this.estadoCivil='',
                this.escolaridad='',
                this.religion='',
                this.identificacion='',
                this.numIdentificacion='',
                this.alias='',
                this.telefono='',
                this.$validator.reset();
            },
            crearPersona: function(){
                var urlCrearPersona = this.url+'/'+this.tipo+this.sistema;
                    var data = {
                        nombres:this.nombres.toUpperCase(),
                        primerAp:this.primerAp.toUpperCase(),
                        segundoAp:this.segundoAp.toUpperCase(),
                        fechaNacimiento:this.fechaNacimiento,
                        edad:this.edad,
                        sexo:this.sexo.id,
                        rfc:this.rfc,
                        homoclave:this.homoclave,
                        curp:this.curp,
                        nacionalidad:this.idNacionalidad.id,
                        municipio:this.idMunicipioOrigen.id,
                        etnia:this.idEtnia.id,
                        lengua:this.idLengua.id,
                        interprete:this.idInterprete.id,
                        motivoEstancia:this.motivoEstancia.toUpperCase(),
                        ocupacion:this.idOcupacion.id,
                        estadoCivil:this.idEstadoCivil.id,
                        escolaridad:this.idEscolaridad.id,
                        religion:this.idReligion.id,
                        identificacion:this.docIdentificacion.id,
                        numIdentificacion:this.numDocIdentificacion.toUpperCase(),
                        alias:this.alias.toUpperCase(),
                        telefono:this.telefono
                    };
                axios.post(urlCrearPersona,data)
                .then (response =>{
                    console.log(response.data)
                    swal({
                        title: '¡Guardado correctamente!',
                        text: 'Ésta empresa fue guardada exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    })
                }).catch((error)=>{
                    console.log(error.response.data.errors);
                    swal({
                    title: '¡Guardado incorrecto!',
                    text: 'Ésta persona moral no fue posible guardarla.',
                    type: 'error',
                    confirmButtonText: 'Ok'
                    })
                });
            }
        },
       watch:{
            sexo : function (val, oldval) {
                this.generarCurp();
            },
            estado : function (val, oldval) {
                this.generarCurp();
            }
        }
    }
</script>
<style>
.dropdown-toggle{
    height: 36px;
    overflow: hidden;
}
input{
    text-transform: uppercase
}
input.form-control{
    width: 100% !important;
}
.dropdown{
    font-family: inherit;
    font-size: .875rem;
}
</style>