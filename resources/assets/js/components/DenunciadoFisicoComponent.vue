<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="denunciado-personafisico-tab" data-toggle="pill" href="#pills-denunciado-personafisico" role="tab" aria-controls="pills-denunciado-personafisico" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciado-domiciliofisico" role="tab" aria-controls="pills-denunciado-domiciliofisico" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-trabajofisico-tab" data-toggle="pill" href="#pills-denunciado-trabajofisico" role="tab" aria-controls="pills-denunciado-trabajofisico" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciado-notificacionesfisico" role="tab" aria-controls="#pills-denunciado-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciado-extrafisico-tab" data-toggle="pill" href="#pills-denunciado-extrafisico" role="tab" aria-controls="pills-denunciado-extrafisico" aria-selected="false">Datos del investigado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-denunciado-personafisico" role="tabpanel" aria-labelledby="denunciado-personafisico-tab">
                <personafisica :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciado'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-domiciliofisico" role="tabpanel" aria-labelledby="denunciado-domiciliofisico-tab">
                <domicilio></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-trabajofisico" role="tabpanel" aria-labelledby="denunciado-trabajofisico-tab">
                <domicilio :tipo="'trabajo'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-notificacionesfisico" role="tabpanel" aria-labelledby="denunciado-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciado-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciado-extrafisico-tab">
                <extrasinvestigado :sistema="'uat'"></extrasinvestigado>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>