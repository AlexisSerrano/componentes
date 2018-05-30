<template>
<div class="container">
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefonos">Telefonos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalTelefonos">+</span></label>
                <v-select multiple v-model="telefonos"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correos">Correos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalCorreos">+</span></label>
                <v-select multiple v-model="correos" :options="options"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="redes">Redes Sociales <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalRedes">+</span></label>
                <v-select multiple v-model="redes"></v-select>
            </div>
        </div>
    </form>
    <!--MODAL TELEFONO-->
    <div class="modal fade" id="ModalTelefonos" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar teléfono</h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipoTelefono">Tipo</label>
                            <v-select></v-select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero">Número</label>
                            <input type="text" name="telefono">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL CORREO-->
    <div class="modal fade" id="ModalCorreos" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar correo</h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipoCorreo">Tipo</label>
                            <v-select></v-select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="correo">Correo</label>
                            <input type="email" name="correo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('correo') }" id="correos" placeholder="Correos" v-validate="'required'" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL REDES-->
    <div class="modal fade" id="ModalRedes" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Redes Sociales</h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipoRedes">Tipo</label>
                            <v-select></v-select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>







</template>
<script>

</script>