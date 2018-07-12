<template>
    <div>
        <registrodenunciante v-if="tipo=='denunciante'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registrodenunciante>
        <registrodenunciado v-if="tipo=='denunciado'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registrodenunciado>
        <registroautoridad v-if="tipo=='autoridad'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registroautoridad>
        <registroabogado v-if="tipo=='abogado'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registroabogado>
        <registroactashechos v-if="tipo=='actashechos'" :sistema="sistema" :usuario="usuario"></registroactashechos>
    
    </div>
</template>

<script>
    import registrodenunciante from './RegistroDenuncianteComponent.vue';
    import registroabogado from './RegistroAbogadoComponent.vue';
    import registroautoridad from './RegistroAutoridadComponent.vue';
    import registrodenunciado from './RegistroDenunciadoComponent.vue';
    import registroactashechos from './RegistroActasHechosComponent.vue';
    
    export default {
        props: ['sistema', 'tipo', 'carpeta', 'usuario'],
        components: {
            registrodenunciante,
            registroabogado,
            registroautoridad,
            registrodenunciado,
            registroactashechos
        }
    }
</script>