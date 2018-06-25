<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="tabPrincipalFisica" id="denunciante-personafisico-tab" data-toggle="pill" href="#pills-denunciante-personafisico" role="tab" aria-controls="pills-denunciante-personafisico" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(1)" :class="tabsFisica" id="denunciante-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciante-domiciliofisico" role="tab" aria-controls="pills-denunciante-domiciliofisico" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(2)" :class="tabsFisica" id="denunciante-trabajofisico-tab" data-toggle="pill" href="#pills-denunciante-trabajofisico" role="tab" aria-controls="pills-denunciante-trabajofisico" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(3)" :class="tabsFisica" id="denunciante-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciante-notificacionesfisico" role="tab" aria-controls="#pills-denunciante-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsFisica(4)" :class="tabsFisica" id="denunciante-extrafisico-tab" data-toggle="pill" href="#pills-denunciante-extrafisico" role="tab" aria-controls="pills-denunciante-extrafisico" aria-selected="false">Datos de la víctima u ofendido</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="pillPrincipalFisica" id="pills-denunciante-personafisico" role="tabpanel" aria-labelledby="denunciante-personafisico-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'denunciante'"></personafisica>
            </div>
            <div :class="pillsFisica1" id="pills-denunciante-domiciliofisico" role="tabpanel" aria-labelledby="denunciante-domiciliofisico-tab">
                <domicilio :tipo="'domicilio'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica2" id="pills-denunciante-trabajofisico" role="tabpanel" aria-labelledby="denunciante-trabajofisico-tab">
                <domicilio :tipo="'trabajo'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica3" id="pills-denunciante-notificacionesfisico" role="tabpanel" aria-labelledby="denunciante-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false"></domicilio>
            </div>
            <div :class="pillsFisica4" id="pills-denunciante-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciante-extrafisico-tab">
                <extrasdenunciante :sistema="sistema"></extrasdenunciante>
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
                this.tabsFisica='nav-link'
            },
            idPersonaMoral(){
                this.tabsFisica='nav-link disabled'
                this.tabPrincipalFisica='nav-link active show'
                this.pillsFisica1='tab-pane fade'
                this.pillsFisica2='tab-pane fade'
                this.pillsFisica3='tab-pane fade'
                this.pillsFisica4='tab-pane fade'
                this.pillPrincipalFisica='tab-pane fade show active'
            }
        },
        computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
