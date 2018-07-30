<template>
    <div>
    
        <h3 class="mb-3">Coincidencias</h3>
        <div class="table-responsive">
    
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombres y apellidos</th>
                        <th>Fecha nacimiento</th>
                        <th>Sexo</th>
                        <th>R.F.C</th>
                        <th>C.U.R.P</th>
                        <th>Nacionalidad</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Seleccionar Persona</th>
    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(coincidencia,index) in personasEncontradas" :key="index">
                        <td>{{ `${coincidencia.nombres} ${coincidencia.primerAp} ${coincidencia.segundoAp}` }}</td>
                        <td>{{ coincidencia.fechaNacimiento }}</td>
                        <td>{{ coincidencia.sexo }}</td>
                        <td>{{ coincidencia.rfc }}</td>
                        <td>{{ coincidencia.curp }}</td>
                        <td>{{ coincidencia.nacionalidad }}</td>
                        <td>{{ coincidencia.estado }}</td>
                        <td>{{ coincidencia.municipio }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" @click="verDetalle(coincidencia)">Ver detalle</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <sweet-modal ref="detalleModal" title="Detalle de la persona" v-if="domicilios">
            <sweet-modal-tab title="Datos personales" id="datosPersonales">
                <dl class="row">
                    <div class="col-4" v-for="(value,key,index) in datosModal" :key="index">
                        <dt>{{key}}</dt>
                        <dd>{{value}}</dd>
                    </div>
                </dl>
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio" id="domicilio">
                <dl class="row">
                    <div class="col-4">
                        <dt>Estado</dt>
                        <dd>{{domicilios.domicilio.idEstado.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Municipio</dt>
                        <dd>{{domicilios.domicilio.idMunicipio.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Localidad</dt>
                        <dd>{{domicilios.domicilio.idLocalidad.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Colonia</dt>
                        <dd>{{domicilios.domicilio.idColonia.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Codigo postal</dt>
                        <dd>{{domicilios.domicilio.codigoPostal.codigoPostal}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Calle</dt>
                        <dd>{{domicilios.domicilio.calle}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número externo</dt>
                        <dd>{{domicilios.domicilio.numExterno}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número interno</dt>
                        <dd>{{domicilios.domicilio.numInterno}}</dd>
                    </div>
                </dl>
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio Trabajo" id="domicilioTrabajo">
                <dl class="row">
                    <div class="col-4">
                        <dt>Estado</dt>
                        <dd>{{domicilios.trabajo.idEstado.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Municipio</dt>
                        <dd>{{domicilios.trabajo.idMunicipio.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Localidad</dt>
                        <dd>{{domicilios.trabajo.idLocalidad.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Colonia</dt>
                        <dd>{{domicilios.trabajo.idColonia.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Codigo postal</dt>
                        <dd>{{domicilios.trabajo.codigoPostal.codigoPostal}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Calle</dt>
                        <dd>{{domicilios.trabajo.calle}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número externo</dt>
                        <dd>{{domicilios.trabajo.numExterno}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número interno</dt>
                        <dd>{{domicilios.trabajo.numInterno}}</dd>
                    </div>
                </dl>
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio notificaciones" id="domicilioNotificaciones">
                <dl class="row">
                    <div class="col-4">
                        <dt>Estado</dt>
                        <dd>{{domicilios.notificacion.idEstado.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Municipio</dt>
                        <dd>{{domicilios.notificacion.idMunicipio.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Localidad</dt>
                        <dd>{{domicilios.notificacion.idLocalidad.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Colonia</dt>
                        <dd>{{domicilios.notificacion.idColonia.nombre}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Codigo postal</dt>
                        <dd>{{domicilios.notificacion.codigoPostal.codigoPostal}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Calle</dt>
                        <dd>{{domicilios.notificacion.calle}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número externo</dt>
                        <dd>{{domicilios.notificacion.numExterno}}</dd>
                    </div>
                    <div class="col-4">
                        <dt>Número interno</dt>
                        <dd>{{domicilios.notificacion.numInterno}}</dd>
                    </div>
                </dl>
            </sweet-modal-tab>
            <button class="btn btn-primary" type="button" slot="button" @click="seleccionarPersona"> Seleccionar</button>
            <button class="btn btn-danger" type="button" slot="button" @click="$refs.detalleModal.close()"> Cancelar</button>
        </sweet-modal>
    </div>
</template>


<script>
    import urlComponentes from '../../urlComponentes'
    import swal from 'sweetalert2'
    import {
        mapState
    } from "vuex";
    import {
        SweetModal,
        SweetModalTab
    } from 'sweet-modal-vue'
    export default {
        data() {
            return {
                url: urlComponentes,
                datosModal: '',
                datosPersonales: '',
                domicilios: '',
                idPersona: '',
                coincidencia: ''
            }
        },
        props: ['sistema', 'usuario'],
        components: {
            SweetModal,
            SweetModalTab
        },
        methods: {
            verDetalle(coincidencia) {
                if (coincidencia.id == this.idPersona) {
                    this.$refs.detalleModal.open()
                    return
                }
                this.coincidencia = coincidencia
                this.idPersona = coincidencia.id
                var urlGetPersonasEdit = this.url + '/getPersonaEdit'
                axios.post(urlGetPersonasEdit, {
                        idPersona: coincidencia.id,
                        tipo: 'conocidofisico'
                    })
                    .then(response => {
                        this.datosModal = response.data.persona.original.modal
                        this.datosPersonales = response.data.persona.original
                        this.domicilios = response.data.domicilios.original
                        console.log(response)
                    })
                    .then(response => {
                        this.$refs.detalleModal.open()
                    })
                    .catch(error => {
                        swal({
                            title: '¡Algo salio mal!',
                            text: 'No es posible ver mas detalles de esta persona.',
                            type: 'error',
                            confirmButtonText: 'Entendido'
                        })
                    })
            },
            seleccionarPersona() {
                this.$store.commit('asignarIdFisica', {
                    idPersona: '',
                    idTemporal: this.datosPersonales.idVarPersona,
                    fisicaEncontrada: true,
                    personaFisica: this.datosPersonales.idPersona
                })
                this.$store.commit('asignarDomiciliosTemporales', {
                    idDomicilioTemporal: this.domicilios.domicilio.id,
                    idTrabajoTemporal: this.domicilios.trabajo.idDomicilio,
                    idContactoTemporal: this.domicilios.notificacion.idDomicilio
                })
                this.crearPersona()
            },
            buscarCarpetasFisica(coincidencia) {
                var urlBuscarCarpeta = this.url + '/fisicaCarpetasRfc';
                axios.post(urlBuscarCarpeta, {
                    rfc: this.datosPersonales.rfc,
                    curp: this.datosPersonales.curp
                }).then(response => {
                    if (response.data) {
                        this.$store.commit('asignarCarpetasLigadas', response.data)
                    }
                });
            },
            crearPersona() {
                var urlCrearPersona = this.url + '/conocido' + this.sistema;
                var data = {
                    nombres: this.datosPersonales.nombres,
                    primerAp: this.datosPersonales.primerAp,
                    segundoAp: this.datosPersonales.segundoAp,
                    alias: (this.datosPersonales.alias) ? this.datosPersonales.alias : '',
                    sistema: this.sistema,
                    idPersona: this.datosPersonales.idVarPersona,
                    usuario: this.usuario,
                    personaFisica: this.datosPersonales.idPersona,
                    idDomicilio: this.$store.state.idDomicilioTemporal,
                    idTrabajo: this.$store.state.idTrabajoTemporal,
                    idNotificacion: this.$store.state.idContactoTemporal
                }
                console.log(data)
                if (data) {
                    axios.post(urlCrearPersona, data)
                        .then(response => {
                            if (response.data) {
                                this.$store.commit('asignarIdFisica', {
                                    idPersona: response.data.original.idVarPersona,
                                    personaFisica: response.data.original.idPersona
                                })
                                this.$store.commit('asignarIdExtra', response.data.idExtra)
                                swal({
                                    title: '¡Guardado correctamente!',
                                    text: 'Ésta persona fue guardada exitosamente.',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                var personaCorrecta = [this.coincidencia]
                                this.$store.commit('asignarPersonasEncontradas', personaCorrecta)
                                this.buscarCarpetasFisica()
                                this.$refs.detalleModal.close()
                            } else {
                                console.log(response)
                                swal({
                                    title: '¡Guardado incorrecto!',
                                    text: 'Ésta persona no fue posible guardarla.',
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })
                                this.$refs.detalleModal.close()
                            }
                        }).catch((error) => {
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Ésta persona no fue posible guardarla.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                            this.$refs.detalleModal.close()
                        });
                }
            }
        },
        computed: mapState(["personasEncontradas"])
    };
</script>