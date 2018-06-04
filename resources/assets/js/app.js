
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('personafisica', require('./components/PersonaFisicaComponent.vue'));
Vue.component('personamoral', require('./components/PersonaMoralComponent.vue'));
Vue.component('persona', require('./components/personaComponent.vue'));
Vue.component('domicilio', require('./components/DomicilioComponent.vue'));
Vue.component('datoscontactos',require('./components/DatosContactosComponent.vue'));
Vue.component('datoslaborales',require('./components/DatosLaboralesComponent.vue'));
const app = new Vue({
    el: '#app'
});
