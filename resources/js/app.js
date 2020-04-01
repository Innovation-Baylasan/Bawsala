require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'

import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg); // config is optional. more below

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};

Vue.use(VModal)

Vue.component('MapCategories', require('./components/MapCategories.vue').default)
Vue.component('SearchInput', require('./components/SearchInput.vue').default)
Vue.component('Carousel', require('./components/Carsouel.vue').default)
Vue.component('Slide', require('./components/Slide.vue').default)
Vue.component('Dropdown', require('./components/Dropdown.vue').default)
Vue.component('LocationPicker', require('./components/LocationPicker.vue').default)
Vue.component('AddressText', require('./components/AddressText.vue').default)
Vue.component('ImagePicker', require('./components/ImagePicker.vue').default)
Vue.component('StarRating', require('./components/StarRating.vue').default)
Vue.component('ImageCropper', require('./components/ImageCropper.vue').default)
Vue.component('MapView', require('./pages/MapView.vue').default)
Vue.component('UserInfoView', require('./pages/UserInfoView.vue').default)
Vue.component('CreateEntityView', require('./pages/CreateEntityView.vue').default)
Vue.component('CreateSubEntityView', require('./pages/CreateSubEntityView.vue').default)
Vue.component('EditSubEntityView', require('./pages/EditSubEntityView.vue').default)
Vue.component('EditEntityView', require('./pages/EditEntityView.vue').default)
Vue.component('CreateEventView', require('./pages/CreateEventView.vue').default)
Vue.component('RegisterView', require('./pages/RegisterView.vue').default)
Vue.component("flash", require("./components/Flash.vue").default);
Vue.component('v-select', require('vue-select').default)
Vue.component('Accordion', require('./components/Accordion.vue').default)

import VueFormWizard from 'vue-form-wizard'

import 'vue-datetime/dist/vue-datetime.css'
import {Datetime} from 'vue-datetime';

Vue.component('datetime', Datetime);

Vue.use(VueFormWizard)

const app = new Vue({
    el: '#app',

})