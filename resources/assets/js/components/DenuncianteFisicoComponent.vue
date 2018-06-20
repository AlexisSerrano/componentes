<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="denunciante-personafisico-tab" data-toggle="pill" href="#pills-denunciante-personafisico" role="tab" aria-controls="pills-denunciante-personafisico" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciante-domiciliofisico-tab" data-toggle="pill" href="#pills-denunciante-domiciliofisico" role="tab" aria-controls="pills-denunciante-domiciliofisico" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciante-trabajofisico-tab" data-toggle="pill" href="#pills-denunciante-trabajofisico" role="tab" aria-controls="pills-denunciante-trabajofisico" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciante-notificacionesfisico-tab" data-toggle="pill" href="#pills-denunciante-notificacionesfisico" role="tab" aria-controls="#pills-denunciante-notificacionesfisico" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="denunciante-extrafisico-tab" data-toggle="pill" href="#pills-denunciante-extrafisico" role="tab" aria-controls="pills-denunciante-extrafisico" aria-selected="false">Datos de la víctima u ofendido</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-denunciante-personafisico" role="tabpanel" aria-labelledby="denunciante-personafisico-tab">
                <personafisica :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciante'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-domiciliofisico" role="tabpanel" aria-labelledby="denunciante-domiciliofisico-tab">
                <domicilio></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-trabajofisico" role="tabpanel" aria-labelledby="denunciante-trabajofisico-tab">
                <domicilio :tipo="'trabajo'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-notificacionesfisico" role="tabpanel" aria-labelledby="denunciante-notificacionesfisico-tab">
                <domicilio :tipo="'contacto'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-denunciante-extrafisico" role="tabpanel-fisico" aria-labelledby="denunciante-extrafisico-tab">
                <extrasdenunciante :sistema="'uat'"></extrasdenunciante>
            </div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>