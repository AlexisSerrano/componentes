<template>
    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">
    
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="familiarDe">Familiar de</label>
                    <v-select :options="familiarDe" label="nombres" v-model="familiar" name="familiar" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('familiar')}" placeholder="Seleccione un involucrado"></v-select>
                    <span v-show="errors.has('familiar')" class="text-danger">{{ errors.first('familiar')}}</span>
                </div>
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="parentescos">Parentesco</label>
                    <v-select :options="parentescos" label="nombre" v-model="parentesco" name="parentesco" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('parentesco')}" placeholder="Seleccionne un parentesco"></v-select>
                    <span v-show="errors.has('parentesco')" class="text-danger">{{ errors.first('parentesco')}}</span>
                </div>
    
                <!-- Traer el catálogo -->
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="ocupaciones">Ocupación</label>
                    <v-select :options="ocupaciones" label="nombre" v-model="ocupacion" name="ocupacion" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('ocupacion')}" placeholder="Seleccione una ocupación"></v-select>
                    <span v-show="errors.has('ocupacion')" class="text-danger">{{ errors.first('ocupacion')}}</span>
                </div>
                <!-- -->
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="nombre">Nombre</label>
                    <input type="text" name="nombre" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('nombre')}" v-model="nombre" placeholder="Ingrese el nombre" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre')}}</span>
                </div>
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="primerAp">Primer apellido</label>
                    <input type="text" name="primerAp" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('primerAp')}" v-model="primerAp" placeholder="Ingrese el primer apellido" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('primerAp')" class="text-danger">{{ errors.first('primerAp')}}</span>
                </div>
    
    
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="segundoAp">Segundo apellido</label>
                    <input type="text" name="segundoAp" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('segundoAp')}" v-model="segundoAp" placeholder="Ingrese el segundo apellido" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('segundoAp')" class="text-danger">{{ errors.first('segundoAp')}}</span>
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
                familiar: '',
                parentesco: '',
                nombre: '',
                primerAp: '',
                segundoAp: '',
                ocupacion: '',
                familiarDe: [],
                parentescos: [{
                    nombre: 'HIJO(A)',
                    id: 1
                }, {
                    nombre: 'MADRE',
                    id: 2
                }, {
                    nombre: 'PADRE',
                    id: 3
                }, {
                    nombre: 'CÓNYUGE',
                    id: 4
                }],
                ocupaciones: [],
                systemUser: 'TEST',
                url: './api'
            }
        },
        props: {
    
        },
        created: function() {
            this.getCatalogos();
            this.getInvolucrados();
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarFamiliar()
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
            getCatalogos: function() {
                var urlCatalogos = this.url + '/getCatalogos';
                axios.post(urlCatalogos, {
                    sistema: 'uat',
                    tipo: 'autoridad'
                }).then(response => {
                    this.ocupaciones = response.data['ocupaciones'].original
                });
            },
            getInvolucrados: function() {
                var urlCatalogos = this.url + '/getInvolucrados';
                axios.post(urlCatalogos, {
                    idCarpeta: 'UIPJ/D17/VER1/22/1/2018',
                }).then(response => {
                    this.familiarDe = response.data
                });
            },
            guardarFamiliar: function() {
                this.validacionesback = '';
                var post = this.url + '/saveFamiliar';
                var data = {
                    idPersona: this.familiar.id,
                    nombres: this.nombre.toUpperCase(),
                    primerAp: this.primerAp.toUpperCase(),
                    segundoAp: this.segundoAp.toUpperCase(),
                    parentesco: this.parentesco.nombre,
                    idOcupacion: this.ocupacion.id
                };
                if (data) {
                    axios.post(post, data)
                        .then(response => {
                            if (response.data) {
                                swal({
                                    title: '¡Guardado correctamente!',
                                    text: 'Ésta persona fue guardada exitosamente.',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                            } else {
                                swal({
                                    title: '¡Guardado incorrecto!',
                                    text: 'Ésta persona no fue posible guardarla.',
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        }).catch((error) => {
                            this.validacionesback = error.response.data.errors;
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Ésta persona no fue posible guardarla.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        });
                }
            },
    
    
            cleanFields() {
                this.$validator.reset();
            }
        }
    }
</script>

<style>
    input,
    textarea {
        text-transform: uppercase
    }
</style>