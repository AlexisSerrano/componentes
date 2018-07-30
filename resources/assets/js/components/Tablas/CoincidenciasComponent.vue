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
                            <button type="button" class="btn btn-primary" @click="verDetalle(coincidencia.id)">Ver detalle</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <sweet-modal ref="detalleModal" title="Detalle de la persona">
            <sweet-modal-tab title="Datos personales" id="datosPersonales">
                <dl class="row">
                    <div class="col-4" v-for="(value,key,index) in datosPersonales" :key="index">
                        <dt>{{key}}</dt>
                        <dd>{{value}}</dd>
                    </div>
                </dl>
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio" id="domicilio">
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio de Trabajo" id="domicilioTrabajo">
            </sweet-modal-tab>
            <sweet-modal-tab title="Domicilio de notificaciones" id="domicilioNotificaciones">
            </sweet-modal-tab>
            <button class="btn btn-primary" type="button" slot="button"> Seleccionar</button>
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
                datosPersonales: '',
                domicilios: ''
            }
        },
        props: ['sistema', 'usuario'],
        components: {
            SweetModal,
            SweetModalTab
        },
        methods: {
            verDetalle(id) {
                var urlGetPersonasEdit = this.url + '/getPersonaEdit'
                axios.post(urlGetPersonasEdit, {
                        idPersona: id,
                        tipo: 'conocidofisico'
                    })
                    .then(response => {
                        this.datosPersonales = response.data.persona.original.modal
                        console.log(response)
                    })
                    .catch(error => {
                        swal({
                            title: '¡Algo salio mal!',
                            text: 'No es posible ver mas detalles de esta persona.',
                            type: 'error',
                            confirmButtonText: 'Entendido'
                        })
                    })
                this.$refs.detalleModal.open()
            },
            seleccionarPersona(coincidencia) {
                this.$store.commit('asignarIdFisica', {
                    idPersona: '',
                    idTemporal: coincidencia.idVarPersona,
                    fisicaEncontrada: true,
                    personaFisica: coincidencia.idPersona
                })
                this.$store.commit('asignarDomiciliosTemporales', {
                    idDomicilioTemporal: coincidencia.idDomicilio,
                    idTrabajoTemporal: coincidencia.idDomicilioTrabajo,
                    idContactoTemporal: coincidencia.idDomicilioNotificacion
                })
                this.crearPersona(coincidencia)
            },
            buscarCarpetasFisica(coincidencia) {
                var urlBuscarCarpeta = this.url + '/fisicaCarpetasRfc';
                axios.post(urlBuscarCarpeta, {
                    rfc: coincidencia.rfc,
                    curp: coincidencia.curp
                }).then(response => {
                    if (response.data) {
                        this.$store.commit('asignarCarpetasLigadas', response.data)
                    }
                });
            },
            crearPersona(coincidencia) {
                var urlCrearPersona = this.url + '/conocido' + this.sistema;
                var data = {
                    nombres: coincidencia.nombres,
                    primerAp: coincidencia.primerAp,
                    segundoAp: coincidencia.segundoAp,
                    alias: (coincidencia.alias) ? coincidencia.alias : '',
                    sistema: this.sistema,
                    idPersona: coincidencia.idVarPersona,
                    usuario: this.usuario,
                    personaFisica: coincidencia.idPersona,
                    idDomicilio: this.$store.state.idDomicilioTemporal,
                    idTrabajo: this.$store.state.idTrabajoTemporal,
                    idNotificacion: this.$store.state.idContactoTemporal
                }
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
                                var personaCorrecta = [coincidencia]
                                this.$store.commit('asignarPersonasEncontradas', personaCorrecta)
                                this.buscarCarpetasFisica(coincidencia)
                            } else {
                                swal({
                                    title: '¡Guardado incorrecto!',
                                    text: 'Ésta persona no fue posible guardarla.',
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        }).catch((error) => {
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Ésta persona no fue posible guardarla.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        });
                }
            }
        },
        computed: mapState(["personasEncontradas"])
    };
</script>