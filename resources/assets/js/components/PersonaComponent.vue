<template>
    <div>
        <div class="container mt-3">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="personaFisica" style="padding-right: 5px">Persona física</label>
                            <input class="form-check-input" type="radio" v-model="persona" id="personaFisica" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="personaMoral" style="padding-right: 5px">Persona moral</label>
                            <input class="form-check-input" type="radio" v-model="persona" id="personaMoral" value="2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <personafisica v-if="persona==1" :sistema="sistema" :tipo="tipo"></personafisica>
        <personamoral v-if="persona==2" :sistema="sistema"></personamoral>
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
            }
        },
    }
</script>