import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaFisica: '',
        idPersonaMoral:'',
        tabsFisica:'nav-link disabled',
        tabsMoral:'nav-link disabled',
        tabPrincipalFisica:'nav-link active show',
        tabPrincipalMoral:'nav-link active show',
        pillPrincipalFisica:'tab-pane fade show active',
        pillPrincipalMoral:'tab-pane fade show active',
        pillsFisica:'tab-pane fade',
        pillsMoral:'tab-pane fade'
    },
    mutations: {
        asignarIdFisica(state,payload) {
            state.idPersonaFisica=payload
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload
        },
        activeTabsFisica(state){
            state.tabsFisica='nav-link'
            state.tabsMoral='nav-link disabled'
            state.tabPrincipalMoral='nav-link active show'
            state.pillsMoral='tab-pane fade'
            state.pillPrincipalMoral='tab-pane fade show active'
        },
        activeTabsMoral(state){
            state.tabsMoral='nav-link'
            state.tabsFisica='nav-link disabled'
            state.tabPrincipalFisica='nav-link active show'
            state.pillsFisica='tab-pane fade'
            state.pillPrincipalFisica='tab-pane fade show active'
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