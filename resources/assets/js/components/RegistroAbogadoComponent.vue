<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="abogado-persona-tab" data-toggle="pill" href="#pills-abogado-persona" role="tab" aria-controls="pills-abogado-persona" aria-selected="true">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="abogado-trabajo-tab" data-toggle="pill" href="#pills-abogado-trabajo" role="tab" aria-controls="pills-abogado-trabajo" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="abogado-extra-tab" data-toggle="pill" href="#pills-abogado-extra" role="tab" aria-controls="pills-abogado-extra" aria-selected="false">Datos del abogado</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-abogado-persona" role="tabpanel" aria-labelledby="abogado-persona-tab">
                <personafisica :sistema="sistema" :carpeta="carpeta" :tipo="'abogado'"></personafisica>
            </div>
            <div class="tab-pane fade" id="pills-abogado-trabajo" role="tabpanel" aria-labelledby="abogado-trabajo-tab">
                <domicilio :tipo="'trabajo'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-abogado-extra" role="tabpanel-fisico" aria-labelledby="abogado-extra-tab">
                <extrasabogado :sistema="sistema"></extrasabogado>
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