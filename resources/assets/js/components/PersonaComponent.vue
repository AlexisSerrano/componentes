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
                    <select class="nacionalidad" id="nacionalidad" style="width: 100%">
                        <option value="0">Seleccione nacionalidad</option>
                        <option v-for="nacionalidad in nacionalidades" :value="nacionalidad.id" :key="nacionalidad.id">{{nacionalidad.nombre}}</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="estado">Estados</label>    
                    <select class="estado" id="estado" style="width: 100%">
                        <option value="0">Seleccione estado</option>
                        <option v-for="estado in estados" :value="estado.id" :key="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="municipio">Municipio de Origen</label>    
                    <select class="municipio" id="municipio" style="width: 100%">
                        <option value="0">Seleccione municipio</option>
                        <option v-for="municipio in municipios" :value="municipio.id" :key="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="etnia">Etnia</label>    
                    <select class="etnia" id="etnia" style="width: 100%">
                        <option value="0">Seleccione etnia</option>
                        <option v-for="etnia in etnias" :value="etnia.id" :key="etnia.id">{{etnia.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="lengua">Lengua</label>    
                    <select class="lengua" id="lengua" style="width: 100%">
                        <option value="0">Seleccione lengua</option>
                        <option v-for="lengua in lenguas" :value="lengua.id" :key="lengua.id">{{lengua.nombre}}</option>
                    </select>
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

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>

<script>
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
               nacionalidad: '',
               estado: '',
               municipio: '',
               etnia: '',
               lengua: '',
               esEmpresa: ''
           }
       },
       created: function(){
           this.getNacionalidades();
           this.getMunicipios();
           this.getEtnias();
           this.getLenguas();
           this.getEstados();
       },
        mounted() {
            $("select").select2({
                placeholder:"Seleccione una opción"
            });
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
                var urlMunicipios = 'getMunicipios';
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
                var nacionalidadS = $("#nacionalidad").select2('data')[0].id;
                var municipioS = $("#municipio").select2('data')[0].id;
                var etniaS = $("#etnia").select2('data')[0].id;
                var lenguaS = $("#lengua").select2('data')[0].id;
                axios.post(urlPersona,{
                    nombres: this.nombres,
                    primerAp: this.primerAp,
                    segundoAp: this.segundoAp,
                    fechaNacimiento: this.fechaNacimiento,
                    sexo: this.sexo,
                    rfc:this.rfc,
                    curp: this.curp,
                    nacionalidad: nacionalidadS,
                    municipio: municipioS,
                    etnia: etniaS,
                    lengua: lenguaS,
                    esEmpresa: this.esEmpresa
                }).then(response => {
                    $('select').val(0).trigger('change');
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

</style>
