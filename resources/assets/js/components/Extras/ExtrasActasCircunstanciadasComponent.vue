<template>
    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">

                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="descripcion">Descripción de los hechos</label>
                    <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripción" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripción')}" v-model="descripcion" placeholder="Ingrese la descripcion de los hechos"
                        v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('descripción')" class="text-danger">{{ errors.first('descripción')}}</span>
                </div>
    
            </div>
    
            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                descripcion: '',
                url: './api'
            }
        },
    
        props: ['empresa', 'sistema', 'usuario'],
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if (this.$store.state.idDomicilio != '' || this.$store.state.idDomicilioTemporal != '') {
                            this.guardarExtra()
                        } else {
                            swal({
                                title: '¡Aún no es posible guardar!',
                                text: 'Debe guardar antes un domicilio.',
                                type: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        }
                    } else {
                        swal({
                            title: '¡Aún no es posible guardar!',
                            text: 'Ingrese los campos obligatorios',
                            type: 'warning',
                            confirmButtonText: 'Ok'
                        });
                    }
    
                });
            },
            guardarExtra: function() {
                var data = {
                    idExtrasActas: this.$store.state.idExtra,
                    idPersona: this.$store.state.idPersonaFisica,
                    sistema: this.sistema,
                    empresa: this.empresa,
                    usuario: this.usuario,
                    narracion: this.descripcion.toUpperCase(),
                    tipo: 'actascircunstanciadas'
                };
                var urlActasCircunstanciadas = "addExtrasCircunstanciadas/"
                axios.post(urlGuardarDenunciante, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
                            //this.$store.commit('cleanStore')                    
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
    
                            })
                            swal({
                                    title: 'Acta de hechos guardada correctamente!',
                                    text: 'Haz finalizado el registro del acta exitosamente.',
                                    type: 'success',
                                    confirmButtonText: '<a class="linkAlert" href="' + urlOficio + response.data + '" target="_blank">Imprimir oficio</a>',
                                })
                                .then((result) => {
                                    if (result.value) {
                                        window.location.replace(window.location)
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
                        })
                    });
            },
            cleanFields() {
                this.descripcion
                this.$validator.reset()
            }
        }
    }
</script>
