import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaVuex: ''
    },
    mutations: {
        asignarIdPersona(state,payload) {
            state.idPersonaVuex=payload
        }
    }
})

export default store