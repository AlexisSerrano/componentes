<template>
<div class="container mt-3">
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefonos">Telefonos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalTelefonos">+</span></label>
                <v-select multiple :options="telefonos" v-model="telefono" name="telefono" id="telefono" label="valor"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correos">Correos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalCorreos">+</span></label>
                <v-select multiple :options="correos" v-model="correo" name="correo" id="correo" label="valor"></v-select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="redes">Redes Sociales <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalRedes">+</span></label>
                <v-select multiple :options="redes" v-model="red" name="red" id="red" label="valor"></v-select>
            </div>
        </div>
    </form>
    <!--MODAL TELEFONO-->
    <div class="modal fade" id="ModalTelefonos" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <form v-on:submit.prevent="creardct">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar nueva dirección telefónica</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tipoTelefono">Tipo</label>
                                <v-select :options="tipoTelefonos" v-model="tipoTelefono" name="tipoTelefono" id="tipoTelefono" label="tipo" :class="{ 'border border-danger rounded': errors.has('tipoTelefono') }" aria-required="true"></v-select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numero">Número</label>
                                <input type="text" minlength="7" name="numero" id="numero" v-model="numero" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('numero') }" placeholder="Ingrese dirección telefónica" v-validate="'required'" autocomplete="off">
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
                <form v-on:submit.prevent="creardcc">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar nueva dirección de correo electrónico</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tipoCorreo">Tipo</label>
                                <v-select :options="tipoCorreos" v-model="tipoCorreo" name="tipoCorreo" id="tipoCorreo" label="tipo"></v-select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="correo">Correo</label>
                                <input type="email" name="tCorreo" id="tCorreo" v-model="tCorreo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('tCorreo') }" placeholder="Ingrese correo electrónico" v-validate="'required'" autocomplete="off">
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
    <!--MODAL REDES-->
    <div class="modal fade" id="ModalRedes" role="dialog" style="max-width:100%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:100%">
                <form v-on:submit.prevent="creardcr">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar red social</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tipoRedes">Tipo</label>
                                <v-select :options="tipoRedes" v-model="tipoRed" name="tipoRed" id="tipoRed" label="tipo"></v-select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="tRed" id="tRed" v-model="tRed" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('tRed') }" placeholder="Ingrese red social" v-validate="'required'" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
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
        this.getdc();
        this.getdctt();
        this.getdctc();
        this.getdctr();
    },
    methods:{
        getdc: function(){
            var urlDatosContactoTel = 'getDatosContactoTel';
            axios.get(urlDatosContactoTel).then(response => {
                this.telefonos=response.data;
                this.telefono=response.data;
            });
            var urlDatosContactoCor = 'getDatosContactoCor';
            axios.get(urlDatosContactoCor).then(response => {
                this.correos=response.data;
                this.correo=response.data;
            });
            var urlDatosContactoRed = 'getDatosContactoRed';
            axios.get(urlDatosContactoRed).then(response => {
                this.redes=response.data;
                this.red=response.data;
            });
        },
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
        },
        creardct: function(){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:1,
                tipo: this.tipoTelefono.id,
                valor: this.numero,
            }).then(response=>{
                console.log(response.data)
                swal({
                    title: 'Guardado correctamente!',
                    text: 'Número de teléfono agregado exitosamente',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
            }).catch((error)=>{
                console.log(error.response.data.errors);
                swal({
                title: 'Guardado incorrecto!',
                text: 'Número de teléfono imposible de guardar',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
        },
        creardcc: function(){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:1,
                tipo: this.tipoCorreo.id,
                valor: this.tCorreo,
            }).then(response=>{
                console.log(response.data)
                swal({
                    title: 'Guardado correctamente!',
                    text: 'Número de teléfono agregado exitosamente',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
            }).catch((error)=>{
                console.log(error.response.data.errors);
                swal({
                title: 'Guardado incorrecto!',
                text: 'Número de teléfono imposible de guardar',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
        },
        creardcr: function(){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:1,
                tipo: this.tipoRed.id,
                valor: this.tRed,
            }).then(response=>{
                console.log(response.data)
                swal({
                    title: 'Guardado correctamente!',
                    text: 'Número de teléfono agregado exitosamente',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
            }).catch((error)=>{
                console.log(error.response.data.errors);
                swal({
                title: 'Guardado incorrecto!',
                text: 'Número de teléfono imposible de guardar',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
        },
        limpiaCampos() {
                this.nombre='',
                this.fechaConstitucion='',
                this.rfc='',
                this.telefono='',
                this.representanteLegal='',
                this.$validator.reset();
        },
    }
}
</script>