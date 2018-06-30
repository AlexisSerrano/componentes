import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaFisica: '',
        idPersonaMoral:'',
        idExtra:'',
        tipoInvolucrado:'',
        idDomicilio:'',
        idTrabajo:'',
        idContacto:'',
        fisicaEncontrada:'',
        moralEncontrada:'',
        carpetasLigadas:''
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
            state.moralEncontrada=''
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
            state.fisicaEncontrada=''
            state.idDomicilio=''
            state.idTrabajo=''
            state.idContacto=''
        },
        asignarIdExtra(state,payload) {
            state.idExtra=payload
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
        },
        cleanSearch(state,payload){
            (payload=='fisica')?(state.fisicaEncontrada='',state.tipoInvolucrado=''):(state.moralEncontrada='',state.tipoInvolucrado='')
        },
        cleanStore(state){
            state.idPersonaFisica= '',
            state.idPersonaMoral='',
            state.idExtra='',
            state.tipoInvolucrado='',
            state.idDomicilio='',
            state.idTrabajo='',
            state.idContacto='',
            state.fisicaEncontrada='',
            state.moralEncontrada=''
        },
        asignarCarpetasLigadas(state,payload){
            state.carpetasLigadas=payload
        }
    }
})

export default store