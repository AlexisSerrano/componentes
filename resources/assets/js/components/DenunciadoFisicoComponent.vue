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
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciado-domiciliofisico" role="tab" aria-controls="pills-denunciado-domiciliofisico" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-trabajofisico-tab" data-toggle="pill" href="#pills-denunciado-trabajofisico" role="tab" aria-controls="pills-denunciado-trabajofisico" aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciado-notificacionesfisico" role="tab" aria-controls="#pills-denunciado-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciado-extrafisico-tab" data-toggle="pill" href="#pills-denunciado-extrafisico" role="tab" aria-controls="pills-denunciado-extrafisico" aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadasFisica!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-carpetasLigadasFisica-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasFisica" role="tab" aria-controls="pills-denunciante-carpetasLigadasFisica" aria-selected="false">Carpetas ligadas</a>
                    </li>
                </ul>
                <div class="col-2 d-flex align-items-start justify-content-end">
                    <button v-if="this.$store.state.fisicaEncontrada && this.$store.state.idPersonaFisica==''" type="button" class="btn btn-primary" @click="cleanFields">
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
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'denunciado'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-domiciliofisico" role="tabpanel" aria-labelledby="denunciado-domiciliofisico-tab">
                <domicilio :tipo="'domicilio'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-trabajofisico" role="tabpanel" aria-labelledby="denunciado-trabajofisico-tab">
                <domicilio :tipo="'trabajo'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-notificacionesfisico" role="tabpanel" aria-labelledby="denunciado-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciado-extrafisico-tab">
                <extrasinvestigado :sistema="sistema" :empresa="false"></extrasinvestigado>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="denunciante-carpetasLigadasFisica-tab">
                <notificaciones :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    export default {
        props: {
            sistema: {
                required:true
            },
            carpeta:{
                required:true
            }
        },
        methods: {
            cleanFields(){
                this.$store.commit('cleanSearch','fisica')
            }
        }
    }
</script>
