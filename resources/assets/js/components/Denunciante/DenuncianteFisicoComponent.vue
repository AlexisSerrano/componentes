<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="denunciante-personafisico-tab" data-toggle="pill" href="#pills-denunciante-personafisico" role="tab" aria-controls="pills-denunciante-personafisico" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciante-domiciliofisico" role="tab" aria-controls="pills-denunciante-domiciliofisico" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-trabajofisico-tab" data-toggle="pill" href="#pills-denunciante-trabajofisico" role="tab" aria-controls="pills-denunciante-trabajofisico" aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciante-notificacionesfisico" role="tab" aria-controls="#pills-denunciante-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-extrafisico-tab" data-toggle="pill" href="#pills-denunciante-extrafisico" role="tab" aria-controls="pills-denunciante-extrafisico" aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
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
            <div class="tab-pane fade show active" id="pills-denunciante-personafisico" role="tabpanel" aria-labelledby="denunciante-personafisico-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'denunciante'" :usuario="usuario"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-domiciliofisico" role="tabpanel" aria-labelledby="denunciante-domiciliofisico-tab">
                <domicilio v-if="this.$store.state.idPersonaFisica" :tipo="'domicilio'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-trabajofisico" role="tabpanel" aria-labelledby="denunciante-trabajofisico-tab">
                <domicilio v-if="this.$store.state.idPersonaFisica" :tipo="'trabajo'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-notificacionesfisico" role="tabpanel" aria-labelledby="denunciante-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciante-extrafisico-tab">
                <extrasdenunciante v-if="this.$store.state.idPersonaFisica" :sistema="sistema" :empresa="false" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario"></extrasdenunciante>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="denunciante-carpetasLigadasFisica-tab">
                <notificaciones v-if="this.$store.state.idPersonaFisica" :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasdenunciante from '../Extras/ExtrasDenuncianteComponent.vue';
    export default {
        props: ['sistema', 'carpeta', 'idcarpeta' ,'usuario'],
        components: {extrasdenunciante},
        methods: {
            cleanFields(){
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
