import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaFisica: '',
        idPersonaMoral:'',
        tipoInvolucrado:'',
        idDomicilio:'',
        idTrabajo:'',
        idContacto:'',
        personaFisicaExiste:'',
        personaMoralExiste:''
    },
    mutations: {
        asignarIdFisica(state,payload) {
            state.idPersonaFisica=payload.idPersona
            if(payload.tipo){
                state.tipoInvolucrado=payload.tipo
            }
            state.idPersonaMoral=''
            state.personaFisicaExiste=true
            state.personaMoralExiste=false
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload.idPersona
            if(payload.tipo){
                state.tipoInvolucrado=payload.tipo
            }            
            state.idPersonaFisica=''
            state.personaMoralExiste=true
            state.personaFisicaExiste=false
        },
        ubicarTabsFisica(state){
            state.tabPrincipalFisica='nav-link'
            state.pillPrincipalFisica='tab-pane fade'
        },
        ubicarTabsMoral(state){
            state.tabPrincipalMoral='nav-link'
            state.pillPrincipalMoral='tab-pane fade'
        },
        asignarIdDomicilio(state,payload){
            if(payload.tipo=='domicilio'){
                state.idDomicilio=payload.idDomicilio
            }
            else if(payload.tipo=='trabajo'){
                state.idTrabajo==payload.idDomicilio
            }
            else if(payload.tipo=='contacto'){
                state.idContacto==payload.idDomicilio
            }
        },
    }
})

export default store