<template>
    <div>
        <div class="form-row contenedor">
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
        <personafisica v-if="persona==1" :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciante'"></personafisica>
        <personamoral v-if="persona==2" :sistema="'uat'" :carpeta="'xx'" :tipo="'denunciantemoral'"></personamoral>   
    </div>
</template>

<script>
    export default {
        data(){
             return{
                persona:''
            }
        },
        props:{
            sistema: {
                default:false
            },
            tipo: {
                default:false
            },
            carpeta:{
                default:false
            }
        },
    }
</script>
<style>
.contenedor{
    height: 38px;
}
</style>
