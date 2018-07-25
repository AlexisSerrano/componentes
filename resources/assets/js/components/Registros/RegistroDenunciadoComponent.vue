<template>
    <div class="pb-3 pt-1">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col-7">
                     <label class="col-form-label col-form-label-sm">Seleccione una opción</label> 
                </div>
                <div class="col-5">
                    <label  v-if="denunciado==3" class="col-form-label col-form-label-sm">Tipo de persona</label> 
                    <label  v-if="denunciado==2" class="col-form-label col-form-label-sm">Tipo de conocido</label> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label col-form-label col-form-label-sm" for="qrr" style="padding-right: 5px">Q.R.R.</label>
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
                <div v-if="denunciado==3" class="form-group col-md-5">
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
                <div v-if="denunciado==2" class="form-group col-md-5">
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
        <personafisica v-if="denunciado==1" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :tipo="'qrr'" :usuario="usuario" :idvarpersona="idvarpersona"></personafisica>
        <conocidofisico v-if="denunciado==2 && conocido==1" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></conocidofisico>
        <conocidomoral v-if="denunciado==2  && conocido==2" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></conocidomoral>
        <denunciadofisico v-if="persona==1" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></denunciadofisico>
        <denunciadomoral v-if="persona==2" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></denunciadomoral>
    </div>
</template>

<script>
    import denunciadofisico from '../Denunciado/DenunciadoFisicoComponent.vue';
    import denunciadomoral from '../Denunciado/DenunciadoMoralComponent.vue';
    import conocidofisico from '../Denunciado/ConocidoFisicoComponent.vue';
    import conocidomoral from '../Denunciado/ConocidoMoralComponent.vue';
    export default {
        data() {
            return {
                persona: '',
                denunciado:'',
                conocido:1
            }
        },
        props: ['sistema','carpeta', 'idcarpeta' ,'usuario', 'idvarpersona'],
        components:{denunciadofisico,denunciadomoral,conocidofisico,conocidomoral},
        watch: {
            denunciado() {
                this.$store.commit('cleanStore')
                this.persona=''
                this.conocido=''
            },
            persona() {
                this.$store.commit('cleanStore')
            },
            conocido(){
                this.$store.commit('cleanStore')
            }
        },
    }
</script>