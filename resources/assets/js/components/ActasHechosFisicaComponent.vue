<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="actasHechos-personafisico-tab" data-toggle="pill" href="#pills-actasHechos-personafisico" role="tab" aria-controls="pills-actasHechos-personafisico" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasHechos-domiciliofisico-tab" data-toggle="pill" href="#pills-actasHechos-domiciliofisico" role="tab" aria-controls="pills-actasHechos-domiciliofisico" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasHechos-extrafisico-tab" data-toggle="pill" href="#pills-actasHechos-extrafisico" role="tab" aria-controls="pills-actasHechos-extrafisico" aria-selected="false">Acta de hechos</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="actasHechos-carpetasLigadasFisica-tab" data-toggle="pill" href="#pills-actasHechos-carpetasLigadasFisica" role="tab" aria-controls="pills-actasHechos-carpetasLigadasFisica" aria-selected="false">Carpetas ligadas</a>
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
            <div class="tab-pane fade show active" id="pills-actasHechos-personafisico" role="tabpanel" aria-labelledby="actasHechos-personafisico-tab">
                <personafisica :sistema="sistema" :tipo="'actashechos'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-domiciliofisico" role="tabpanel" aria-labelledby="actasHechos-domiciliofisico-tab">
                <domicilio :tipo="'domicilio'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-extrafisico" role="tabpanel-fisico" aria-labelledby="actasHechos-extrafisico-tab">
                <extrasactashechos :sistema="sistema" :empresa="false"></extrasactashechos>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-carpetasLigadasFisica" role="tabpanel-fisico" aria-labelledby="actasHechos-carpetasLigadasFisica-tab">
                <notificaciones :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    export default {
        props: ['sistema','carpeta'],
        methods: {
            cleanFields(){
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
