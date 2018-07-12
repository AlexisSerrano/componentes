<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="actasHechos-personaMoral-tab" data-toggle="pill" href="#pills-actasHechos-personaMoral" role="tab" aria-controls="pills-actasHechos-personaMoral" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="actasHechos-domicilioMoral-tab" data-toggle="pill" href="#pills-actasHechos-domicilioMoral" role="tab" aria-controls="pills-actasHechos-domicilioMoral" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="actasHechos-extraMoral-tab" data-toggle="pill" href="#pills-actasHechos-extraMoral" role="tab" aria-controls="pills-actasHechos-extraMoral" aria-selected="false">Acta de hechos</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="actasHechos-carpetasLigadasMoral-tab" data-toggle="pill" href="#pills-actasHechos-carpetasLigadasMoral" role="tab" aria-controls="pills-actasHechos-carpetasLigadasMoral" aria-selected="false">Carpetas ligadas</a>
                    </li>
                </ul>
                <div class="col-2 d-flex align-items-start justify-content-end">
                    <button v-if="this.$store.state.moralEncontrada && this.$store.state.idPersonaMoral==''" type="button" class="btn btn-primary" @click="cleanFields">
                        <icon name="eraser" style="color:white"></icon>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-actasHechos-personaMoral" role="tabpanel" aria-labelledby="actasHechos-personaMoral-tab">
                <personamoral :sistema="sistema" :tipo="'actashechosmoral'" :usuario="usuario"></personamoral>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-domicilioMoral" role="tabpanel" aria-labelledby="actasHechos-domicilioMoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-extraMoral" role="tabpanel-Moral" aria-labelledby="actasHechos-extraMoral-tab">
                <extrasactashechos :sistema="sistema" :empresa="true" :usuario="usuario"></extrasactashechos>
            </div>
            <div class="tab-pane fade" id="pills-actasHechos-carpetasLigadasMoral" role="tabpanel-Moral" aria-labelledby="actasHechos-carpetasLigadasMoral-tab">
                <notificaciones :tipo="'moral'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasactashechos from './ExtrasActasHechosComponent.vue';
    export default {
        props: ['sistema','carpeta','usuario'],
        components: {extrasactashechos},
        methods: {
            cleanFields(){
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
