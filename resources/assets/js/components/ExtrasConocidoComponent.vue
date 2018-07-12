<template>
    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
    
                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="particulares">Señas particulares</label>
                    <textarea class="form-control form-control-sm" data-vv-name="señas particulares" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('señas particulares')}" v-model="particulares" placeholder="Ingrese las señas particulares"
                        v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('señas particulares')" class="text-danger">{{ errors.first('señas particulares')}}</span>
                </div>
    
            </div>
    
            <button type="submit" class="btn btn-primary">Guardar</button>
    
        </form>
    </div>
</template>

<script>
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares: '',
                systemUser: 'TEST',
                url: './api'
            }
        },
        props: {
            sistema: {
                required: true
            },
            empresa: {
                required: true
            },
            carpeta: {
                required: true
            }
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtrasConocido();
                        return
                    } else {
                        swal({
                            title: '¡Guardado incorrecto!',
                            text: 'Error al guardar.',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
    
                });
            },
            guardarExtrasConocido: function() {
                var urlGuardarConocido = this.url + '/addExtrasConocido';
                if (this.empresa == false) {
                    var idPersona = this.$store.state.idPersonaFisica
                } else {
                    var idPersona = this.$store.state.idPersonaMoral
                }
                var data = {
                    idExtrasConocido: this.$store.state.idExtra,
                    idPersona: idPersona,
                    particulares: particulares,
                    sistema: this.sistema,
                    usuario: this.systemUser,
                    idCarpeta: this.carpeta,
                    empresa: this.empresa,
                    tipo: 'conocido'
                };
                axios.post(urlGuardarAutoridad, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
                            //this.$store.commit('cleanStore')                                         
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                        } else {
                            swal({
                                title: 'Guardado Incorrecto!',
                                text: 'Error al guardar.',
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
            },
            cleanFields() {
                this.particulares
                this.$validator.reset()
            }
        }
    }
</script>