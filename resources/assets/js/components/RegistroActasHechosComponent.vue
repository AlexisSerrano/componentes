<template>
    <div>
        <div class="container-fluid">
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
        <actashechosfisica v-if="persona==1" :sistema="sistema" :usuario="usuario"></actashechosfisica>
        <actashechosmoral v-if="persona==2" :sistema="sistema" :usuario="usuario"></actashechosmoral>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                persona: ''
            }
        },
        props:['sistema','usuario'],
        watch: {
            persona() {
                this.$store.commit('cleanStore')
            }
        },
    }
</script>

<style scoped>

</style>