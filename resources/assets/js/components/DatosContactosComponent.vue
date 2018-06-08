<template>
<div class="container mt-3">
    <form>
        <div class="form-row">
            <div class="form-group">
                <label for="telefonos">Teléfonos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalTelefonos">+</span></label>
                <div class="row">
                    <div v-for="t in telefonos" :key="t.id" class="col-sm" style="margin-bottom:5px; margin-right:-10px">
                        <span  class="btn-group " >
                            <span class="btn btn-secondary btn-sm">{{t.valor }}</span>
                            <span class="btn btn-danger btn-sm" v-on:click="delatet(t)"> x</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="correos">Correos <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalCorreos">+</span></label>
                <div class="row">
                    <div v-for="t in correos" :key="t.id" class="col-sm" style="margin-bottom:5px; margin-right:-10px">
                        <span  class="btn-group" >
                            <span class="btn btn-secondary btn-sm">{{t.valor }}</span>
                            <span class="btn btn-danger btn-sm" v-on:click="delatet(t)"> x</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="redes">Redes Sociales <span type="button" class="badge badge-secondary" style="cursor:pointer" data-toggle="modal" data-target="#ModalRedes">+</span></label>
                <div class="row">
                    <div v-for="t in redes" :key="t.id" class="col-sm" style="margin-bottom:5px; margin-right:-10px">
                        <span  class="btn-group" >
                            <span class="btn btn-secondary btn-sm">{{t.valor }}</span>
                            <span class="btn btn-danger btn-sm" v-on:click="delatet(t)"> x</span>
                        </span>
                    </div>
                </div>
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
                            <div class="form-group col-md-5">
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
                            <div class="form-group col-md-5">
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
                            <div class="form-group col-md-5">
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
            idPersona:3
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
            var urlDatosContactoTel = 'getDatosContactoTel/'+this.idPersona;
            axios.get(urlDatosContactoTel).then(response => {
                this.telefonos=response.data;
            });
            var urlDatosContactoCor = 'getDatosContactoCor/'+this.idPersona;
            axios.get(urlDatosContactoCor).then(response => {
                this.correos=response.data;
            });
            var urlDatosContactoRed = 'getDatosContactoRed/'+this.idPersona;
            axios.get(urlDatosContactoRed).then(response => {
                this.redes=response.data;
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
            let pass=true;
            for(let tel of this.telefonos){
                console.log(tel.valor,this.numero)
                if(tel.valor==this.numero){
                    pass=false;
                    break;
                }
            }
            if(pass){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:this.idPersona,
                tipo: this.tipoTelefono.id,
                valor: this.numero,
            }).then(response=>{
                this.telefonos.push({id:response.data,valor:this.numero});                             
                this.limpiaCampos()
                $('#ModalTelefonos').modal('hide');
                swal({
                    title: '¡Guardado correctamente!',
                    text: 'Dirección telefónica agregada exitosamente.',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
            }).catch((error)=>{                
                swal({
                title: '¡Guardado incorrecto!',
                text: 'La dirección telefónica es imposible de guardar.',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
            }else{
                swal({
                title: 'Guardado incorrecto!',
                text: 'telefono ya existe',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            }
        },
        creardcc: function(){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:this.idPersona,
                tipo: this.tipoCorreo.id,
                valor: this.tCorreo,
            }).then(response=>{
                this.correos.push({id:response.data,valor:this.tCorreo});                             
                this.limpiaCampos();
                $('#ModalCorreos').modal('hide');
                swal({
                    title: '¡Guardado correctamente!',
                    text: 'Correo electrónico agregado exitosamente.',
                    type: 'success',
                    confirmButtonText: 'Ok'
                })
                
            }).catch((error)=>{
                console.log(error.data);
                swal({
                title: '¡Guardado incorrecto!',
                text: 'El correo electrónico es imposible de agregar.',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
        },
        creardcr: function(){
            var urlCrear = '/api/adddc';
            axios.post(urlCrear,{
                idPersona:this.idPersona,
                tipo: this.tipoRed.id,
                valor: this.tRed,
            }).then(response=>{
                this.correos.push({"id":response.data,"valor":this.tRed}); 
                this.limpiaCampos();
                $('#ModalRedes').modal('hide');
                swal({
                    title: '¡Guardado correctamente!',
                    text: 'Red social agregado exitosamente.',
                    type: 'success',
                    confirmButtonText: 'Ok'
                });
            }).catch((error)=>{
                console.log(error.response.data.errors);
                swal({
                title: '¡Guardado incorrecto!',
                text: 'La red social es imposible de agregar.',
                type: 'error',
                confirmButtonText: 'Ok'
                })
            });
        },
        delatet:function(t){
            let del=false;
            axios.post('api/deldc',{id:t.id})
            .then((resopnce)=>{
                console.log(resopnce);
                del=true;
            })
            .finally(()=>{
                    if(del){
                        let tn=this.telefonos.indexOf(t);
                        if(tn>-1){
                            this.telefonos.splice(tn,1);
                        }
                    }
            });           
        },
        limpiaCampos() {
            this.data,
            this.getdc(),
            this.tipoTelefono=null,
            this.tipoTelefonos=[],
            this.getdctt(),
            this.tipoCorreo=null,
            this.tipoCorreos=[],
            this.getdctc(),
            this.tipoRed=null,
            this.tipoRedes=[],
            this.getdctr(),
            this.numero='',
            this.tCorreo='',
            this.tRed='',
            this.$validator.reset()
        }
    }
}
</script>