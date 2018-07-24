<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
    
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="denunciado-personafisico-tab" data-toggle="pill" href="#pills-denunciado-personafisico" role="tab" aria-controls="pills-denunciado-personafisico" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciado-domiciliofisico" role="tab" aria-controls="pills-denunciado-domiciliofisico"
                            aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-trabajofisico-tab" data-toggle="pill" href="#pills-denunciado-trabajofisico" role="tab" aria-controls="pills-denunciado-trabajofisico"
                            aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciado-notificacionesfisico" role="tab" aria-controls="#pills-denunciado-notificacionesfisico"
                            aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-extrafisico-tab" data-toggle="pill" href="#pills-denunciado-extrafisico" role="tab" aria-controls="pills-denunciado-extrafisico"
                            aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-carpetasLigadasFisica-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasFisica" role="tab" aria-controls="pills-denunciante-carpetasLigadasFisica"
                            aria-selected="false">Carpetas ligadas</a>
                    </li>
                </ul>
                <div class="col-2 d-flex align-items-start justify-content-end">
                    <button v-if="(this.$store.state.fisicaEncontrada && this.$store.state.idPersonaFisica=='') || personasEncontradas!=''" type="button" class="btn btn-primary" @click="cleanFields">
                                <icon name="eraser" style="color:white"></icon>
                                Limpiar
                            </button>
                </div>
            </div>
        </div>
        <!-- MENÚ -->
    
    
        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-denunciado-personafisico" role="tabpanel" aria-labelledby="denunciado-personafisico-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'denunciado'" :usuario="usuario"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-domiciliofisico" role="tabpanel" aria-labelledby="denunciado-domiciliofisico-tab">
                <domicilio v-if="this.$store.state.idPersonaFisica" :tipo="'domicilio'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-trabajofisico" role="tabpanel" aria-labelledby="denunciado-trabajofisico-tab">
                <domicilio v-if="this.$store.state.idPersonaFisica" :tipo="'trabajo'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-notificacionesfisico" role="tabpanel" aria-labelledby="denunciado-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciado-extrafisico-tab">
                <extrasinvestigado v-if="this.$store.state.idPersonaFisica" :sistema="sistema" :empresa="false" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario"></extrasinvestigado>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="denunciante-carpetasLigadasFisica-tab">
                <notificaciones v-if="this.$store.state.idPersonaFisica" :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasinvestigado from '../Extras/ExtrasInvestigadoComponent.vue';
    import { mapState } from "vuex";
    export default {
        props: ['sistema', 'carpeta', 'idcarpeta' ,'usuario'],
        components: {extrasinvestigado},
        methods: {
            cleanFields() {
                this.$store.commit('cleanStore')
            }
        },
        computed: mapState(['personasEncontradas'])
    }
</script>
