<template>
    <div class="container-fluid">
    
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
    
                <div :class="'form-group col-md-4'">
                    <label class="col-form-label col-form-label-sm" for="nombre">Nombre</label>
                    <input class="form-control form-control-sm" type="text" name="nombre" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombre') || this.validacionesback.nombre}" v-model="nombre" placeholder="Ingrese el nombre" v-validate="'required'"
                        autocomplete="off" @blur="calcularRfc" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre')}}</span>
                    <span v-if="this.validacionesback.nombre!=undefined" class="text-danger">{{ String(this.validacionesback.nombre)}}</span>
                </div>
                <div v-if="this.tipo!='conocidomoral'" :class="'form-group col-md-4'">
                    <label class="col-form-label col-form-label-sm" for="fechaCreacion">Fecha de creación</label>
                    <input class="form-control form-control-sm" type="date" v-model="fechaCreacion" name="fechaCreacion" data-vv-name="fecha de creación" v-validate="'required|date_format:YYYY-MM-DD|before:' + today" :class="{ 'border border-danger': errors.has('fecha de creación') || this.validacionesback.fechaCreacion}"
                        @blur="calcularRfc" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('fecha de creación')" class="text-danger">{{ errors.first('fecha de creación')}}</span>
                    <span v-if="this.validacionesback.fechaCreacion!=undefined" class="text-danger">{{ String(this.validacionesback.fechaCreacion)}}</span>
                </div>
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="rfc">RFC</label>
                    <input type="text" name="rfc" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('rfc') || this.validacionesback.rfc}" v-model="rfc" placeholder="Ingrese el RFC" v-validate="'required'" autocomplete="off" @blur="searchPersona"
                        :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('rfc')" class="text-danger">{{ errors.first('rfc')}}</span>
                    <span v-if="this.validacionesback.rfc!=undefined" class="text-danger">{{ String(this.validacionesback.rfc)}}</span>
                </div>
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-2">
                    <label class="col-form-label col-form-label-sm" for="homoclave">Homoclave</label>
                    <input type="text" name="homoclave" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('homoclave') || this.validacionesback.homo}" v-model="homoclave" placeholder="Homoclave" v-validate="'required'" autocomplete="off"
                        @blur="searchPersona" :readonly="this.$store.state.moralEncontrada==true">
                    <span v-show="errors.has('homoclave')" class="text-danger">{{ errors.first('homoclave')}}</span>
                    <span v-if="this.validacionesback.homo!=undefined" class="text-danger">{{ String(this.validacionesback.homo)}}</span>
                </div>
    
    
                <div v-if="this.tipo!='conocidomoral'" :class="'form-group col-md-4'">
                    <label class="col-form-label col-form-label-sm" for="telefono">Teléfono</label>
                    <input class="form-control form-control-sm" type="text" name="teléfono" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('teléfono') || this.validacionesback.telefono}" v-model="telefono" placeholder="Ingrese el teléfono"
                        v-validate="'required|numeric'" autocomplete="off">
                    <span v-show="errors.has('teléfono')" class="text-danger">{{ errors.first('teléfono')}}</span>
                    <span v-if="this.validacionesback.telefono!=undefined" class="text-danger">{{ String(this.validacionesback.telefono)}}</span>
                </div>
    
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nombresRep">Nombres del representante</label>
                    <input type="text" name="nombresRep" data-vv-name="nombre del representante" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('nombre del representante')}" v-model="nombresRep" placeholder="Ingrese los nombre del representante"
                        v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('nombre del representante')" class="text-danger">{{ errors.first('nombre del representante')}}</span>
                </div>
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="primerApRep">Primer apellido del representante</label>
                    <input type="text" name="primerApRep" data-vv-name="primer apellido del representante" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('primer apellido del representante')}" v-model="primerApRep" placeholder="Ingrese el primer apellido del representante"
                        v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('primer apellido del representante')" class="text-danger">{{ errors.first('primer apellido del representante')}}</span>
                </div>
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="segundoApRep">Segundo apellido del representante</label>
                    <input type="text" name="segundoApRep" data-vv-name="segundo apellido del representante" class="input form-control form-control-sm" v-model="segundoApRep" placeholder="Ingrese el segundo apellido del representante" autocomplete="off">
                </div>
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="identificacion">Identificación</label>
                    <v-select :options="identificaciones" label="documento" v-model="identificacion" name="Identificación" v-validate="(this.tipo=='denunciantemoral')?'required':''" :class="{ 'border border-danger rounded': errors.has('Identificación')}" placeholder="Seleccione una Identificación"></v-select>
                    <span v-if="this.tipo=='denunciantemoral'" v-show="errors.has('Identificación')" class="text-danger">{{ errors.first('Identificación')}}</span>
                </div>
    
                <div v-if="this.tipo!='conocidomoral'" class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="número de identificación">Número de identificación</label>
                    <input type="text" v-model="numIdentificacion" placeholder="Ingrese el número de identificación" name="número de identificación" v-validate="(this.tipo=='denunciantemoral')?'required':''" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('número de identificación')}"
                        autocomplete="off">
                    <span v-if="this.tipo=='denunciantemoral'" v-show="errors.has('número de identificación')" class="text-danger">{{ errors.first('número de identificación')}}</span>
                </div>
    
            </div>
    
    
            <button type="submit" class="btn btn-primary mt-2">{{botonGuardarModificar}}</button>
    
    
    
        </form>
    </div>
</template>

<script>
    import urlComponentes from '../../urlComponentes'
    import swal from 'sweetalert2'
    import moment from 'moment'
    import {
        mapState
    } from "vuex";
    export default {
        data() {
            return {
                identificaciones: [],
                today: moment().format('YYYY-MM-DD'),
                nombre: '',
                fechaCreacion: '',
                rfc: '',
                descripcion: '',
                homoclave: '',
                telefono: '',
                personaExiste: '',
                validacionesback: '',
                identificacion: '',
                numIdentificacion: '',
                nombresRep: '',
                primerApRep: '',
                segundoApRep: '',
                url: urlComponentes
            }
        },
        props: ['sistema', 'tipo', 'usuario', 'idvarpersona'],
        created: function() {
            this.getIdentificaciones();
            this.cargarEdicion()
        },
        methods: {
            searchPersona: function() {
                if (this.$store.state.moralEncontrada == true || this.$store.state.idPersonaMoral) {
                    return
                }
                if (this.rfc.length == 9 && this.homoclave.length == 3) {
                    var urlBuscarPersona = this.url + '/searchPersonaMoral';
                    axios.post(urlBuscarPersona, {
                        rfc: this.rfc + this.homoclave
                    }).then(response => {
                        this.personaExiste = response.data
                        if (this.personaExiste != '') {
                            this.$store.commit('asignarIdMoral', {
                                idPersona: '',
                                idTemporal: this.personaExiste.idVarPersona,
                                moralEncontrada: true,
                                personaMoral: this.personaExiste.idPersona
                            })
                            this.$store.commit('asignarDomiciliosTemporales', {
                                idDomicilioTemporal: this.personaExiste.idDomicilio,
                                idContactoTemporal: this.personaExiste.idDomicilioNotificacion
                            })
                            swal({
                                title: '¡Persona moral encontrada!',
                                text: 'Ésta persona moral ya fue registrada anteriormente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            this.nombre = this.personaExiste.nombre,
                                this.fechaCreacion = this.personaExiste.fechaCreacion,
                                this.rfc = this.personaExiste.rfc.slice(0, -3),
                                this.homoclave = this.personaExiste.rfc.slice(-3),
                                this.telefono = this.personaExiste.telefono,
                                this.nombresRep = this.personaExiste.nombreRep,
                                this.primerApRep = this.personaExiste.primerApRep,
                                this.segundoApRep = this.personaExiste.segundoApRep,
                                this.identificacion = this.personaExiste.docIdentificacion,
                                this.numIdentificacion = this.personaExiste.numDocIdentificacion
                        }
                    });
                }
            },
			cargarEdicion() {
				if (this.idvarpersona) {
					var urlGetPersonasEdit = this.url + '/getPersonaEdit'
					axios.post(urlGetPersonasEdit, {
							idVarPersona: this.idvarpersona,
							tipo: this.tipo,
							esEmpresa: true
						})
						.then((response) => {
							console.log(response.data)
							this.$store.commit('asignarDataEditMoral', response.data)
							this.personaExiste = response.data.persona.original
							this.fillFields()
						})
						.catch((error) => {
							swal({
								title: '¡Algo salio mal!',
								text: 'No fue posible cargar los datos para edición.',
								type: 'error',
								confirmButtonText: 'Entendido'
							})
						})
				}
			},
            calcularRfc() {
                if (this.nombre != '' && this.fechaCreacion != '') {
                    if (this.nombre.length < 2) {
                        swal({
                            title: '¡Ingrese otro nombre!',
                            text: 'Para calcular el rfc el nombre debe contener mas caracteres.',
                            type: 'warning',
                            confirmButtonText: 'Ok'
                        })
                        return
                    }
                    var urlRfcMoral = this.url + '/rfcMoral';
                    axios.post(urlRfcMoral, {
                        nombre: this.nombre,
                        fechaCreacion: this.fechaCreacion
                    }).then(response => {
                        this.rfc = response.data.res.slice(0, -3);
                        this.homoclave = response.data.res.slice(-3);
                        this.searchPersona();
                    });
                }
            },
            buscarCarpetasMoral: function() {
                var post = this.url + '/moralCarpetasRfc';
                axios.post(post, {
                    rfc: this.rfc + this.homoclave,
                }).then(response => {
                    if (response.data) {
                        this.$store.commit('asignarCarpetasLigadas', response.data)
                    }
                });
            },
            getDomicilios() {
                var urlGetDomicilios = this.url + '/getDomiciliosPersona'
                axios.post(urlGetDomicilios, {
                        idVarPersona: this.$store.state.idTemporal,
                        esEmpresa: true
                    })
                    .then((response) => {
                        if (response.data) {
                            this.$store.commit('asignarDomicilios', response.data)
                        }
                    })
            },
            getIdentificaciones() {
                var urlIdentificaciones = this.url + '/getIdentificaciones';
                axios.get(urlIdentificaciones).then(response => {
                    this.identificaciones = response.data
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.CrearEmpresa();
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
            CleanFields() {
                this.nombre = '',
                    this.fechaCreacion = '',
                    this.rfc = '',
                    this.homoclave = '',
                    this.telefono = '',
                    this.nombresRep = '',
                    this.primerApRep = '',
                    this.segundoApRep = '',
                    this.identificacion = '',
                    this.numIdentificacion = '',
                    this.$validator.reset();
            },
            CrearEmpresa: function() {
                this.validacionesback = '';
                var urlCrearMoral = this.url + '/' + this.tipo + this.sistema;
                var data = {
                    nombre: (this.nombre) ? this.nombre.toUpperCase() : '',
                    fechaCreacion: (this.fechaCreacion) ? this.fechaCreacion : '',
                    rfc: (this.rfc) ? this.rfc : '',
                    homo: (this.homoclave) ? this.homoclave : '',
                    telefono: (this.telefono) ? this.telefono : '',
                    docIdentificacion: (this.identificacion) ? this.identificacion.id : '',
                    numDocIdentificacion: (this.numIdentificacion) ? this.numIdentificacion.toUpperCase() : '',
                    nombreRep: (this.nombresRep) ? this.nombresRep.toUpperCase() : '',
                    primerApRep: (this.primerApRep) ? this.primerApRep.toUpperCase() : '',
                    segundoApRep: (this.segundoApRep) ? this.segundoApRep.toUpperCase() : '',
                    sistema: this.sistema,
                    idPersona: this.$store.state.idPersonaMoral,
                    usuario: this.usuario,
                    personaMoral: this.$store.state.personaMoral,
                    idDomicilio: this.$store.state.idDomicilioTemporal,
                    idNotificacion: this.$store.state.idContactoTemporal
                };
                axios.post(urlCrearMoral, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdMoral', {
                                idPersona: response.data.original.idVarPersona,
                                personaMoral: response.data.original.idPersona
                            })
                            if (this.tipo == 'conocidomoral') {
                                this.$store.commit('asignarIdExtra', response.data.original.idExtra)
                            }
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta empresa fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                            if (this.$store.state.moralEncontrada && this.tipo != 'conocidomoral') {
                                this.getDomicilios()
                                this.buscarCarpetasMoral()
                            }
                        } else {
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Ésta persona no fue posible guardarla.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }).catch((error) => {
                        if (error.response.data.errors) {
                            this.validacionesback = error.response.data.errors
                        }
                        swal({
                            title: '¡Guardado incorrecto!',
                            text: 'Ésta persona moral no fue posible guardarla.',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })
                    });
            }
        },
        watch: {
            moralEncontrada() {
                if (this.$store.state.moralEncontrada == '') {
                    this.CleanFields()
                }
            }
        },
        computed: Object.assign({
            botonGuardarModificar() {
                if (this.$store.state.idPersonaMoral == '') {
                    return 'Guardar'
                } else {
                    return 'Modificar'
                }
            }
        }, mapState(['idPersonaFisica', 'idPersonaMoral', 'moralEncontrada']))
        //    computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
