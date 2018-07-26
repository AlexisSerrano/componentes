<template>
    <div>
        <registrodenunciante v-if="tipo=='denunciante'" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona" :empresa="empresa"></registrodenunciante>
        <registrodenunciado v-if="tipo=='denunciado'" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona" :empresa="empresa"></registrodenunciado>
        <registroautoridad v-if="tipo=='autoridad'" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></registroautoridad>
        <registroabogado v-if="tipo=='abogado'" :sistema="sistema" :carpeta="carpeta" :idcarpeta="idcarpeta" :usuario="usuario" :idvarpersona="idvarpersona"></registroabogado>
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
        props: ['sistema', 'tipo', 'carpeta', 'idcarpeta' ,'usuario', 'idvarpersona', 'empresa'],
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