<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="denunciado-personamoral-tab" data-toggle="pill" href="#pills-denunciado-personamoral" role="tab" aria-controls="pills-denunciado-personamoral" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-domiciliomoral-tab" data-toggle="pill" href="#pills-denunciado-domiciliomoral" role="tab" aria-controls="pills-denunciado-domiciliomoral" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-notificacionesmoral-tab" data-toggle="pill" href="#pills-denunciado-notificacionesmoral" role="tab" aria-controls="#pills-denunciado-notificacionesmoral" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-extramoral-tab" data-toggle="pill" href="#pills-denunciado-extramoral" role="tab" aria-controls="pills-denunciado-extramoral" aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-denunciado-personamoral" role="tabpanel" aria-labelledby="denunciado-personamoral-tab">
                <personamoral :sistema="sistema" :carpeta="carpeta" :tipo="'denunciadomoral'"></personamoral>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-domiciliomoral" role="tabpanel" aria-labelledby="denunciado-domiciliomoral-tab">
                <domicilio :tipo="'domicilio'" :empresa="true"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-notificacionesmoral" role="tabpanel" aria-labelledby="denunciado-notificacionesmoral-tab">
                <domicilio :tipo="'contacto'" :empresa="true"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-extramoral" role="tabpanel-moral" aria-labelledby="denunciado-extramoral-tab">
                <extrasinvestigado :sistema="sistema"></extrasinvestigado>
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
    }
</script>
