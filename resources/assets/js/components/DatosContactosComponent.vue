<template>
<div class="container mt-3">
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefonos">Telefonos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalTelefonos">+</span></label>
                <v-select multiple :options="telefonos" v-model="telefono" name="telefono" id="telefono"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correos">Correos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalCorreos">+</span></label>
                <v-select multiple :options="correos" v-model="correo" name="correo" id="correo"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="redes">Redes Sociales <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalRedes">+</span></label>
                <v-select multiple :options="redes" v-model="red" name="red" id="red"></v-select>
            </div>
        </div>
        <button type="submit" class="btn btn-secondary">Guardar</button>
    </form>
    <!--MODAL TELEFONO-->
    <div class="modal fade" id="ModalTelefonos" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar teléfono</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tipoTelefono">Tipo</label>
                                <v-select :options="tipoTelefonos" v-model="tipoTelefono" name="tipoTelefono" id="tipoTelefono" label="tipo"></v-select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" name="numero" id="numero" v-model="numero" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('numero') }" placeholder="Número" v-validate="'required'" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
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
                            <v-select :options="tipoCorreos" v-model="tipoCorreo" name="tipoCorreo" id="tipoCorreo" label="tipo"></v-select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="correo">Correo</label>
                            <input type="email" name="tCorreo" v-model="tCorreo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('correo') }" id="correos" placeholder="Correos" v-validate="'required'" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Agregar</button>
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
                            <v-select :options="tipoRedes" v-model="tipoRed" name="tipoRed" id="tipoRed" label="tipo"></v-select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="tRed" v-model="tRed" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('red') }" id="red" placeholder="Red Social" v-validate="'required'" autocomplete="off">
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
import swal from 'sweetalert2'
export default{
    data(){
        return{
            telefono:null,
            telefonos: [],
            correo:null,
            correos: [],
            red:null,
            redes: [],
            tipoTelefono:null,
            tipoTelefonos: [],
            numero:'',
            tipoCorreo:null,
            tipoCorreos:[],
            tCorreo:'',
            tipoRed:null,
            tipoRedes:[],
            tRed:'',
        }
    },
    mounted: function () {
        this.getdctt();
        this.getdctc();
        this.getdctr();
    },
    methods:{
        getdctt: function(){
            var urlTelefono = 'getDatosPersonaTelefono';
            axios.get(urlTelefono).then(response => {
                this.tipoTelefonos=response.data;
            });
        },
        getdctc: function(){
            var urlCorreo = 'getDatosPersonaCorreo';
            axios.get(urlCorreo).then(response => {
                this.tipoCorreos=response.data;
            });
        },
        getdctr: function(){
            var urlRed = 'getDatosPersonaRed';
            axios.get(urlRed).then(response => {
                this.tipoRedes=response.data;
            });
        }
    },

}
</script>