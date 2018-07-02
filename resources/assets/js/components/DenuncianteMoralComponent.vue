<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a @click="numeroTab=1" :class="{'nav-link active':numeroTab==1 || this.$store.state.idPersonaMoral==''||this.$store.state.idPersonaFisica!='','nav-link':this.numeroTab!=1}" id="denunciante-personamoral-tab" data-toggle="pill" href="#pills-denunciante-personamoral" role="tab" aria-controls="pills-denunciante-personamoral" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=2" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciante-domiciliomoral" role="tab" aria-controls="pills-denunciante-domiciliomoral" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=3" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciante-notificacionesmoral" role="tab" aria-controls="#pills-denunciante-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=4" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-extramoral-tab" data-toggle="pill" href="#pills-denunciante-extramoral" role="tab" aria-controls="pills-denunciante-extramoral" aria-selected="false">Datos de la víctima u ofendido</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadasMoral!=''" class="nav-item">
                        <a @click="numeroTab=5" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciante-carpetasLigadasMoral-tab" data-toggle="pill" href="#pills-denunciante-carpetasLigadasMoral" role="tab" aria-controls="pills-denunciante-carpetasLigadasMoral" aria-selected="false">Carpetas Ligadas</a>
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
            <div :class="{'tab-pane fade show active':this.$store.state.idPersonaMoral==''||this.$store.state.idPersonaFisica!='','tab-pane fade':this.numeroTab!=1}" id="pills-denunciante-personamoral" role="tabpanel" aria-labelledby="denunciante-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciantemoral'"></personamoral>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciante-domiciliomoral" role="tabpanel" aria-labelledby="denunciante-domiciliomoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciante-notificacionesmoral" role="tabpanel" aria-labelledby="denunciante-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciante-extramoral" role="tabpanel-moral" aria-labelledby="denunciante-extramoral-tab">
                <extrasdenunciante :sistema="sistema" :empresa="true"></extrasdenunciante>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciante-carpetasLigadasMoral" role="tabpanel-moral" aria-labelledby="denunciante-carpetasLigadasMoral-tab">
                <notificaciones :tipo="'moral'"></notificaciones>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>
<script>
    export default {
        data() {
            return {
                numeroTab:1
            }
        },
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
                this.$store.commit('cleanSearch','moral')
            }
        }
    }
</script>
