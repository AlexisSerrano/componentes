<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a @click="numeroTab=1" :class="{'nav-link active':numeroTab==1 || this.$store.state.idPersonaFisica==''||this.$store.state.idPersonaMoral!='','nav-link':this.numeroTab!=1}" id="denunciante-personafisico-tab" data-toggle="pill" href="#pills-denunciante-personafisico" role="tab" aria-controls="pills-denunciante-personafisico" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=2" :class="{'nav-link disabled':this.$store.state.idPersonaFisica==''|| this.$store.state.idPersonaMoral!='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciante-domiciliofisico" role="tab" aria-controls="pills-denunciante-domiciliofisico" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=3" :class="{'nav-link disabled':this.$store.state.idPersonaFisica==''|| this.$store.state.idPersonaMoral!='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-trabajofisico-tab" data-toggle="pill" href="#pills-denunciante-trabajofisico" role="tab" aria-controls="pills-denunciante-trabajofisico" aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=4" :class="{'nav-link disabled':this.$store.state.idPersonaFisica==''|| this.$store.state.idPersonaMoral!='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciante-notificacionesfisico" role="tab" aria-controls="#pills-denunciante-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=5" :class="{'nav-link disabled':this.$store.state.idPersonaFisica==''|| this.$store.state.idPersonaMoral!='','nav-link':this.$store.state.idPersonaFisica!=''}" id="denunciante-extrafisico-tab" data-toggle="pill" href="#pills-denunciante-extrafisico" role="tab" aria-controls="pills-denunciante-extrafisico" aria-selected="false">Datos de la víctima u ofendido</a>
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
            <div :class="{'tab-pane fade show active':this.$store.state.idPersonaFisica==''||this.$store.state.idPersonaMoral!='','tab-pane fade':this.numeroTab!=1}" id="pills-denunciante-personafisico" role="tabpanel" aria-labelledby="denunciante-personafisico-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'denunciante'"></personafisica>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaMoral!=''||this.$store.state.moralEncontrada!=''}" id="pills-denunciante-domiciliofisico" role="tabpanel" aria-labelledby="denunciante-domiciliofisico-tab">
                <domicilio :tipo="'domicilio'" :empresa="false"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaMoral!=''||this.$store.state.moralEncontrada!=''}" id="pills-denunciante-trabajofisico" role="tabpanel" aria-labelledby="denunciante-trabajofisico-tab">
                <domicilio :tipo="'trabajo'" :empresa="false"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaMoral!=''||this.$store.state.moralEncontrada!=''}" id="pills-denunciante-notificacionesfisico" role="tabpanel" aria-labelledby="denunciante-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'" :empresa="false"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaMoral!=''||this.$store.state.moralEncontrada!=''}" id="pills-denunciante-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciante-extrafisico-tab">
                <extrasdenunciante :sistema="sistema" :empresa="false"></extrasdenunciante>
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
                this.$store.commit('cleanSearch','fisica')
            }
        }
    }
</script>
