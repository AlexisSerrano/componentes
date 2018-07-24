<template>
    <div class="container-fluid">
    
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
    
    
                <div v-if="sistema=='uipj'" class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="puesto">Puesto</label>
                    <v-select :options="puestos" label="nombre" v-model="puesto" name="puesto" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('puesto')}" placeholder="Seleccione un puesto"></v-select>
                    <span v-show="errors.has('puesto')" class="text-danger">{{ errors.first('puesto')}}</span>
                </div>
    
                <div v-if="this.empresa==false" class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="alias">Alias</label>
                    <input type="text" name="alias" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('alias')}" v-model="alias" placeholder="Ingrese el alias" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('alias')" class="text-danger">{{ errors.first('alias')}}</span>
                </div>
    
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="dependientes">Dependientes económicos</label>
                    <input type="number" name="dependientes" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('dependientes')}" v-model="dependientes" placeholder="dependientes" v-validate="'required|numeric'">
                    <span v-show="errors.has('dependientes')" class="text-danger">{{ errors.first('dependientes')}}</span>
                </div>
    
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="ingreso">Ingreso</label>
                    <input type="text" name="ingreso" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('ingreso')}" v-model="ingreso" placeholder="Ingrese el ingreso" v-validate="'required|numeric'" autocomplete="off">
                    <span v-show="errors.has('ingreso')" class="text-danger">{{ errors.first('ingreso')}}</span>
                </div>
    
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="periodo">Periodo de ingreso</label>
                    <v-select :options="periodos" label="nombre" v-model="periodo" name="periodo" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('periodo')}" placeholder="Seleccione un periodo"></v-select>
                    <span v-show="errors.has('periodo')" class="text-danger">{{ errors.first('periodo')}}</span>
                </div>
    
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="residencia">Residencia anterior</label>
                    <input class="form-control form-control-sm" type="text" name="residencia" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('residencia')}" v-model="residencia" placeholder="Ingrese la residencia" v-validate="'required'"
                        autocomplete="off">
                    <span v-show="errors.has('residencia')" class="text-danger">{{ errors.first('residencia')}}</span>
                </div>
    
                <div class="form-group col-md-3">
                    <div>
                        <label class="col-form-label col-form-label-sm" for="residencia">¿Perseguido penalmente?</label>
                    </div>
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="perseguidoSi" style="padding-right: 5px">Si</label>
                            <input class="form-check-input" type="radio" v-model="perseguido" id="perseguidoSi" value="1" name="perseguido" v-validate="'required'">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="perseguidoNo" style="padding-right: 5px">No</label>
                            <input class="form-check-input" type="radio" v-model="perseguido" id="perseguidoNo" value="0" name="perseguido" v-validate="'required'">
                        </div>
                    </div>
                    <div>
                        <span v-show="errors.has('perseguido')" class="text-danger">{{ errors.first('perseguido')}}</span>
                    </div>
                </div>
    
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="vestimenta">Vestimenta</label>
                    <input class="form-control form-control-sm" type="text" name="vestimenta" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('vestimenta')}" v-model="vestimenta" placeholder="Ingrese la vestimenta" v-validate="'required'"
                        autocomplete="off">
                    <span v-show="errors.has('vestimenta')" class="text-danger">{{ errors.first('vestimenta')}}</span>
                </div>
    
                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="particulares">Señas particulares</label>
                    <textarea class="form-control form-control-sm" data-vv-name="señas particulares" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('señas particulares')}" v-model="particulares" placeholder="Ingrese las señas particulares"
                        v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('señas particulares')" class="text-danger">{{ errors.first('señas particulares')}}</span>
                </div>
                <div v-if="sistema!='uipj'" class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="descripcion">Descripcion de los hechos</label>
                    <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcion')}" v-model="descripcion" placeholder="Ingrese la descripción de los hechos"
                        v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('descripcion')" class="text-danger">{{ errors.first('descripcion')}}</span>
                </div>
            </div>
    
    
            <button type="submit" class="btn btn-primary">Guardar</button>
    
    
        </form>
    </div>
</template>

<script>
    import urlComponentes from '../../urlComponentes'
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                puesto: '',
                alias: '',
                dependientes: '',
                ingreso: '',
                periodo: '',
                residencia: '',
                perseguido: '',
                vestimenta: '',
                particulares: '',
                descripcion: '',
                systemUser: 'TEST',
                puestos: [],
                periodos: ['DIARIO', 'SEMANAL', 'QUINCENAL', 'MENSUAL'],
                url: urlComponentes
            }
        },
        props: ['sistema', 'empresa', 'carpeta', 'idcarpeta'],
        created() {
            this.getPuestos();
        },
        methods: {
            getPuestos() {
                if (this.sistema == 'uipj') {
                    var urlPuestos = this.url + '/getPuestos';
                    axios.post(urlPuestos).then(response => {
                        this.puestos = response.data
                    });
                }
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtra();
                        return;
                    }
                    swal({
                        title: '¡Aún no es posible guardar!',
                        text: 'Ingrese los campos obligatorios',
                        type: 'warning',
                        confirmButtonText: 'Ok'
                    });
                });
            },
            guardarExtra: function() {
                var urlGuardarDenunciado = this.url + '/addExtrasDenunciado'
                if (this.empresa == false) {
                    var idPersona = this.$store.state.idPersonaFisica
                } else {
                    var idPersona = this.$store.state.idPersonaMoral
                }
                var data = {
                    idExtrasDenunciado: this.$store.state.idExtra,
                    empresa: this.empresa,
                    idPersona: idPersona,
                    idPuesto: this.puesto.id,
                    alias: (this.alias) ? this.alias.toUpperCase() : '',
                    dependientes: this.dependientes,
                    ingreso: this.ingreso,
                    periodoIngreso: this.periodo,
                    residenciaAnterior: this.residencia.toUpperCase(),
                    perseguidoPenalmente: this.perseguido,
                    vestimenta: this.vestimenta.toUpperCase(),
                    particulares: this.particulares.toUpperCase(),
                    sistema: this.sistema,
                    usuario: this.systemUser,
                    narracion: this.descripcion.toUpperCase(),
                    carpeta: this.carpeta,
                    idCarpeta: this.idcarpeta,
                    tipo: 'denunciado'
                };
                axios.post(urlGuardarDenunciado, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
                            //this.$store.commit('cleanStore') 
                            swal({
                                    title: 'Investigado guardado correctamente!',
                                    text: 'Haz finalizado el registro del investigado exitosamente.',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                .then((result) => {
                                    if (result.value) {
                                        window.location.href = window.location;
                                    }
                                })
                        } else {
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'No fue posible guardar.',
                                type: 'error',
                                confirmButtonText: 'Ok',
                            })
                        }
                    }).catch((error) => {
                        swal({
                            title: '¡Guardado incorrecto!',
                            text: 'No fue posible guardar.',
                            type: 'error',
                            confirmButtonText: 'Ok',
                        })
                    });
            },
            CleanFields() {
                this.puesto = '',
                    this.alias = '',
                    this.dependientes = '',
                    this.ingreso = '',
                    this.periodo = '',
                    this.residencia = '',
                    this.perseguido = '',
                    this.vestimenta = '',
                    this.particulares = '',
                    this.descripcion = '',
                    this.$validator.reset();
            }
        }
    }
</script>