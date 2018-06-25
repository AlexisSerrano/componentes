<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="tabPrincipalMoral" id="denunciante-personamoral-tab" data-toggle="pill" href="#pills-denunciante-personamoral" role="tab" aria-controls="pills-denunciante-personamoral" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(1)" :class="tabsMoral" id="denunciante-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciante-domiciliomoral" role="tab" aria-controls="pills-denunciante-domiciliomoral" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(2)" :class="tabsMoral" id="denunciante-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciante-notificacionesmoral" role="tab" aria-controls="#pills-denunciante-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(3)" :class="tabsMoral" id="denunciante-extramoral-tab" data-toggle="pill" href="#pills-denunciante-extramoral" role="tab" aria-controls="pills-denunciante-extramoral" aria-selected="false">Datos de la víctima u ofendido</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="pillPrincipalMoral" id="pills-denunciante-personamoral" role="tabpanel" aria-labelledby="denunciante-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciantemoral'"></personamoral>
            </div>
            <div :class="pillsMoral1" id="pills-denunciante-domiciliomoral" role="tabpanel" aria-labelledby="denunciante-domiciliomoral-tab">
                <domicilio :empresa="true"></domicilio>
            </div>
            <div :class="pillsMoral2" id="pills-denunciante-notificacionesmoral" role="tabpanel" aria-labelledby="denunciante-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true"></domicilio>
            </div>
            <div :class="pillsMoral3" id="pills-denunciante-extramoral" role="tabpanel-moral" aria-labelledby="denunciante-extramoral-tab">
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
                tabPrincipalMoral:'nav-link active show',
                tabsMoral:'nav-link disabled',
                pillPrincipalMoral:'tab-pane fade show active',
                pillsMoral1:'tab-pane fade',          
                pillsMoral2:'tab-pane fade',           
                pillsMoral3:'tab-pane fade',            
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
            ubicacionTabsMoral(numeroTab){
                if(this.tabsMoral!='nav-link disabled'){
                    this.tabPrincipalMoral='nav-link'
                    this.pillPrincipalMoral='tab-pane fade'
                    if(numeroTab==1){
                        this.pillsMoral2 = 'tab-pane fade'
                        this.pillsMoral3 = 'tab-pane fade'
                        this.pillsMoral1 = 'tab-pane fade show active'
                    }
                    else if(numeroTab==2){
                        this.pillsMoral1 = 'tab-pane fade'
                        this.pillsMoral3 = 'tab-pane fade'
                        this.pillsMoral2 = 'tab-pane fade show active' 
                    }      
                    else if(numeroTab==3){
                        this.pillsMoral1 = 'tab-pane fade'
                        this.pillsMoral2 = 'tab-pane fade'
                        this.pillsMoral3 = 'tab-pane fade show active'
                    }       
                }  
            }
        },
        watch: {
            idPersonaMoral() {
                this.tabsMoral='nav-link'

            },
            idPersonaFisica() {
                this.tabsMoral='nav-link disabled'
                this.tabPrincipalMoral='nav-link active show'
                this.pillsMoral1='tab-pane fade'
                this.pillsMoral2='tab-pane fade'
                this.pillsMoral3='tab-pane fade'
                this.pillPrincipalMoral='tab-pane fade show active'
            }
        },
        computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
