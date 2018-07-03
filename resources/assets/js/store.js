import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        idPersonaFisica: '',
        idPersonaMoral:'',
        idExtra:'',
        idDomicilio:'',
        idTrabajo:'',
        idContacto:'',
        fisicaEncontrada:'',
        moralEncontrada:'',
        carpetasLigadas:'',
        datosDomicilio:'',
        datosTrabajo:'',
        datosNotificaciones:'',
        personaFisica:'',
        personaMoral:''
    },
    mutations: {
        asignarIdFisica(state,payload) {
            state.idPersonaFisica=payload.idPersona
            if(payload.fisicaEncontrada){
                state.fisicaEncontrada=payload.fisicaEncontrada
            }
            if(payload.personaFisica){
                state.personaFisica=payload.personaFisica
            }
        },
        asignarIdMoral(state,payload) {
            state.idPersonaMoral=payload.idPersona           
            if(payload.moralEncontrada){
                state.moralEncontrada=payload.moralEncontrada
            }
            if(payload.personaMoral){
                state.personaMoral=payload.personaMoral
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
            state.idDomicilio='',
            state.idTrabajo='',
            state.idContacto='',
            state.fisicaEncontrada='',
            state.moralEncontrada='',
            state.carpetasLigadas='',
            state.datosDomicilio='',
            state.datosTrabajo='',
            state.datosNotificaciones=''
        },
        asignarCarpetasLigadas(state,payload){
            state.carpetasLigadas=payload
        },
        asignarDomicilios(state,payload){
                state.datosDomicilio=payload.domicilio
                if(payload.trabajo){
                    state.datosTrabajo=payload.trabajo
                }
                state.datosNotificaciones=payload.notificacion
        }
    }
})

export default store