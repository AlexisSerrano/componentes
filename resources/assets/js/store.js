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
        personaMoral:'',
        idTemporal:'',
        idDomicilioTemporal:'',
        idTrabajoTemporal:'',
        idContactoTemporal:'',
        personasEncontradas:'',
        showCoincidencias:'',
        edit:'',
        estadosCatalogo:''
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
            if(payload.idTemporal){
                state.idTemporal=payload.idTemporal
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
            if(payload.idTemporal){
                state.idTemporal=payload.idTemporal
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
        cleanStore(state,payload){
            if(payload!='coincidencia'){
                state.personasEncontradas=''
            }
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
            state.datosNotificaciones='',
            state.personaFisica='',
            state.personaMoral='',
            state.idTemporal='',
            state.idDomicilioTemporal='',
            state.idTrabajoTemporal='',
            state.idContactoTemporal='',
            state.showCoincidencias=''
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
        },
        asignarDomiciliosTemporales(state,payload){
            state.idDomicilioTemporal=payload.idDomicilioTemporal
            if(payload.idTrabajoTemporal){
                state.idTrabajoTemporal=payload.idTrabajoTemporal
            }
            state.idContactoTemporal=payload.idContactoTemporal
        },
        asignarPersonasEncontradas(state,payload){
            state.personasEncontradas=payload
        },
        mostrarCoincidencias(state){
            state.showCoincidencias=true
        },
        asignarDataEditFisica(state,payload){
            state.idPersonaFisica = payload.persona.original.idVarPersona
            state.personaFisica = payload.persona.original.idPersona
            state.datosDomicilio = payload.domicilios.original.domicilio
            state.datosTrabajo = payload.domicilios.original.trabajo
            state.datosNotificaciones = payload.domicilios.original.notificacion
            if(payload.persona.original.idDomicilio!=1){
                state.idDomicilio=payload.persona.original.idDomicilio
            }
            if(payload.persona.original.idDomicilioTrabajo!=1){
                state.idTrabajo=payload.persona.original.idDomicilioTrabajo
            }
            if(payload.persona.original.idDomicilioNotificacion!=1){
                state.idContacto=payload.persona.original.idDomicilioNotificacion
            }
            if(payload.persona.original.idExtra){
                state.idExtra = payload.persona.original.idExtra
            }
            state.edit=true
        },
        asignarDataEditMoral(state,payload){
            state.idPersonaMoral = payload.persona.original.idVarPersona
            state.personaMoral = payload.persona.original.idPersona
            state.datosDomicilio = payload.domicilios.original.domicilio
            state.datosTrabajo = payload.domicilios.original.trabajo
            state.datosNotificaciones = payload.domicilios.original.notificacion
            if(payload.persona.original.idDomicilio!=1){
                state.idDomicilio=payload.persona.original.idDomicilio
            }
            if(payload.persona.original.idDomicilioTrabajo!=1){
                state.idTrabajo=payload.persona.original.idDomicilioTrabajo
            }
            if(payload.persona.original.idDomicilioNotificacion!=1){
                state.idContacto=payload.persona.original.idDomicilioNotificacion
            }
            state.edit=true
        },
        asignarEstados(state,payload){
            state.estadosCatalogo=payload
        }
    }
})

export default store