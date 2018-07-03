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
        datosDomicilioFisica:'',
        datosTrabajoFisica:'',
        datosNotificacionesFisica:'',
        datosDomicilioMoral:'',
        datosTrabajoMoral:'',
        datosNotificacionesMoral:''
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
            state.carpetasLigadasMoral=''
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
            state.carpetasLigadasFisica=''
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
            (payload=='fisica')?(state.fisicaEncontrada='',state.tipoInvolucrado='',state.carpetasLigadasFisica=''):(state.moralEncontrada='',state.tipoInvolucrado='',state.carpetasLigadasMoral='')
        },
        cleanStore(state){
            idPersonaFisica= '',
            idPersonaMoral='',
            idExtra='',
            tipoInvolucrado='',
            idDomicilio='',
            idTrabajo='',
            idContacto='',
            fisicaEncontrada='',
            moralEncontrada='',
            carpetasLigadasFisica='',
            carpetasLigadasMoral='',
            datosDomicilioFisica='',
            datosTrabajoFisica='',
            datosNotificacionesFisica='',
            datosDomicilioMoral='',
            datosTrabajoMoral='',
            datosNotificacionesMoral=''
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
            if(payload.tipo=='fisica'){
                state.datosDomicilioFisica=payload.domicilios.domicilio
                state.datostrabajoFisica=payload.domicilios.trabajo
                state.datosnotificacionesFisica=payload.domicilios.notificacion
            }
            else if(payload.tipo=='moral'){
                state.datosDomicilioMoral=payload.domicilios.domicilio
                state.datostrabajoMoral=payload.domicilios.trabajo
                state.datosnotificacionesMoral=payload.domicilios.notificacion  
            }   
        }
    }
})

export default store