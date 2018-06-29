<template>

    <div class="container-fluid">

        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">


                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="tipo">Tipo</label>    
                    <v-select :options="tipos" label="nombre" v-model="tipo" name="tipo" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('tipo')}" placeholder="Seleccione un tipo"></v-select>
                    <span v-show="errors.has('tipo')" class="text-danger">{{ errors.first('tipo')}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="sector">Sector</label>    
                    <v-select :options="sectores" label="nombre" v-model="sector" name="sector" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('sector')}" placeholder="Seleccione un sector"></v-select>
                    <span v-show="errors.has('sector')" class="text-danger">{{ errors.first('sector')}}</span>
                </div>

                 <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="cedula">Cédula profesional</label>                    
                    <input type="text" name="cedula" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('cedula')}" v-model="cedula" placeholder="Ingrese el cedula" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('cedula')" class="text-danger">{{ errors.first('cedula')}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="correo">Correo</label>                    
                    <input type="text" name="correo" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('correo')}" v-model="correo" placeholder="Ingrese el correo" v-validate="'required|email'" autocomplete="off">
                    <span v-show="errors.has('correo')" class="text-danger">{{ errors.first('correo')}}</span>
                </div>

                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm" for="descripcion">Descripcion de los hechos</label>
                    <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcion')}" v-model="descripcion" placeholder="Ingrese la descripción de los hechos" v-validate="'required'" autocomplete="off"></textarea>
                    <span v-show="errors.has('descripcion')" class="text-danger">{{ errors.first('descripcion')}}</span>
                </div> 
            </div>

                  
            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
             return{
                tipo: '',
                sector: '',
                cedula:'',
                correo:'',
                systemUser:'TEST',
                tipos:['ASESOR JURIDICO', 'ABOGADO DEFENSOR'],
                sectores:['PÚBLICO','PARTICULAR'],
                url:'./api',
                descripcion:''
            }
        },
        props:{
            sistema: {
                default:''
            }
        },
        methods:{            
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                   if (result) {
                        this.guardarExtra();
                        return
                    }
                    swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
            },
            guardarExtra: function(){
                var urlGuardarAbogado = this.url+'/addExtrasAbogado';       
                var data = {
                    idExtrasAbogado:this.$store.state.idExtra,
                    idPersona:this.$store.state.idPersonaFisica,
                    cedula:this.cedula.toUpperCase(),
                    sector:this.sector,
                    correo:this.correo.toUpperCase(),
                    tipo:this.tipo,
                    sistema:this.sistema.toUpperCase(),
                    usuario:this.systemUser,
                    narracion:this.descripcion.toUpperCase()
                };
                    axios.post(urlGuardarAbogado,data)
                    .then (response =>{
                        if(response.data){
                            this.$store.commit('asignarIdExtra',response.data)
                            this.$store.commit('cleanStore')  
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            });
                        }
                        else{
                            swal({
                                title: '¡Guardado incorrecto!',
                                text: 'Error al guardar.',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }).catch((error)=>{    
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Ésta persona no fue posible guardarla.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        })
                    });
                
            },
            CleanFields() {
                this.cedula='',
                this.sector='',
                this.correo='',
                this.tipo='',
                this.descripcion='',
                this.$validator.reset();
            }
       }
    }
</script>
<style>
input{
    text-transform: uppercase
}
</style>