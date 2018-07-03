<template>

    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="familiarDe">Familiar de</label>
                    <v-select :options="familiarDe" label="familiarDe" v-model="familiar" name="familiar" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('familiar')}" placeholder="Seleccione tipo solicitante" ></v-select>
                    <span v-show="errors.has('familiarDe')" class="text-danger">{{ errors.first('familiarDe')}}</span>
                </div>

                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="parentesco">Parentesco</label>
                    <v-select :options="parentescos" label="parentesco" v-model="parentesco" name="parentesco" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('parentesco')}" placeholder="Seleccionne un parentesco" ></v-select>
                    <span v-show="errors.has('parentesco')" class="text-danger">{{ errors.first('parentesco')}}</span>
                </div>

                <!-- Traer el catálogo -->
                <div  class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="ocupacion">Ocupación</label>    
                    <v-select :options="ocupaciones" label="ocupacion" v-model="ocupacion" name="ocupacion" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('ocupacion')}" placeholder="Seleccione una ocupación"></v-select>
                    <span v-show="errors.has('ocupación')" class="text-danger">{{ errors.first('ocupación')}}</span>                    
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
        data(){
             return{                                                
                familiarDe:['Familiar1','Familiar2','Familiar3','Familiar3'],
                familiar:'',
                parentescos:['HIJO(A)','MADRE','PADRE','CÓNYUGE'],
                parentesco:'',
                nombre:'',
                primerAp:'',
                segundoAp:'',
                ocupaciones: [],
                ocupacion:'',               
                systemUser:'TEST',
                url:'./api'             
            }
        },
        props:{            
        
        },
        created: function(){
            this.getCatalogos();
        },
        methods:{
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtra()                               
                    }else{
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                    }
        
                });
            },
            getCatalogos: function(){
                var urlCatalogos = this.url+'/getCatalogos';
                axios.post(urlCatalogos, {
                    sistema: 'uat',
                    tipo: 'autoridad'
                }).then(response => {
                    this.ocupaciones = response.data['ocupaciones'].original                    
                });
            },
            cleanFields(){               
                this.$validator.reset();
            }
        }
    }
</script>

<style>
    input{
        text-transform: uppercase
    }
</style>