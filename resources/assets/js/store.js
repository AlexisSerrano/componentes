import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaFisica: '',
        idPersonaMoral:'',
    },
    mutations: {
        asignarIdFisica(state,payload) {
            state.idPersonaFisica=payload
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload
        },
        ubicarTabsFisica(state){
            state.tabPrincipalFisica='nav-link'
            state.pillPrincipalFisica='tab-pane fade'
        },
        ubicarTabsMoral(state){
            state.tabPrincipalMoral='nav-link'
            state.pillPrincipalMoral='tab-pane fade'
        }
    }
})

export default store