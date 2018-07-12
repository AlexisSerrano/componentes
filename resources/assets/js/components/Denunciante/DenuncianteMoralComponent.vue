<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="denunciante-personamoral-tab" data-toggle="pill" href="#pills-denunciante-personamoral" role="tab" aria-controls="pills-denunciante-personamoral" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciante-domiciliomoral" role="tab" aria-controls="pills-denunciante-domiciliomoral"
                            aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciante-notificacionesmoral" role="tab" aria-controls="#pills-denunciante-notificacionesmoral"
                            aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-extramoral-tab" data-toggle="pill" href="#pills-denunciante-extramoral" role="tab" aria-controls="pills-denunciante-extramoral"
                            aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-carpetasLigadasMoral-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasMoral" role="tab" aria-controls="pills-denunciante-carpetasLigadasMoral"
                            aria-selected="false">Carpetas Ligadas</a>
                    </li>
                </ul>
                <div class="col-2 d-flex align-items-start justify-content-end">
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
            <div class="tab-pane fade show active" id="pills-denunciante-personamoral" role="tabpanel" aria-labelledby="denunciante-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciantemoral'" :usuario="usuario"></personamoral>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-domiciliomoral" role="tabpanel" aria-labelledby="denunciante-domiciliomoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-notificacionesmoral" role="tabpanel" aria-labelledby="denunciante-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-extramoral" role="tabpanel-moral" aria-labelledby="denunciante-extramoral-tab">
                <extrasdenunciante :sistema="sistema" :empresa="true" :carpeta="carpeta" :usuario="usuario"></extrasdenunciante>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-carpetasLigadasMoral" role="tabpanel-moral" aria-labelledby="denunciante-carpetasLigadasMoral-tab">
                <notificaciones :tipo="'moral'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasdenunciante from '../Extras/ExtrasDenuncianteComponent.vue';
    export default {
        props: ['sistema', 'carpeta','usuario'],
        components: {
            extrasdenunciante
        },
        methods: {
            cleanFields() {
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
