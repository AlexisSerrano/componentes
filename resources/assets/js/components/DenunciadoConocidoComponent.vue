<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="tabPrincipalConocido" id="denunciado-personaconocido-tab" data-toggle="pill" href="#pills-denunciado-personaconocido" role="tab" aria-controls="pills-denunciado-personaconocido" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsConocido(1)" :class="tabsConocido" id="denunciado-domicilioconocido-tab" data-toggle="pill" href="#pills-denunciado-domicilioconocido" role="tab" aria-controls="pills-denunciado-domicilioconocido" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsConocido(2)" :class="tabsConocido" id="denunciado-extraconocido-tab" data-toggle="pill" href="#pills-denunciado-extraconocido" role="tab" aria-controls="pills-denunciado-extraconocido" aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="pillPrincipalConocido" id="pills-denunciado-personaconocido" role="tabpanel" aria-labelledby="denunciado-personaconocido-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'conocido'"></personafisica>
            </div>
            <div :class="pillsConocido1" id="pills-denunciado-domicilioconocido" role="tabpanel" aria-labelledby="denunciado-domicilioconocido-tab">
                <domicilio :tipo="'domicilio'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsConocido2" id="pills-denunciado-extraconocido" role="tabpanel-conocido" aria-labelledby="denunciado-extraconocido-tab">
                <form v-on:submit.prevent="validateBeforeSubmit">
                    <div class="container-fluid">
                        <label class="col-form-label col-form-label-sm" for="particulares">Señas particulares</label>
                        <textarea class="form-control form-control-sm" name="particulares" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('particulares') || this.validacionesback.particulares}" v-model="particulares" placeholder="Ingrese el particulares" v-validate="'required'" autocomplete="off"></textarea>
                        <span v-show="errors.has('particulares')" class="text-danger">{{ errors.first('particulares')}}</span>
                        <span v-if="this.validacionesback.particulares!=undefined" class="text-danger">{{ String(this.validacionesback.particulares)}}</span>
                        <div class="row mt-2"></div>
                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
import { mapState } from "vuex";
import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares:'',
                validacionesback:'',
                tabPrincipalConocido:'nav-link active show',
                tabsConocido:'nav-link disabled',
                pillPrincipalConocido:'tab-pane fade show active',
                pillsConocido1:'tab-pane fade',
                pillsConocido2:'tab-pane fade'
            }
        },
        props: {
            sistema: {
                required:true
            },
            carpeta:{
                required:true
            }
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearExtra();
                        return;
                    }
                    swal({
                        title: '¡Guardado Incorrecto!',
                        text: 'Los datos del investigado no fueron posible guardarse.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            crearExtra(){
                this.validacionesback='';
                var urlExtraConocido = this.url+'addExtraConocido';
                axios.post(urlExtraConocido,{
                    particulares:this.particulares
                }).then((response)=>{
                    swal({
                        title: '¡Guardado Correctamente!',
                        text: 'Los datos del investigado fueron guardados exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.validacionesback = error.response.data.errors
                        swal({
                            title: '¡Guardado Incorrecto!',
                            text: 'Los datos del investigado no fueron posible guardarse.',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })
                    })
                })
            },
            ubicacionTabsConocido(numeroTab) {
                if(this.tabsConocido!='nav-link disabled'){
                    this.tabPrincipalConocido='nav-link'
                    this.pillPrincipalConocido='tab-pane fade'
                    if(numeroTab==1){
                        this.pillsConocido2 = 'tab-pane fade'
                        this.pillsConocido1 = 'tab-pane fade show active'
                    }
                    else if(numeroTab==2){
                        this.pillsConocido1 = 'tab-pane fade'
                        this.pillsConocido2 = 'tab-pane fade show active'
                    }         
                }     
            }
        },
        watch: {
            idPersonaFisica() {
                if(this.$store.state.idPersonaFisica!=false){
                this.tabsConocido='nav-link'
                }
            },
            idPersonaMoral(){
                this.tabsConocido='nav-link disabled'
                this.tabPrincipalConocido='nav-link active show'
                this.pillsConocido1='tab-pane fade'
                this.pillsConocido2='tab-pane fade'
                this.pillPrincipalConocido='tab-pane fade show active'
            }
        },
        computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
