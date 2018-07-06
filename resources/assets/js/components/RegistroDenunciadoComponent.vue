<template>
    <div>
        <div class="container-fluid">
            <div class="form-row">
                <div class="col-6">
                     <label class="col-form-label col-form-label-sm">Seleccione una opción</label> 
                </div>
                <div v-if="denunciado==3" class="col-6">
                    <label class="col-form-label col-form-label-sm">Tipo de persona</label> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="qrr" style="padding-right: 5px">Q.R.R</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="qrr" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="conocido" style="padding-right: 5px">Conoce al denunciado</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="conocido" value="2">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="comparecencia" style="padding-right: 5px">Por comparecencia</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="comparecencia" value="3">
                        </div>
                    </div>
                </div>
                <div v-if="denunciado==3" class="form-group col-md-6">
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
                <div v-if="denunciado==2" class="form-group col-md-6">
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="conocidoFisica" style="padding-right: 5px">Persona física</label>
                            <input class="form-check-input" type="radio" v-model="conocido" id="conocidoFisica" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="conocidoMoral" style="padding-right: 5px">Persona moral</label>
                            <input class="form-check-input" type="radio" v-model="conocido" id="conocidoMoral" value="2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <personafisica v-if="denunciado==1" :sistema="sistema" :carpeta="carpeta" :tipo="'qrr'"></personafisica>
        <denunciadoconocido v-if="denunciado==2" :sistema="sistema" :carpeta="carpeta" :empresa="(conocido==1)?false:true"></denunciadoconocido>
        <denunciadofisico v-if="persona==1" :sistema="sistema" :carpeta="carpeta"></denunciadofisico>
        <denunciadomoral v-if="persona==2" :sistema="sistema" :carpeta="carpeta"></denunciadomoral>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                persona: '',
                denunciado:'',
                conocido:1
            }
        },
        props: {
            sistema: {
                required:true
            },
            carpeta:{
                required:true
            }
        },
        watch: {
            denunciado() {
                if(this.denunciado==1 || this.denunciado==2){
                    this.persona=''
                }
            },
            persona() {
                this.$store.commit('cleanStore')
            }
        },
    }
</script>

<style scoped>

</style>