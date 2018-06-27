<template>

    <div class="container-fluid">

        <spring-spinner v-if="loader" class="centrar" :animation-duration="1500" :size="60" :color="'#828282'"/>
        <form v-on:submit.prevent="validateBeforeSubmit" v-if="loader!=true">
            
            <div class="form-row">


            </div>
            <button type="submit" class="btn btn-primary mt-2">Guardar</button>

        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
import { SpringSpinner } from 'epic-spinners'
import { mapState } from "vuex";
    export default {
        data(){
            return{
                estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                municipio:null,
                localidad:null,
                codigoPostal:null,
                colonia:null,
                estados: [],
                municipios: [],
                localidades: [],
                codigosPostales: [],
                colonias: [],
                calle: '',
                numExterno: '',
                numInterno: '',
                validacionesback:'',
                idDomicilio:'',
                loader:true,
                telefono:'',
                lugarTrabajo:'',
                correo:'',
                url:'/'
            }
        },
        props:{
            tipo:{
                required:true
            },
            empresa:{
                required:true
            }
        },
        components: {SpringSpinner},
        mounted: function () {
            this.getEstados()
        },
        methods:{
            getEstados: function(){
                var urlEstados = this.url+'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                    var self=this;
                    setTimeout(function(){ self.loader=false; }, 1100);                });
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    this.municipio=null,
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null
                    var urlMunicipios = this.url+'getMunicipios/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    this.municipio=null,
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null,
                    this.municipios=[],
                    this.localidades=[],
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getLocalidades: function(){
                if(this.municipio!=null){
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null
                    var urlLocalidades = this.url+'getLocalidades/'+this.municipio.id;
                    axios.get(urlLocalidades).then(response => {
                        this.localidades = response.data
                    });
                }
                else{
                    this.localidad=null,
                    this.codigoPostal=null,
                    this.colonia=null,
                    this.localidades=[],
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getCodigosPostales: function(){
                if(this.municipio!=null){
                    this.codigoPostal=null
                    this.colonia=null
                    var urlCodigosPostales = this.url+'getCodigosPostales/'+this.municipio.id;
                    axios.get(urlCodigosPostales).then(response => {
                        this.codigosPostales = response.data
                    });
                }
                else{
                    this.codigoPostal=null,
                    this.colonia=null
                    this.codigosPostales=[],
                    this.colonias=[]
                }
            },
            getColonias: function(){
                if(this.codigoPostal!=null){
                    this.colonia=null
                    var urlColonias = this.url+'getColonias/'+this.codigoPostal.id;
                    axios.get(urlColonias).then(response => {
                        this.colonias = response.data
                    });
                }
                else{
                    this.colonia=null,
                    this.colonias=[]
                }
            },
            CleanFields() {
                this.calle='',
                this.numExterno='',
                this.numInterno='',
                this.estado={ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                this.municipio=null,
                this.localidad=null,
                this.codigoPostal=null,
                this.colonia=null
                this.$validator.reset();
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearDomicilio();
                        return;
                    }
                    swal({
                        title: '¡Guardado Incorrecto!',
                        text: 'Éste domicilio no fue posible guardarse.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            crearDomicilio: function(){
                this.validacionesback='';
                var urlDomicilio = this.url+'addDomicilio';
                if(this.empresa==false){
                    var idPersona=this.$store.state.idPersonaFisica
                }
                else{
                    var idPersona=this.$store.state.idPersonaMoral
                }
                if(this.tipo=='domicilio'){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase(),
                        tipo: this.tipo,
                        empresa: this.empresa,
                        idPersona: idPersona,
                        claveDomicilio: this.$store.state.idDomicilio
                    };
                }
                else if (this.tipo=='trabajo'){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase(),
                        telefonoTrabajo: this.telefono,
                        lugarTrabajo: this.lugarTrabajo.toUpperCase(),
                        tipo: this.tipo,
                        empresa: this.empresa,
                        idPersona: idPersona,
                        claveDomicilio: this.$store.state.idTrabajo
                    };
                }
                else if(this.tipo=='contacto'){
                    var data={
                        estado: this.estado.id,
                        municipio: this.municipio.id,
                        localidad: this.localidad.id,
                        colonia: this.colonia.id,
                        codigoPostal: this.codigoPostal.id,
                        calle: this.calle.toUpperCase(),
                        numExterno: this.numExterno.toUpperCase(),
                        numInterno: this.numInterno.toUpperCase(),
                        telefonoContacto: this.telefono,
                        correoContacto: this.correo.toUpperCase(),
                        tipo: this.tipo,
                        empresa: this.empresa,
                        idPersona: idPersona,
                        claveDomicilio: this.$store.state.idContacto
                    };
                }
                axios.post(urlDomicilio,data).then((response)=>{
                    console.log(response);
                    this.$store.commit('asignarIdDomicilio',{tipo:this.tipo,idDomicilio:response.data})
                    swal({
                        title: '¡Guardado Correctamente!',
                        text: 'Éste domicilio fue guardado exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.validacionesback = error.response.data.errors
                        swal({
                            title: '¡Guardado Incorrecto!',
                            text: 'Éste domicilio no fue posible guardarse.',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })
                    })
                })
            }
        },
        computed: mapState(['idPersonaFisica','idPersonaMoral','personaExiste'])
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
.centrar{
    position: absolute;
    top:50%;
    left:50%;
    margin-left: -30px;
    margin-top: -30px;
}
</style>