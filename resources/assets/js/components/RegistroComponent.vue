<template>
    <div>
        <registrodenunciante v-if="tipo=='denunciante'" :sistema="sistema" :carpeta="carpeta" ></registrodenunciante>
        <registrodenunciado v-if="tipo=='denunciado'" :sistema="sistema" :carpeta="carpeta"></registrodenunciado>
        <registroautoridad v-if="tipo=='autoridad'" :sistema="sistema" :carpeta="carpeta"></registroautoridad>
        <registroabogado v-if="tipo=='abogado'" :sistema="sistema" :carpeta="carpeta"></registroabogado>
        <registroactashechos v-if="tipo=='actashechos'" :sistema="sistema" :usuario="usuario"></registroactashechos>

    </div>
</template>

<script>
    export default {
         props: ['sistema','tipo','carpeta','usuario']
    }
</script>