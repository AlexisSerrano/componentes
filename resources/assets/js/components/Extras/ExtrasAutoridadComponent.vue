<template>

    <div class="container-fluid">
        <form v-on:submit.prevent="validateBeforeSubmit">

            <div class="form-row">
                    
                
                <div class="form-group col-md-4">
                    <label class="col-form-label col-form-label-sm" for="antiguedad">Antigüedad (Años)</label>
                    <input type="number" min="0" name="antiguedad" step="1" :class="{'form-control form-control-sm':true, 'border border-danger': errors.has('antiguedad')}" v-model="antiguedad" placeholder="Ingrese la antigüedad" v-validate="'required'" autocomplete="off">
                    <span v-show="errors.has('antiguedad')" class="text-danger">{{ errors.first('antiguedad')}}</span>
                </div>

                <div class="form-group col-md-4">
                        <label class="col-form-label col-form-label-sm" for="rango">Rango</label>    
                        <v-select :options="rangos" label="rango" v-model="rango" name="rango" v-validate="'required'" :class="{ 'border border-danger rounded': errors.has('rango')}" placeholder="Seleccione un rango"></v-select>
                        <span v-show="errors.has('rango')" class="text-danger">{{ errors.first('rango')}}</span>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label class="col-form-label col-form-label-sm" for="horarioLaboral">Horario laboral</label>    
                        <input type="text" data-vv-name="horario laboral" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('horario laboral')}" v-model="horarioLaboral" placeholder="Ingrese el horario laboral" v-validate="'required'" autocomplete="off">
                        <span v-show="errors.has('horario laboral')" class="text-danger">{{ errors.first('horario laboral')}}</span>
                    </div>

                    <div v-if="sistema=='uat'" class="form-group col-md-12">
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
                antiguedad:'',                                             
                rangos:['CABO','COMANDANTE'],
                rango:'',
                horarioLaboral:'',                                
                descripcion:'',
                systemUser:'TEST',
                url:'./api',
            }
        },
        props:{
            sistema: {
                required:true
            },
            carpeta:{
                required:true
            }
        },
        methods:{
            validateBeforeSubmit(){
               this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.guardarExtraAutoridad();    
                        return
                    }
                    else{
                        swal({
                        title: '¡Guardado incorrecto!',
                        text: 'Error al guardar.',
                        type: 'error',
                        confirmButtonText: 'Ok'
                        });
                    }
                    
                });
            },
            guardarExtraAutoridad: function(){   
                var urlGuardarAutoridad = this.url+'/addExtrasAutoridad';          
                var data = {
                    idExtrasAutoridad:this.$store.state.idExtra,
                    idPersona:this.$store.state.idPersonaFisica,
                    antiguedad:this.antiguedad,
                    rango:this.rango,
                    horarioLaboral: this.horarioLaboral.toUpperCase(),
                    sistema:this.sistema,
                    usuario:this.systemUser,
                    narracion:this.descripcion.toUpperCase(),
                    idCarpeta:this.carpeta,
                    empresa:false,
                    tipo:'autoridad'
                    };
                    axios.post(urlGuardarAutoridad,data)
                    .then (response =>{
                        if(response.data){
                            this.$store.commit('asignarIdExtra',response.data)
                            //this.$store.commit('cleanStore')                                         
                            swal({
                                title: '¡Guardado correctamente!',
                                text: 'Ésta persona fue guardada exitosamente.',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                        }
                        else{
                            swal({
                                title: 'Guardado Incorrecto!',
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
                this.antiguedad=''
                this.rango=''
                this.horarioLaboral=''
                this.descripcion=''
                this.$validator.reset()
            }
       }
    }
</script>