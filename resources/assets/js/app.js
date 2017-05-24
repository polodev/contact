
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('create-contact', require('./components/createContact.vue'));
Vue.component('edit-contact', require('./components/editContact.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));
import Form from './Form.js'

const app = new Vue({
    el: '#app',
    data: {},
    methods: {
      onSubmit() {
        this.form.post('/projects')
           .then(response => alert('Wahoo!'));
      }
    }
});
