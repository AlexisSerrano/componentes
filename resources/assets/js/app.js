
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// require('./bootstrap');
require('es6-promise').polyfill();
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

/*Awesome*/
import Icon from 'vue-awesome/components/Icon'
import 'vue-awesome/icons'
Vue.component('icon', Icon)
/*Awesome*/

/*toastr*/
import Toastr from 'vue-toastr';
require('vue-toastr/src/vue-toastr.scss');
Vue.component('vue-toastr',Toastr);
/*toastr*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('personafisica', require('./components/Personas/PersonaFisicaComponent.vue'));
Vue.component('personamoral', require('./components/Personas/PersonaMoralComponent.vue'));
Vue.component('domicilio', require('./components/Domicilio/DomicilioComponent.vue'));
Vue.component('registro',require('./components/RegistroComponent.vue'));
Vue.component('notificaciones',require('./components/Tablas/NotificacionesComponent.vue'));
Vue.component('coincidencias',require('./components/Tablas/CoincidenciasComponent.vue'));

const app = new Vue({
    el: '#app',
    store
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })