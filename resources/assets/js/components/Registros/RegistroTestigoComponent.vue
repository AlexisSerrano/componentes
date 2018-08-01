<template>
    <div class="pb-3 pt-3">
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <ul class="nav nav-pills mb-3 colorNav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="testigo-persona-tab" data-toggle="pill" href="#pills-testigo-persona" role="tab" aria-controls="pills-testigo-persona" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="testigo-domicilio-tab" data-toggle="pill" href="#pills-testigo-domicilio" role="tab" aria-controls="pills-testigo-domicilio" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-testigo-trabajo" role="tab" aria-controls="pills-testigo-trabajo" aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-testigo-notificaciones" role="tab" aria-controls="pills-testigo-notificaciones" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadas!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-testigo-carpetasLigadas" role="tab" aria-controls="pills-testigo-carpetasLigadas" aria-selected="false">Carpetas ligadas</a>
                    </li>
                </ul>
                <div>
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
            <div class="tab-pane fade show active" id="pills-testigo-persona" role="tabpanel" aria-labelledby="testigo-persona-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'testigo'" :usuario="usuario" :idvarpersona="idvarpersona"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-testigo-domicilio" role="tabpanel" aria-labelledby="testigo-domicilio-tab">
                <domicilio v-show="this.$store.state.idPersonaFisica" :tipo="'domicilio'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-testigo-trabajo" role="tabpanel" aria-labelledby="testigo-trabajo-tab">
                <domicilio v-show="this.$store.state.idPersonaFisica" :tipo="'trabajo'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-testigo-notificaciones" role="tabpanel" aria-labelledby="testigo-notificaciones-tab">
                <domicilio v-show="this.$store.state.idPersonaFisica" :tipo="'contacto'" :empresa="false" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-testigo-carpetasLigadas" role="tabpanel-fisico" aria-labelledby="testigo-carpetasLigadas-tab">
                <notificaciones v-show="this.$store.state.idPersonaFisica" :tipo="'fisica'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    export default {
        props: ['sistema', 'carpeta', 'idcarpeta', 'usuario', 'idvarpersona'],
        methods: {
            cleanFields() {
                this.$store.commit('cleanStore')
            }
        }
    }
</script>
