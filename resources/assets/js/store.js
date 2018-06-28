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
        fisicaEncontrada:'',
        moralEncontrada:''
    },
    mutations: {
        asignarIdFisica(state,payload) {
            state.idPersonaFisica=payload.idPersona
            if(payload.tipo){
                state.tipoInvolucrado=payload.tipo
            }
            if(payload.fisicaEncontrada){
                state.fisicaEncontrada=payload.fisicaEncontrada
            }
            state.idPersonaMoral=''
            state.idDomicilio=''
            state.idTrabajo=''
            state.idContacto=''
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload.idPersona
            if(payload.tipo){
                state.tipoInvolucrado=payload.tipo
            }            
            if(payload.moralEncontrada){
                state.moralEncontrada=payload.moralEncontrada
            }
            state.idPersonaFisica=''
            state.idDomicilio=''
            state.idTrabajo=''
            state.idContacto=''
        },
        asignarIdDomicilio(state,payload){
            if(payload.tipo=='domicilio'){
                state.idDomicilio=payload.idDomicilio
            }
            else if(payload.tipo=='trabajo'){
                state.idTrabajo=payload.idDomicilio
            }
            else if(payload.tipo=='contacto'){
                state.idContacto=payload.idDomicilio
            }
        }
    }
})

export default store