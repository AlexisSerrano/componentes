<template>
    <div class="container mt-3">
        <form v-on:submit.prevent="validateBeforeSubmit">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="lugarTrabajo">Lugar de trabajo</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('lugar de trabajo') || lugarTrabajoV}" id="lugarTrabajo" data-vv-name="lugar de trabajo" name="lugarTrabajo" v-validate="'required'" v-model="lugarTrabajo" placeholder="Ingrese el lugar de trabajo" autocomplete="off">
                    <span v-if="errors.has('lugar de trabajo') || lugarTrabajoV" class="text-danger">{{ errors.first('lugar de trabajo') || lugarTrabajoV[0]}}</span>
                </div>

                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input type="text" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('teléfono') || telefonoV}" id="telefono" name="telefono" v-validate="'required|numeric'" v-model="telefono" placeholder="Ingrese el teléfono"  autocomplete="off" data-vv-name="teléfono">
                    <span v-if="errors.has('teléfono') || telefonoV" class="text-danger">{{ errors.first('teléfono') || telefonoV[0]}}</span>
                </div>
            </div>

            <!-- <h1>{{(estado!=null)?estado.id:estado}}</h1> -->
            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
            return{
                telefono:'',
                lugarTrabajo:'',
                telefonoTrabajo:'',
            }
        },
        mounted: function () {
            this.getEstados()
        },
        methods:{
            CleanFields() {
                this.telefono='',
                this.telefonoTrabajo='',
                this.lugarTrabajo=''
                this.$validator.reset();
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearDatosLaborales();
                        this.CleanFields();
                        return;
                    }
                    swal({
                        title: '¡Guardado Incorrecto!',
                        text: 'Éste domicilio no fue posible guardarse.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            crearDatosLaborales: function(){
                var urlDomicilio = 'addDatosLaborales';
                axios.post(urlDomicilio,{
                    estado: this.estado.id,
                    municipio: this.municipio.id,
                    localidad: this.localidad.id,
                    colonia: this.colonia.id,
                    codigo_postal: this.codigo_postal.id,
                    calle: this.calle.toUpperCase(),
                    numExterno: this.numExterno.toUpperCase(),
                    numInterno: this.numInterno.toUpperCase(),
                    telefono:this.telefono,
                    telefonoTrabajo:this.telefonoTrabajo,
                    lugarTrabajo:this.lugarTrabajo
                }).then((response)=>{
                    console.log(response.data)
                    swal({
                        title: '¡Guardado Correctamente!',
                        text: 'Éste domicilio fue guardado exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.municipioV = error.response.data.errors.municipio,
                        this.localidadV = error.response.data.errors.localidad,
                        this.coloniaV = error.response.data.errors.colonia,
                        this.calleV = error.response.data.errors.calle,
                        this.numExternoV = error.response.data.errors.numExterno
                        this.telefonoV = error.response.data.errors.telefono
                        this.telefonoTrabajoV = error.response.data.errors.telefonoTrabajo
                        this.lugarTrabajoV = error.response.data.errors.lugarTrabajo
                        swal({
                            title: '¡Guardado Incorrecto!',
                            text: 'Éste domicilio no fue posible guardarse.',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        })
                    })
                })
            }
       }
    }
</script>
<style>
.select{
    font-family: inherit
}
.form-control:focus {
  color: #6d6d6d;
  background-color: #fff;
  border-color: #828282;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(66, 66, 66, 0.25);
}
button{
    background-color: #424242;
    border-color: #424242;
    color: white;
}
input{
    text-transform: uppercase
}
::placeholder{
    text-transform: none
}
</style>