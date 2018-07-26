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
	import urlComponentes from '../../urlComponentes'
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares: '',
                url: urlComponentes
            }
        },
        props: ['sistema','empresa','carpeta','idcarpeta', 'usuario'],
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtrasConocido();
                        return
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
                    particulares: (this.particulares)?this.particulares.toUpperCase():'',
                    sistema: this.sistema,
                    usuario: this.usuario,
                    carpeta: this.carpeta,
                    idCarpeta: this.idcarpeta,
                    empresa: this.empresa,
                    tipo: 'conocido'
                };
                                console.log(data)
                axios.post(urlGuardarConocido, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
                            swal({
                                    title: 'Conocido guardado correctamente!',
                                    text: 'Haz finalizado el registro del conocido exitosamente.',
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
            cleanFields() {
                this.particulares
                this.$validator.reset()
            }
        }
    }
</script>