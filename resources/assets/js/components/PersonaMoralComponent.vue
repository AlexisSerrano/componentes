<template>
    <div class="container mt-3">

        <form v-on:submit.prevent="validateBeforeSubmit">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombre') || nombreV}" id="nombre" v-model="nombre" placeholder="Ingrese el nombre" v-validate="'required'" autocomplete="off" @blur="searchPersona">
                    <span v-if="errors.has('nombre') || nombreV" class="text-danger">{{ errors.first('nombre') || nombreV[0] }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="fechaConstitucion">Fecha de constitución</label>
                    <input type="date" class="form-control" id="fechaConstitucion" v-model="fechaConstitucion" name="fechaConstitucion" data-vv-name="Fecha de Constitucion"  v-validate="'required'" :class="{ 'border border-danger': errors.has('Fecha de Constitucion') || fechaConstitucionV}" @blur="searchPersona">
                    <span v-show="errors.has('Fecha de Constitucion') || fechaConstitucionV" class="text-danger">{{ errors.first('Fecha de Constitucion') || fechaConstitucionV }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">R.F.C</label>
                    <input type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') || rfcV}" id="rfc" v-model="rfc" placeholder="Ingrese el rfc" v-validate="'required|size:12'" autocomplete="off">
                    <span v-if="errors.has('rfc') || rfcV" class="text-danger">{{ errors.first('rfc') || rfcV[0] }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('telefono') || telefonoV }" id="telefono" v-model="telefono" placeholder="Ingrese el telefono" v-validate="'required|numeric'" autocomplete="off">
                    <span v-if="errors.has('telefono') || telefonoV" class="text-danger">{{ errors.first('telefono') || telefonoV[0] }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="representanteLegal">Representante legal</label>
                    <input type="text" name="representanteLegal" data-vv-name="Representante Legal" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Representante Legal') || representanteLegalV }" id="representanteLegal" v-model="representanteLegal" placeholder="Ingrese el representante legal" v-validate="'required'" autocomplete="off">
                    <span v-if="errors.has('Representante Legal') || representanteLegalV" class="text-danger">{{ errors.first('Representante Legal') || representanteLegalV[0] }}</span>
                </div>
            </div>
            <div>
                <input type="hidden" v-model="idVarPersonaMoral" id="idvarpermoral">             
            </div>
            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <button type="submit" class="btn mr-1">Guardar</button>
                </div>
            </div>
            <!-- <h1>{{personaExiste}}</h1> -->
        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
             return{
                nombre: '',
                fechaConstitucion: '',
                rfc:'',
                telefono:'',
                representanteLegal:'',
                personaExiste:'',
                nombreV:'',
                fechaConstitucionV:'',
                rfcV:'',
                telefonoV:'',
                representanteLegalV:'',                
                idPersonaMoral:'',
                idVarPersonaMoral:''
            }
        },
        props:{
            sistema: {
                default:false
            }
        },
        mounted: function(){
        //    this.getNacionalidades();
        },
        methods:{
            searchPersona: function(){
                if(this.nombre!='' && this.fechaConstitucion!=''){
                    var urlRfcMoral = '/rfcMoral';
                    axios.post(urlRfcMoral,{
                        nombre: this.nombre,
                        fechaConstitucion: this.fechaConstitucion
                    }).then(response =>{
                        this.rfc = response.data.res
                        var urlBuscarPersona = '/searchPersonaMoral';
                        axios.post(urlBuscarPersona,{
                            rfc: this.rfc
                        }).then(response => {
                            this.personaExiste=response.data
                            if(this.personaExiste!=''){                                
                                swal({
                                    title: 'Persona moral encontrada!',
                                    text: 'Ésta persona moral ya fue registrada anteriormente',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                this.telefono = this.personaExiste.telefono
                                this.representanteLegal = this.personaExiste.representanteLegal
                                this.idPersonaMoral=this.personaExiste.ids.idEmpresa
                                this.idVarPersonaMoral=this.personaExiste.ids.idVariablesPersona
                            }
                        })
                    });
                }
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.CrearEmpresa();
                        this.CleanFields();
                        return;
                    } 
                    swal({
                        title: 'Guardado incorrecto!',
                        text: 'Ésta empresa no fue posible guardarla',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            CleanFields() {
                this.nombre='',
                this.fechaConstitucion='',
                this.rfc='',
                this.telefono='',
                this.representanteLegal='',
                this.$validator.reset();
            },
            CrearEmpresa: function(){
                var urlCrearMoral = '/addPersonaMoral';
                    axios.post(urlCrearMoral,{                        
                        nombre: this.nombre.toUpperCase(),
                        fechaConstitucion: this.fechaConstitucion,
                        rfc:this.rfc.toUpperCase(),
                        telefono: this.telefono,
                        representanteLegal: this.representanteLegal.toUpperCase(),
                        sistema: this.sistema,
                        idpersonamoral: this.idPersonaMoral,
                        idvarpersonamoral:this.idVarPersonaMoral
                    })
                    .then (response =>{
                        this.idVarPersonaMoral=response.data.idpersona                                                
                        swal({
                            title: 'Guardado correctamente!',
                            text: 'Ésta empresa fue guardada exitosamente',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                    }).catch((error)=>{
                        console.log(error.response.data.errors);
                        this.nombreV = error.response.data.errors.nombre,
                        this.fechaConstitucionV = error.response.data.errors.fechaConstitucion,
                        this.rfcV = error.response.data.errors.rfc,
                        this.telefonoV = error.response.data.errors.telefono,
                        this.representanteLegalV = error.response.data.errors.representanteLegal
                        swal({
                        title: 'Guardado incorrecto!',
                        text: 'Ésta persona moral no fue posible guardarla',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        })
                    });
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
h5{
    color: #138c13;
}
.icons{
    height: 1rem;
    margin-bottom: 3px;
}
input{
    text-transform: uppercase
}
::placeholder{
    text-transform: none
}
</style>