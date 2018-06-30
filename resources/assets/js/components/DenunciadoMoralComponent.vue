<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a @click="numeroTab=1" :class="{'nav-link active':numeroTab==1 || this.$store.state.idPersonaMoral==''||this.$store.state.idPersonaFisica!='','nav-link':this.numeroTab!=1}" id="denunciado-personamoral-tab" data-toggle="pill" href="#pills-denunciado-personamoral" role="tab" aria-controls="pills-denunciado-personamoral" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=2" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciado-domiciliomoral" role="tab" aria-controls="pills-denunciado-domiciliomoral" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=3" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciado-notificacionesmoral" role="tab" aria-controls="#pills-denunciado-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                    </li>
                    <li class="nav-item">
                        <a @click="numeroTab=4" :class="{'nav-link disabled':this.$store.state.idPersonaMoral==''|| this.$store.state.idPersonaFisica!='','nav-link':this.$store.state.idPersonaMoral!=''}" id="denunciado-extramoral-tab" data-toggle="pill" href="#pills-denunciado-extramoral" role="tab" aria-controls="pills-denunciado-extramoral" aria-selected="false">Datos de la víctima u ofendido</a>
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
            <div :class="{'tab-pane fade show active':this.$store.state.idPersonaMoral==''||this.$store.state.idPersonaFisica!='','tab-pane fade':this.numeroTab!=1}" id="pills-denunciado-personamoral" role="tabpanel" aria-labelledby="denunciado-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciadomoral'"></personamoral>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciado-domiciliomoral" role="tabpanel" aria-labelledby="denunciado-domiciliomoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciado-notificacionesmoral" role="tabpanel" aria-labelledby="denunciado-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true"></domicilio>
            </div>
            <div class="tab-pane fade" :class="{'tab-pane fade':this.$store.state.idPersonaFisica!=''||this.$store.state.fisicaEncontrada!=''}" id="pills-denunciado-extramoral" role="tabpanel-moral" aria-labelledby="denunciado-extramoral-tab">
                <extrasinvestigado :sistema="sistema" :empresa="true"></extrasinvestigado>
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
