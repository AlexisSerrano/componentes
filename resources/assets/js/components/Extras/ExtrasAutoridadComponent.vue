<template>
    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
    
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="antiguedad">Antigüedad (Años)</label>
                    <input type="number" min="0" name="antiguedad" step="1" :class="{'form-control form-control-sm':true, 'border border-danger': errors.has('antiguedad')}" v-model="antiguedad" placeholder="Ingrese la antigüedad" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('antiguedad')" class="text-danger">{{ errors.first('antiguedad')}}</span>
                </div>
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="rango">Rango</label>
                    <v-select :options="rangos" label="rango" v-model="rango" name="rango" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('rango')}" placeholder="Seleccione un rango"></v-select>
                    <span v-show="errors.has('rango')" class="text-danger">{{ errors.first('rango')}}</span>
                </div>
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="horarioLaboral">Horario laboral</label>
                    <input type="text" data-vv-name="horario laboral" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('horario laboral')}" v-model="horarioLaboral" placeholder="Ingrese el horario laboral" v-validate="'required'"
                        autocomplete="off">
                    <span v-show="errors.has('horario laboral')" class="text-danger">{{ errors.first('horario laboral')}}</span>
                </div>
    
                <div v-if="sistema=='uat'" class="form-group col-md-12">
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
                antiguedad: '',
                rangos: ['CABO', 'COMANDANTE'],
                rango: '',
                horarioLaboral: '',
                descripcion: '',
                url: urlComponentes,
            }
        },
        props: ['sistema','carpeta','idcarpeta', 'usuario'],
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtraAutoridad();
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
            guardarExtraAutoridad: function() {
                var urlGuardarAutoridad = this.url + '/addExtrasAutoridad';
                var data = {
                    idExtrasAutoridad: this.$store.state.idExtra,
                    idPersona: this.$store.state.idPersonaFisica,
                    antiguedad: this.antiguedad,
                    rango: this.rango,
                    horarioLaboral: this.horarioLaboral.toUpperCase(),
                    sistema: this.sistema,
                    usuario: this.usuario,
                    narracion: this.descripcion.toUpperCase(),
                    carpeta: this.carpeta,
                    idCarpeta: this.idcarpeta,
                    empresa: false,
                    tipo: 'autoridad'
                };
                axios.post(urlGuardarAutoridad, data)
                    .then(response => {
                        if (response.data) {
                            this.$store.commit('asignarIdExtra', response.data)
                            //this.$store.commit('cleanStore')                                         
                            swal({
                                    title: 'Autoridad guardada correctamente!',
                                    text: 'Haz finalizado el registro de la autoridad exitosamente.',
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
                this.antiguedad = ''
                this.rango = ''
                this.horarioLaboral = ''
                this.descripcion = ''
                this.$validator.reset()
            }
        }
    }
</script>