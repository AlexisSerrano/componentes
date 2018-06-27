
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
require('./curp');
window.Vue = require('vue');

/*Vue-Select*/
import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
/*Vue-Select*/


/*Vee-Validate*/
import es from 'vee-validate/dist/locale/es';
import VeeValidate, { Validator } from 'vee-validate';
Validator.localize('es', es);
Vue.use(VeeValidate);
/*Vee-Validate*/

/*Vuex*/
import store from './store';
/*Vuex*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('personafisica', require('./components/PersonaFisicaComponent.vue'));
Vue.component('personamoral', require('./components/PersonaMoralComponent.vue'));
Vue.component('persona', require('./components/personaComponent.vue'));
Vue.component('domicilio', require('./components/DomicilioComponent.vue'));
Vue.component('registrodenunciante',require('./components/RegistroDenuncianteComponent.vue'));
Vue.component('registroabogado',require('./components/RegistroAbogadoComponent.vue'));
Vue.component('registroautoridad',require('./components/RegistroAutoridadComponent.vue'));
Vue.component('registrodenunciado',require('./components/RegistroDenunciadoComponent.vue'));
Vue.component('denunciantefisico',require('./components/DenuncianteFisicoComponent.vue'));
Vue.component('denunciantemoral',require('./components/DenuncianteMoralComponent.vue'));
Vue.component('denunciadofisico',require('./components/DenunciadoFisicoComponent.vue'));
Vue.component('denunciadomoral',require('./components/DenunciadoMoralComponent.vue'));
Vue.component('denunciadoconocido',require('./components/DenunciadoConocidoComponent.vue'));
Vue.component('extrasinvestigado',require('./components/ExtrasInvestigadoComponent.vue'));
Vue.component('extrasabogado',require('./components/ExtrasAbogadoComponent.vue'));
Vue.component('extrasdenunciante',require('./components/ExtrasDenuncianteComponent.vue'));
Vue.component('extrasautoridad',require('./components/ExtrasAutoridadComponent.vue'));
Vue.component('registro',require('./components/RegistroComponent.vue'));
Vue.component('carpetas',require('./components/carpetasLigadasComponent.vue'));

const app = new Vue({
    el: '#app',
    store
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })