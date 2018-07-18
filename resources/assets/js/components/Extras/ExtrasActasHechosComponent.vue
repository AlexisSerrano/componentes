<template>
    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="col-form-label col-form-label-sm" for="tipoActa">Tipo de acta de hechos</label>
                    <v-select :options="tiposActas" label="nombre" v-model="tipoActa" data-vv-name="Tipo de acta de hechos" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('Tipo de acta de hechos')}" placeholder="Seleccione un tipo de acta de hechos"></v-select>
                    <span v-show="errors.has('Tipo de acta de hechos')" class="text-danger">{{ errors.first('Tipo de acta de hechos')}}</span>
                </div>
    
                <div v-if="tipoActa=='OTRO DOCUMENTO'" class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="documento">Documento</label>
                    <input type="text" name="documento" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('documento')}" v-model="documento" placeholder="Ingrese el tipo de documento" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('documento')" class="text-danger">{{ errors.first('documento')}}</span>
                </div>
    
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
                tiposActas: ['PASAPORTE', 'CREDENCIAL DE TRABAJO/GAFFETE', 'TARJETA DE CRÉDITO/DÉBITO', 'TELEFONO CELULAR', 'EQUIPO DE TRABAJO(CELULARES,RADIOS,ETC)',
                    'PERMISO DE TRANSITO PARA EMPLACAMIENTO DE TAXIS', 'FACTURA DE VEHÍCULO/MOTOCICLETA', 'TARJETA DE CIRCULACION', 'PLACAS DE CIRCULACIÓN',
                    'LICENCIA DE CONDUCIR ESTATAL', 'LICENCIA DE CONDUCIR FEDERAL', 'DOCUMENTO/BIEN EXTRAVIADO O ROBADO', 'CERTIFICADO DE ALUMBRAMIENTO', 'OTRO DOCUMENTO'
                ],
                tipoActa: '',
                descripcion: '',
                documento: '',
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
                var urlActasHechos = this.url + '/addExtrasActas'
                if (this.empresa == false) {
                    var idPersona = this.$store.state.idPersonaFisica
                } else {
                    var idPersona = this.$store.state.idPersonaMoral
                }
                var data = {
                    tipoActa: (this.tipoActa != 'OTRO DOCUMENTO') ? this.tipoActa : this.documento.toUpperCase(),
                    idExtrasActas: this.$store.state.idExtra,
                    idPersona: idPersona,
                    sistema: this.sistema,
                    empresa: this.empresa,
                    usuario: this.usuario,
                    narracion: this.descripcion.toUpperCase(),
                    tipo: 'actashechos'
                };
                if (this.empresa == false) {
                    var urlOficio = "actaoficio/"
                } else {
                    var urlOficio = "actaoficioM/"
                }
                axios.post(urlActasHechos, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
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
                this.tipoActa,
                    this.descripcion,
                    this.$validator.reset();
            }
        }
    }
</script>
