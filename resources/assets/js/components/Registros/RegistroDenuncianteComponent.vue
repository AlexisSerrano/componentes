<template>
    <div class="pb-3 pt-1">
        <div v-if="!idvarpersona" class="container-fluid">
            <label class="col-form-label col-form-label-sm">Tipo de persona</label> 
            <div class="form-row">
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
        </div>
        <denunciantefisico v-if="persona==1 || empresa==false" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></denunciantefisico>
        <denunciantemoral v-if="persona==2 || empresa==true" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></denunciantemoral>
    </div>
</template>

<script>
    import denunciantefisico from '../Denunciante/DenuncianteFisicoComponent.vue';
    import denunciantemoral from '../Denunciante/DenuncianteMoralComponent.vue';
    export default {
        data() {
            return {
                persona: ''
            }
        },
        props: ['sistema','carpeta', 'idcarpeta' ,'usuario', 'idvarpersona','empresa'],
        components:{denunciantefisico,denunciantemoral},
        watch: {
            persona() {
                this.$store.commit('cleanStore')
            }
        },
    }
</script>