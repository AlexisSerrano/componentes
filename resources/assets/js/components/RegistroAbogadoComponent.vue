<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-pills mb-3 col-10" style="padding-left:15px" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="abogado-persona-tab" data-toggle="pill" href="#pills-abogado-persona" role="tab" aria-controls="pills-abogado-persona" aria-selected="true">Datos Personales</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-abogado-trabajo" role="tab" aria-controls="pills-abogado-trabajo" aria-selected="false">Datos del trabajo</a>
                    </li>
                    <li class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-abogado-extra" role="tab" aria-controls="pills-abogado-extra" aria-selected="false">Datos del abogado</a>
                    </li>
                    <li v-show="this.$store.state.carpetasLigadasFisica!=''" class="nav-item">
                        <a :class="{'nav-link disabled':this.$store.state.idPersonaFisica=='','nav-link':this.$store.state.idPersonaFisica!=''}" data-toggle="pill" href="#pills-abogado-carpetasLigadas" role="tab" aria-controls="pills-abogado-carpetasLigadas" aria-selected="false">Carpetas ligadas</a>
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
            <div class="tab-pane fade show active" id="pills-abogado-persona" role="tabpanel" aria-labelledby="abogado-persona-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'abogado'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-abogado-trabajo" role="tabpanel" aria-labelledby="abogado-trabajo-tab">
                <domicilio :tipo="'trabajo'" :empresa="false" :sistema="sistema"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-abogado-extra" role="tabpanel-fisico" aria-labelledby="abogado-extra-tab">
                <extrasabogado :sistema="sistema" :carpeta="carpeta"></extrasabogado>
            </div>
            <div class="tab-pane fade" id="pills-abogado-carpetasLigadas" role="tabpanel-fisico" aria-labelledby="abogado-carpetasLigadas-tab">
                <notificaciones :tipo="'fisica'"></notificaciones>
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
            cleanFields(){
                this.$store.commit('cleanSearch','fisica')
            }
        }
    }
</script>