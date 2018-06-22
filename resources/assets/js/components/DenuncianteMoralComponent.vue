<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a :class="this.$store.state.tabPrincipalMoral" id="denunciante-personamoral-tab" data-toggle="pill" href="#pills-denunciante-personamoral" role="tab" aria-controls="pills-denunciante-personamoral" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral" :class="this.$store.state.tabsMoral" id="denunciante-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciante-domiciliomoral" role="tab" aria-controls="pills-denunciante-domiciliomoral" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral" :class="this.$store.state.tabsMoral" id="denunciante-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciante-notificacionesmoral" role="tab" aria-controls="#pills-denunciante-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a @click="ubicacionTabsMoral" :class="this.$store.state.tabsMoral" id="denunciante-extramoral-tab" data-toggle="pill" href="#pills-denunciante-extramoral" role="tab" aria-controls="pills-denunciante-extramoral" aria-selected="false">Datos de la víctima u ofendido</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div :class="this.$store.state.pillPrincipalMoral" id="pills-denunciante-personamoral" role="tabpanel" aria-labelledby="denunciante-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciantemoral'"></personamoral>
            </div>
            <div :class="this.$store.state.pillsMoral" id="pills-denunciante-domiciliomoral" role="tabpanel" aria-labelledby="denunciante-domiciliomoral-tab">
                <domicilio :empresa="true"></domicilio>
            </div>
            <div :class="this.$store.state.pillsMoral" id="pills-denunciante-notificacionesmoral" role="tabpanel" aria-labelledby="denunciante-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true"></domicilio>
            </div>
            <div :class="this.$store.state.pillsMoral" id="pills-denunciante-extramoral" role="tabpanel-moral" aria-labelledby="denunciante-extramoral-tab">
                <extrasdenunciante :sistema="sistema"></extrasdenunciante>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>
<script>
    export default {
        props: {
            sistema: {
                required:true 
            },
            carpeta:{
                required:true
            }
        },
        methods: {
            ubicacionTabsMoral() {
                this.$store.commit('ubicarTabsMoral')
            }
        },
    }
</script>
