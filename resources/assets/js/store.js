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
        carpetasLigadasFisica:'',
        carpetasLigadasMoral:'',
        datosDomicilio:'',
        datosTrabajo:'',
        datosNotificaciones:''
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
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload.idPersona
            if(payload.tipo){
                state.tipoInvolucrado=payload.tipo
            }            
            if(payload.moralEncontrada){
                state.moralEncontrada=payload.moralEncontrada
            }
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
        cleanStore(state){
            state.idPersonaFisica= '',
            state.idPersonaMoral='',
            state.idExtra='',
            state.tipoInvolucrado='',
            state.idDomicilio='',
            state.idTrabajo='',
            state.idContacto='',
            state.fisicaEncontrada='',
            state.moralEncontrada='',
            state.carpetasLigadasFisica='',
            state.carpetasLigadasMoral='',
            state.datosDomicilio='',
            state.datosTrabajo='',
            state.datosNotificaciones=''
        },
        asignarCarpetasLigadas(state,payload){
            if(payload.tipo=='fisica'){
                state.carpetasLigadasFisica=payload.carpetas
            }
            else if(payload.tipo=='moral'){
                state.carpetasLigadasMoral=payload.carpetas
            }
        },
        asignarDomicilios(state,payload){
                state.datosDomicilio=payload.domicilio
                state.datosTrabajo=payload.trabajo
                state.datosNotificaciones=payload.notificacion
        }
    }
})

export default store