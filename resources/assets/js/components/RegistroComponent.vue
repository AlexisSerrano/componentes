<template>
    <div>
        <registrodenunciante v-if="tipo=='denunciante'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registrodenunciante>
        <registrodenunciado v-if="tipo=='denunciado'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registrodenunciado>
        <registroautoridad v-if="tipo=='autoridad'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registroautoridad>
        <registroabogado v-if="tipo=='abogado'" :sistema="sistema" :carpeta="carpeta" :usuario="usuario"></registroabogado>
        <registroactashechos v-if="tipo=='actashechos'" :sistema="sistema" :usuario="usuario"></registroactashechos>
        <registroactascircunstanciadas v-if="tipo=='actascircunstanciadas'" :sistema="sistema" :usuario="usuario"></registroactascircunstanciadas>
    
    </div>
</template>

<script>
    import registrodenunciante from './Registros/RegistroDenuncianteComponent.vue';
    import registroabogado from './Registros/RegistroAbogadoComponent.vue';
    import registroautoridad from './Registros/RegistroAutoridadComponent.vue';
    import registrodenunciado from './Registros/RegistroDenunciadoComponent.vue';
    import registroactashechos from './Registros/RegistroActasHechosComponent.vue';
    import registroactascircunstanciadas from './Registros/RegistroActasCircunstanciadas'
     
    export default {
        props: ['sistema', 'tipo', 'carpeta', 'usuario'],
        components: {
            registrodenunciante,
            registroabogado,
            registroautoridad,
            registrodenunciado,
            registroactashechos,
            registroactascircunstanciadas
        }
    }
</script>