<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <ul class="nav nav-pills mb-3 colorNav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="denunciado-personamoral-tab" data-toggle="pill" href="#pills-denunciado-personamoral" role="tab" aria-controls="pills-denunciado-personamoral" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciado-domiciliomoral" role="tab" aria-controls="pills-denunciado-domiciliomoral" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciado-notificacionesmoral" role="tab" aria-controls="#pills-denunciado-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-extramoral-tab" data-toggle="pill" href="#pills-denunciado-extramoral" role="tab" aria-controls="pills-denunciado-extramoral" aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-carpetasLigadasMoral-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasMoral" role="tab" aria-controls="pills-denunciante-carpetasLigadasMoral" aria-selected="false">Carpetas Ligadas</a>
                    </li>
                </ul>
                <div>
                    <button v-if="this.$store.state.moralEncontrada  && this.$store.state.idPersonaMoral==''" type="button" class="btn btn-primary" @click="cleanFields">
                        <icon name="eraser" style="color:white"></icon>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-denunciado-personamoral" role="tabpanel" aria-labelledby="denunciado-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'denunciadomoral'" :usuario="usuario" :idvarpersona="idvarpersona"></personamoral>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-domiciliomoral" role="tabpanel" aria-labelledby="denunciado-domiciliomoral-tab">
                <domicilio v-show="this.$store.state.idPersonaMoral" :tipo="'domicilio'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-notificacionesmoral" role="tabpanel" aria-labelledby="denunciado-notificacionesmoral-tab">
                <domicilio v-show="this.$store.state.idPersonaMoral" :tipo="'contacto'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-extramoral" role="tabpanel-moral" aria-labelledby="denunciado-extramoral-tab">
                <extrasinvestigado v-show="this.$store.state.idPersonaMoral" :sistema="sistema" :empresa="true" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario"></extrasinvestigado>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasMoral" role="tabpanel-moral" aria-labelledby="denunciante-carpetasLigadasMoral-tab">
                <notificaciones v-show="this.$store.state.idPersonaMoral" :tipo="'moral'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasinvestigado from '../Extras/ExtrasInvestigadoComponent.vue';
    export default {
        props: ['sistema', 'carpeta', 'idcarpeta' ,'usuario', 'idvarpersona'],
        components: {extrasinvestigado},
        methods: {
            cleanFields(){
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
