<template>
    <div>
    
        <h3 class="mb-3">Coincidencias</h3>
        <div class="table-responsive">
    
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombres y apellidos</th>
                        <th>Edad</th>
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
                    <tr v-for="coincidencia in personasEncontradas" :key="coincidencia.idVarPersona">
                        <td>{{ `${coincidencia.nombres} ${coincidencia.primerAp} ${coincidencia.segundoAp}` }}</td>
                        <td>{{ coincidencia.edad }}</td>
                        <td>{{ coincidencia.sexo }}</td>
                        <td>{{ coincidencia.rfc }}</td>
                        <td>{{ coincidencia.curp }}</td>
                        <td>{{ coincidencia.nacionalidad }}</td>
                        <td>{{ coincidencia.estado }}</td>
                        <td>{{ coincidencia.municipio }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" @click="seleccionarPersona(coincidencia)">Guardar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
    import urlComponentes from '../../urlComponentes'
    import swal from 'sweetalert2'
    import {
        mapState
    } from "vuex";
    export default {
        data() {
            return {
                url: urlComponentes
            }
        },
        props: ['sistema', 'usuario'],
        methods: {
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
            getDomicilios(idVarPersona) {
                var urlGetDomicilios = this.url + '/getDomiciliosPersona'
                axios.post(urlGetDomicilios, {
                        idVarPersona: idVarPersona,
                        esEmpresa: false
                    })
                    .then((response) => {
                        if (response.data) {
                            this.$store.commit('asignarDomicilios', response.data)
                        }
                    })
            },
            buscarCarpetasFisica(coincidencia) {
                var post = this.url + '/fisicaCarpetasRfc';
                axios.post(post, {
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
                                this.getDomicilios(coincidencia.idVarPersona)
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