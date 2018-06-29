<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="tabPrincipalFisica" id="denunciado-personafisico-tab" data-toggle="pill" href="#pills-denunciado-personafisico" role="tab" aria-controls="pills-denunciado-personafisico" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(1)" :class="tabsFisica" id="denunciado-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciado-domiciliofisico" role="tab" aria-controls="pills-denunciado-domiciliofisico" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(2)" :class="tabsFisica" id="denunciado-trabajofisico-tab" data-toggle="pill" href="#pills-denunciado-trabajofisico" role="tab" aria-controls="pills-denunciado-trabajofisico" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(3)" :class="tabsFisica" id="denunciado-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciado-notificacionesfisico" role="tab" aria-controls="#pills-denunciado-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(4)" :class="tabsFisica" id="denunciado-extrafisico-tab" data-toggle="pill" href="#pills-denunciado-extrafisico" role="tab" aria-controls="pills-denunciado-extrafisico" aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="pillPrincipalFisica" id="pills-denunciado-personafisico" role="tabpanel" aria-labelledby="denunciado-personafisico-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'denunciado'"></personafisica>
            </div>
            <div :class="pillsFisica1" id="pills-denunciado-domiciliofisico" role="tabpanel" aria-labelledby="denunciado-domiciliofisico-tab">
                <domicilio :tipo="'domicilio'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica2" id="pills-denunciado-trabajofisico" role="tabpanel" aria-labelledby="denunciado-trabajofisico-tab">
                <domicilio :tipo="'trabajo'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica3" id="pills-denunciado-notificacionesfisico" role="tabpanel" aria-labelledby="denunciado-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica4" id="pills-denunciado-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciado-extrafisico-tab">
                <extrasinvestigado :sistema="sistema" :tipo="'fisica'"></extrasinvestigado>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
import { mapState } from "vuex";
    export default {
        data() {
            return {
                tabPrincipalFisica:'nav-link active show',
                tabsFisica:'nav-link disabled',
                pillPrincipalFisica:'tab-pane fade show active',
                pillsFisica1:'tab-pane fade',
                pillsFisica2:'tab-pane fade',
                pillsFisica3:'tab-pane fade',
                pillsFisica4:'tab-pane fade',
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
            ubicacionTabsFisica(numeroTab) {
                if(this.tabsFisica!='nav-link disabled'){
                    this.tabPrincipalFisica='nav-link'
                    this.pillPrincipalFisica='tab-pane fade'
                    if(numeroTab==1){
                        this.pillsFisica2 = 'tab-pane fade'
                        this.pillsFisica3 = 'tab-pane fade'
                        this.pillsFisica4 = 'tab-pane fade'
                        this.pillsFisica1 = 'tab-pane fade show active'
                    }
                    else if(numeroTab==2){
                        this.pillsFisica1 = 'tab-pane fade'
                        this.pillsFisica3 = 'tab-pane fade'
                        this.pillsFisica4 = 'tab-pane fade'
                        this.pillsFisica2 = 'tab-pane fade show active'
                    }      
                    else if(numeroTab==3){
                        this.pillsFisica1 = 'tab-pane fade'
                        this.pillsFisica2 = 'tab-pane fade'
                        this.pillsFisica4 = 'tab-pane fade'
                        this.pillsFisica3 = 'tab-pane fade show active'
                    }      
                    else if(numeroTab==4){
                        this.pillsFisica1 = 'tab-pane fade'
                        this.pillsFisica2 = 'tab-pane fade'
                        this.pillsFisica3 = 'tab-pane fade'
                        this.pillsFisica4 = 'tab-pane fade show active'
                    }       
                }     
            }
        },
        watch: {
            idPersonaFisica() {
                if(this.$store.state.idPersonaMoral==''){
                    if(this.$store.state.tipoInvolucrado !='conocido'){
                        this.tabsFisica='nav-link'
                    }
                    else if(this.$store.state.tipoInvolucrado=='conocido'){
                        this.tabsFisica='nav-link disabled'
                        this.tabPrincipalFisica='nav-link active show'
                        this.pillsFisica1='tab-pane fade'
                        this.pillsFisica2='tab-pane fade'
                        this.pillsFisica3='tab-pane fade'
                        this.pillsFisica4='tab-pane fade'
                        this.pillPrincipalFisica='tab-pane fade show active'
                    }
                }
            },
            idPersonaMoral(){
                if(this.$store.state.idPersonaFisica==''){
                    this.tabsFisica='nav-link disabled'
                    this.tabPrincipalFisica='nav-link active show'
                    this.pillsFisica1='tab-pane fade'
                    this.pillsFisica2='tab-pane fade'
                    this.pillsFisica3='tab-pane fade'
                    this.pillsFisica4='tab-pane fade'
                    this.pillPrincipalFisica='tab-pane fade show active'
                }
            }
        },
        computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
