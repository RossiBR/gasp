
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var VueResource = require('vue-resource');
window.Vue.use(VueResource);

window.Vue.http.options.root = '';
window.Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';
window.Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('associados', require('./components/Associados.vue'));
Vue.component('cursos', require('./components/Cursos.vue'));
Vue.component('ramos', require('./components/Ramos.vue'));
Vue.component('input-select', require('./components/InputSelect.vue'));
Vue.component('input-select-add', require('./components/InputSelectAdd.vue'));
Vue.component('input-timestamps', require('./components/inputTimestamps.vue'));
Vue.component('input-datetime', require('./components/InputDatetime.vue'));
Vue.component('linhasformacao', require('./components/LinhasFormacao.vue'));


const app = new Vue({
    el: '#app',
    http: {
    	root: '/',
    	headers: {
      		Authorization: 'Basic YXBpOnBhc3N3b3Jk'
    	}
  	}
});
