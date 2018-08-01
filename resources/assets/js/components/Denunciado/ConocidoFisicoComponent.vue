<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <ul class="nav nav-pills mb-3 colorNav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="conocido-personafisica-tab" data-toggle="pill" href="#pills-conocido-personafisica" role="tab" aria-controls="pills-conocido-personafisica" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="conocido-domiciliofisica-tab" data-toggle="pill" href="#pills-conocido-domiciliofisica" role="tab" aria-controls="pills-conocido-domiciliofisica"
                            aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="conocido-extrafisica-tab" data-toggle="pill" href="#pills-conocido-extrafisica" role="tab" aria-controls="pills-conocido-extrafisica"
                            aria-selected="false">Datos del investigado</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-carpetasLigadasFisica-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasFisica" role="tab" aria-controls="pills-denunciante-carpetasLigadasFisica"
                            aria-selected="false">Carpetas ligadas</a>
                    </li>
                </ul>
                <div>
                    <button v-if="personasEncontradas!='' && this.$store.state.idPersonaFisica=='' && showCoincidencias==true" type="button" class="btn btn-primary" @click="cleanFields">
                        <icon name="eraser" style="color:white"></icon>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>
        <!-- MENÚ -->
    
    
        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-conocido-personafisica" role="tabpanel" aria-labelledby="conocido-personafisica-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'conocido'" :usuario="usuario" :idvarpersona="idvarpersona"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-conocido-domiciliofisica" role="tabpanel" aria-labelledby="conocido-domiciliofisica-tab">
                <domicilio v-show="this.$store.state.idPersonaFisica" :tipo="'domicilio'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-conocido-extrafisica" role="tabpanel-fisica" aria-labelledby="conocido-extrafisica-tab">
                <extrasconocido v-show="this.$store.state.idPersonaFisica" :sistema="sistema" :empresa="false" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario"></extrasconocido>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="denunciante-carpetasLigadasFisica-tab">
                <notificaciones v-show="this.$store.state.idPersonaFisica" :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasconocido from '../Extras/ExtrasConocidoComponent.vue';
    import {
        mapState
    } from "vuex";
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares: ''
            }
        },
        props: ['sistema', 'carpeta', 'idcarpeta' , 'usuario', 'idvarpersona'],
        components: {
            extrasconocido
        },
        methods: {
            cleanFields() {
                this.$store.commit('cleanStore','coincidencia')
            }
        },
        computed: mapState(['personasEncontradas','showCoincidencias'])
    }
</script>
