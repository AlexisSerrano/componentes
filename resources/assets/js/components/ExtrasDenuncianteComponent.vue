<template>

    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="identidad">Identidad resguardada</label>    
                    <v-select :options="identidades" label="nombre" v-model="identidad" name="identidad" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('identidad')}" placeholder="Seleccione identidad"></v-select>
                    <span v-show="errors.has('identidad')" class="text-danger">{{ errors.first('identidad')}}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm" for="solicitante">Tipo de solicitante</label>    
                    <v-select :options="solicitantes" label="nombre" v-model="solicitante" name="solicitante" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('solicitante')}" placeholder="Seleccione tipo solicitante" ></v-select>
                    <span v-show="errors.has('solicitante')" class="text-danger">{{ errors.first('solicitante')}}</span>
                </div>

                <div class="form-group col-md-12">
                        <label class="col-form-label col-form-label-sm" for="descripcion">Descripcion de los hechos</label>
                        <textarea class="form-control form-control-sm" cols="30" rows="5" name="descripcion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('descripcion')}" v-model="descripcion" placeholder="Ingrese la descripcion de los hechos" v-validate="'required'" autocomplete="off"></textarea>
                        <span v-show="errors.has('descripcion')" class="text-danger">{{ errors.first('descripcion')}}</span>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
             return{                                                
                identidades:[{nombre:'NO',id:0},{nombre:'SI',id:1}],
                identidad:'',                
                solicitantes:[{nombre:'Ofendido',id:0},{nombre:'Víctima',id:1}],
                solicitante:'',
                descripcion:'',  
                systemUser:'TEST',
                //url:'http://localhost/componentes/public/api'   
                url:'/api'             
            }
        },
        props:{            
            empresa: {
                required:true
            },
            sistema: {
                required:true
            }        
        },
        created: function(){
//            this.getPuestos();
        },
        methods:{
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtra()                               
                    }else{
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                    }
        
                });
            },
            guardarExtra: function(){
                var urlGuardarDenunciante = this.url+'/addExtrasDenunciante'
                if(this.empresa==false){
                    var idPersona=this.$store.state.idPersonaFisica
                }
                else{
                    var idPersona=this.$store.state.idPersonaMoral
                }
                var data = {
                    idExtraDenunciante:this.$store.state.idExtra,
                    idPersona:idPersona,                    
                    reguardarIdentidad:this.identidad.id,
                    victima: this.solicitante.id,
                    sistema:this.sistema,
                    empresa:this.empresa,
                    usuario:this.systemUser                                                                       
                };
                axios.post(urlGuardarDenunciante,data)
                .then (response =>{
                    console.log(response.data);
                    if(response.data){        
                        this.$store.commit('asignarIdExtra',response.data)                    
                        swal({
                            title: '¡Guardado correctamente!',
                            text: 'Ésta persona fue guardada exitosamente.',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
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
            cleanFields(){
                this.solicitante=''
                this.descripcion=''
                this.identidad=''
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