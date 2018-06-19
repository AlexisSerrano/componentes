<template>
    <div>
        <!-- MENÚ -->
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-persona" role="tab" aria-controls="pills-home" aria-selected="true">Datos Laborales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-domicilio" role="tab" aria-controls="pills-profile" aria-selected="false">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-trabajo" role="tab" aria-controls="pills-contact" aria-selected="false">Datos del trabajo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-notificaciones" role="tab" aria-controls="pills-contact" aria-selected="false">Domicilio para notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-extra" role="tab" aria-controls="pills-contact" aria-selected="false">Datos de la víctima u ofendido</a>
                </li>
            </ul>
        </div>
        <!-- MENÚ -->


        <!-- OPCIONES -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-persona" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="form-row container-fluid">
                    <div class="form-group col-md-6">
                        <div class="form-check" style="padding: 0">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label col-form-label col-form-label-sm" for="personaFisica" style="padding-right: 5px">Persona física</label>
                                <input class="form-check-input" type="radio" v-model="persona" id="personaFisica" value="1">
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label col-form-label col-form-label-sm" for="personaMoral" style="padding-right: 5px">Persona moral</label>
                                <input class="form-check-input" type="radio" v-model="persona" id="personaMoral" value="2">
                            </div>
                        </div>
                    </div>
                </div>
                <personafisica v-show="persona==1" :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciante'"></personafisica>
                <personamoral v-show="persona==2" :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciantemoral'"></personamoral> 
            </div>
            <div class="tab-pane fade" id="pills-domicilio" role="tabpanel" aria-labelledby="pills-profile-tab">
                <domicilio></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-trabajo" role="tabpanel" aria-labelledby="pills-contact-tab">
                <domicilio :tipo="'trabajo'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-notificaciones" role="tabpanel" aria-labelledby="pills-contact-tab">
                <domicilio :tipo="'contacto'"></domicilio>
            </div>
            <div class="tab-pane fade" id="pills-extra" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
        <!-- OPCIONES -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                persona: ''
            }
        },
    }
</script>

<style scoped>

</style>