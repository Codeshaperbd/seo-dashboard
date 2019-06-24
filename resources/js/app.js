
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Import vue Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.routes = VueRouter;

// Vue progress bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(21, 87, 153)',
  failedColor: 'red',
  height: '4px'
})

// Import vue form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('formbuilder', require('./components/FormBuilder.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * 
 *All vue template assign in varable
 * 
 */
// const routes = [
//   { path: '/formbuilder', component: require('./components/FormBuilder.vue').default },
//   //employee path

// ]

// const router = new VueRouter({
// 	mode: "history",
//   	routes // short for `routes: routes`
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
