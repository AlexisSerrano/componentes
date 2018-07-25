<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3 colorNav" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="conocido-personaMoral-tab" data-toggle="pill" href="#pills-conocido-personaMoral" role="tab" aria-controls="pills-conocido-personaMoral" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="conocido-domicilioMoral-tab" data-toggle="pill" href="#pills-conocido-domicilioMoral" role="tab" aria-controls="pills-conocido-domicilioMoral"
                        aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a :class="{'nav-link disabled':this.$store.state.idPersonaMoral=='','nav-link':this.$store.state.idPersonaMoral!=''}" id="conocido-extraMoral-tab" data-toggle="pill" href="#pills-conocido-extraMoral" role="tab" aria-controls="pills-conocido-extraMoral"
                        aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->
    
    
        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-conocido-personaMoral" role="tabpanel" aria-labelledby="conocido-personaMoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'conocidomoral'" :usuario="usuario"></personamoral>
            </div>
            <div class="tab-pane fade" id="pills-conocido-domicilioMoral" role="tabpanel" aria-labelledby="conocido-domicilioMoral-tab">
                <domicilio v-if="this.$store.state.idPersonaMoral" :tipo="'domicilio'" :empresa="true" :sistema="sistema" :usuario="usuario"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-conocido-extraMoral" role="tabpanel-Moral" aria-labelledby="conocido-extraMoral-tab">
                <extrasconocido v-if="this.$store.state.idPersonaMoral" :sistema="sistema" :empresa="true" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario"></extrasconocido>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    import extrasconocido from '../Extras/ExtrasConocidoComponent.vue';
    import {
        mapState
    } from "vuex";
    import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares: ''
            }
        },
        props: ['sistema', 'carpeta', 'idcarpeta' ,'usuario'],
        components: { extrasconocido },
    }
</script>
