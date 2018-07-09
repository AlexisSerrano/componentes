<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="conocido-personafisica-tab" data-toggle="pill" href="#pills-conocido-personafisica" role="tab" aria-controls="pills-conocido-personafisica" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="conocido-domiciliofisica-tab" data-toggle="pill" href="#pills-conocido-domiciliofisica" role="tab" aria-controls="pills-conocido-domiciliofisica" aria-selected="false">Domicilio</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" id="conocido-extrafisica-tab" data-toggle="pill" href="#pills-conocido-extrafisica" role="tab" aria-controls="pills-conocido-extrafisica" aria-selected="false">Datos del investigado</a>
                    </li>
                </ul>
                <div class="col-2 d-flex align-items-start justify-content-end">
                    <button v-if="personasEncontradas!=''" type="button" class="btn btn-primary" @click="cleanFields">
                        <icon name="eraser" style="color:white"></icon>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-conocido-personafisica" role="tabpanel" aria-labelledby="conocido-personafisica-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'conocido'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-conocido-domiciliofisica" role="tabpanel" aria-labelledby="conocido-domiciliofisica-tab">
                <domicilio :tipo="'domicilio'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-conocido-extrafisica" role="tabpanel-fisica" aria-labelledby="conocido-extrafisica-tab">
                <extrasconocido :sistema="sistema" :empresa="false" :carpeta="carpeta"></extrasconocido>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
import { mapState } from "vuex";
import swal from 'sweetalert2'
    export default {
        data() {
            return {
                particulares:''
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
                this.$store.commit('cleanStore')
            }
        },
        computed: mapState(['personasEncontradas'])
    }
</script>
