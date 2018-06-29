<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="autoridad-persona-tab" data-toggle="pill" href="#pills-autoridad-persona" role="tab" aria-controls="pills-autoridad-persona" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="autoridad-domicilio-tab" data-toggle="pill" href="#pills-autoridad-domicilio" role="tab" aria-controls="pills-autoridad-domicilio" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="autoridad-trabajo-tab" data-toggle="pill" href="#pills-autoridad-trabajo" role="tab" aria-controls="pills-autoridad-trabajo" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="autoridad-extra-tab" data-toggle="pill" href="#pills-autoridad-extra" role="tab" aria-controls="pills-autoridad-extra" aria-selected="false">Datos de autoridad</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-autoridad-persona" role="tabpanel" aria-labelledby="autoridad-persona-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'autoridad'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-autoridad-domicilio" role="tabpanel" aria-labelledby="autoridad-domicilio-tab">
                <domicilio :tipo="'domicilio'" :empresa="false"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-autoridad-trabajo" role="tabpanel" aria-labelledby="autoridad-trabajo-tab">
                <domicilio :tipo="'trabajo'" :empresa="false"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-autoridad-extra" role="tabpanel-fisico" aria-labelledby="autoridad-extra-tab">
                <extrasautoridad :sistema="sistema"></extrasautoridad>
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
        } 
    }
</script>
