<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="tabPrincipalMoral" id="denunciado-personamoral-tab" data-toggle="pill" href="#pills-denunciado-personamoral" role="tab" aria-controls="pills-denunciado-personamoral" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(1)" :class="tabsMoral" id="denunciado-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciado-domiciliomoral" role="tab" aria-controls="pills-denunciado-domiciliomoral" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(2)" :class="tabsMoral" id="denunciado-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciado-notificacionesmoral" role="tab" aria-controls="#pills-denunciado-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral(3)" :class="tabsMoral" id="denunciado-extramoral-tab" data-toggle="pill" href="#pills-denunciado-extramoral" role="tab" aria-controls="pills-denunciado-extramoral" aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="pillPrincipalMoral" id="pills-denunciado-personamoral" role="tabpanel" aria-labelledby="denunciado-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciadomoral'"></personamoral>
            </div>
            <div :class="pillsMoral1" id="pills-denunciado-domiciliomoral" role="tabpanel" aria-labelledby="denunciado-domiciliomoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true"></domicilio>
            </div>
            <div :class="pillsMoral2" id="pills-denunciado-notificacionesmoral" role="tabpanel" aria-labelledby="denunciado-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true"></domicilio>
            </div>
            <div :class="pillsMoral3" id="pills-denunciado-extramoral" role="tabpanel-moral" aria-labelledby="denunciado-extramoral-tab">
                <extrasinvestigado :sistema="sistema" :tipo="'moral'"></extrasinvestigado>
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
                if(this.$store.state.idPersonaFisica==''){
                    this.tabsMoral='nav-link'
                }
            },
            idPersonaFisica() {
                if(this.$store.state.idPersonaMoral==''){
                    this.tabsMoral='nav-link disabled'
                    this.tabPrincipalMoral='nav-link active show'
                    this.pillsMoral1='tab-pane fade'
                    this.pillsMoral2='tab-pane fade'
                    this.pillsMoral3='tab-pane fade'
                    this.pillPrincipalMoral='tab-pane fade show active'
                }
            }
        },
        computed:mapState(['idPersonaFisica','idPersonaMoral'])
    }
</script>
