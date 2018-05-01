<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="crearPersona">
            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nombres">Nombre</label>
                    <input type="text" class="form-control" id="nombres" :value="nombres | uppercase" @input="nombres = $event.target.value" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group col-md-3">
                    <label for="primerAp">Primer Apellido</label>
                    <input type="text" class="form-control" id="primerAp" :value="primerAp | uppercase" @input="primerAp = $event.target.value" placeholder="Ingrese el primer apellido">
                </div>
                <div class="form-group col-md-3">
                    <label for="segundoAp">Segundo Apellido</label>
                    <input type="text" class="form-control" id="segundoAp" :value="segundoAp | uppercase" @input="segundoAp = $event.target.value" placeholder="Ingrese el segundo apellido">
                </div>
                <div class="form-group col-md-3">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="sexo">Sexo</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="hombre" style="padding-right: 5px">Hombre</label>
                            <input class="form-check-input" type="radio" v-model="sexo" id="hombre" value="HOMBRE">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="mujer" style="padding-right: 5px">Mujer</label>
                            <input class="form-check-input" type="radio" v-model="sexo" id="mujer" value="MUJER">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="rfc">R.F.C</label>
                    <input type="text" class="form-control" id="rfc" :value="rfc | uppercase" @input="rfc = $event.target.value" placeholder="R.F.C">
                </div>
                <div class="form-group col-md-3">
                    <label for="rfc">Curp</label>
                    <input type="text" class="form-control" id="curp" :value="curp | uppercase" @input="curp = $event.target.value" placeholder="Curp">
                </div>
                <div class="form-group col-md-3">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <v-select label="nombre" :options="nacionalidades" v-model="nacionalidad" placeholder="Seleccione una nacionalidad" class="select">                    </v-select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Estados</label>    
                    <v-select label="nombre" :options="estados" v-model="estado" @input="getMunicipios" placeholder="Seleccione un estado" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipio de Origen</label>    
                    <v-select label="nombre" :options="municipios" v-model="municipio" placeholder="Seleccione un municipio" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="etnia">Etnia</label>    
                    <v-select label="nombre" :options="etnias" v-model="etnia" placeholder="Seleccione una etnia" class="select"></v-select>
                </div>
                <div class="form-group col-md-3">
                    <label for="lengua">Lengua</label>    
                    <v-select label="nombre" :options="lenguas" v-model="lengua" placeholder="Seleccione una lengua" class="select"></v-select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="esEmpresa">Es Empresa</label>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="si" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" v-model="esEmpresa" id="si" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="no" style="padding-right: 5px">No</label>
                        <input class="form-check-input" type="radio" v-model="esEmpresa" id="no" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">Guardar</button>
            <!-- <h1>{{(etnia!=null)?etnia.id:etnia}}</h1> -->
        </form>
    </div>
</template>

<script>
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import swal from 'sweetalert2'
    export default {
       data(){
           return{
               nacionalidades: [],
               estados: [],
               municipios: [],
               etnias: [],
               lenguas: [],
               nombres: '',
               primerAp: '',
               segundoAp: '',
               fechaNacimiento: '',
               sexo: '',
               rfc:'',
               curp: '',
               nacionalidad:{ "nombre": "MEXICANA", "id": 1 },
               estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
               municipio:null,
               etnia:{ "nombre": "SIN INFORMACIÓN", "id": 13 },
               lengua:{ "nombre": "SIN INFORMACIÓN", "id": 69 },
               esEmpresa: ''
           }
       },
       mounted: function(){
           this.getNacionalidades();
           this.getEstados();
           this.getEtnias();
           this.getLenguas();
       },
        filters:{
            uppercase: function (str) {
                return str.toUpperCase()
            }
        },
        methods:{
            getNacionalidades: function(){
                var urlNacionalidades = 'getNacionalidades';
                axios.get(urlNacionalidades).then(response => {
                    this.nacionalidades = response.data
                });
            },
            getEstados: function(){
                var urlEstados = 'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                this.municipio=null
                var urlMunicipios = 'getMunicipios/'+this.estado.id;
                axios.get(urlMunicipios).then(response => {
                    this.municipios = response.data
                });
            },
            getEtnias: function(){
                var urlEtnias = 'getEtnias';
                axios.get(urlEtnias).then(response => {
                    this.etnias = response.data
                });
            },
            getLenguas: function(){
                var urlLenguas = 'getLenguas';
                axios.get(urlLenguas).then(response => {
                    this.lenguas = response.data
                });
            },
            crearPersona: function(){
                var urlPersona = 'addPersona';
                axios.post(urlPersona,{
                    nombres: this.nombres,
                    primerAp: this.primerAp,
                    segundoAp: this.segundoAp,
                    fechaNacimiento: this.fechaNacimiento,
                    sexo: this.sexo,
                    rfc:this.rfc,
                    curp: this.curp,
                    nacionalidad: this.nacionalidad.id,
                    municipio: this.municipio.id,
                    etnia: this.etnia.id,
                    lengua: this.lengua.id,
                    esEmpresa: this.esEmpresa
                }).then(response => {
                    this.nacionalidad=null,
                    this.estado=null,
                    this.municipio=null,
                    this.etnia=null,
                    this.lengua=null,
                    this.nombres='',
                    this.primerAp='',
                    this.segundoAp='',
                    this.fechaNacimiento='',
                    this.sexo='',
                    this.rfc='',
                    this.curp='',
                    this.esEmpresa=''
                    swal({
                        title: 'Guardado Correctamente!',
                        text: 'Esta persona fue guardada exitosamente',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    })
                }).catch(error => {
                     swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Esta persona no fue posible guardarla',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                })
            }
       }
    }
</script>
<style>
.select{
    font-family: inherit
}
.form-control:focus {
  color: #6d6d6d;
  background-color: #fff;
  border-color: #828282;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(66, 66, 66, 0.25);
}
button{
    background-color: #424242;
    border-color: #424242;
    color: white;
}
</style>