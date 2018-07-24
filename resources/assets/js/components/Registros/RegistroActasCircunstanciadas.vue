<template>
    <div class="pb-3 pt-1">
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="actasCircunstanciadas-personafisico-tab" data-toggle="pill" href="#pills-actasCircunstanciadas-personafisico" role="tab" aria-controls="pills-actasCircunstanciadas-personafisico" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasCircunstanciadas-domiciliofisico-tab" data-toggle="pill" href="#pills-actasCircunstanciadas-domiciliofisico" role="tab" aria-controls="pills-actasCircunstanciadas-domiciliofisico" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasCircunstanciadas-extrafisico-tab" data-toggle="pill" href="#pills-actasCircunstanciadas-extrafisico" role="tab" aria-controls="pills-actasCircunstanciadas-extrafisico" aria-selected="false">Acta circunstanciada</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasCircunstanciadas-carpetasLigadasFisica-tab" data-toggle="pill" href="#pills-actasCircunstanciadas-carpetasLigadasFisica" role="tab" aria-controls="pills-actasCircunstanciadas-carpetasLigadasFisica" aria-selected="false">Carpetas ligadas</a>
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
            <div class="tab-pane fade show active" id="pills-actasCircunstanciadas-personafisico" role="tabpanel" aria-labelledby="actasCircunstanciadas-personafisico-tab">
                <personafisica :sistema="sistema" :tipo="'actascircunstanciadas'" :usuario="usuario"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-actasCircunstanciadas-domiciliofisico" role="tabpanel" aria-labelledby="actasCircunstanciadas-domiciliofisico-tab">
                <domicilio v-if="this.$store.state.idPersonaFisica" :tipo="'domicilio'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-actasCircunstanciadas-extrafisico" role="tabpanel-fisico" aria-labelledby="actasCircunstanciadas-extrafisico-tab">
                <extrasactascircunstanciadas v-if="this.$store.state.idPersonaFisica" :sistema="sistema" :empresa="false" :usuario="usuario"></extrasactascircunstanciadas>
            </div>
            <div class="tab-pane fade" id="pills-actasCircunstanciadas-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="actasCircunstanciadas-carpetasLigadasFisica-tab">
                <notificaciones v-if="this.$store.state.idPersonaFisica" :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasactascircunstanciadas from '../Extras/ExtrasActasCircunstanciadasComponent.vue';
    export default {
        props: ['sistema', 'usuario'],
        components: {extrasactascircunstanciadas},
        methods: {
            cleanFields(){
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
