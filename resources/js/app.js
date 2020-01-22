require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'
import 'vue-select/dist/vue-select.css';


window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};

Vue.use(VModal)

Vue.component('MapCategories', require('./components/MapCategories.vue').default)
Vue.component('SearchInput', require('./components/SearchInput.vue').default)
Vue.component('Carousel', require('./components/Carsouel.vue').default)
Vue.component('Slide', require('./components/Slide.vue').default)
Vue.component('Avatar', require('./components/Avatar.vue').default)
Vue.component('LocationPicker', require('./components/LocationPicker.vue').default)
Vue.component('AddressText', require('./components/AddressText.vue').default)
Vue.component('ImagePicker', require('./components/ImagePicker.vue').default)
Vue.component('StarRating', require('./components/StarRating.vue').default)
Vue.component('ImageCropper', require('./components/ImageCropper.vue').default)
Vue.component('MapView', require('./pages/MapView.vue').default)
Vue.component('CreateEntityView', require('./pages/CreateEntityView.vue').default)
Vue.component('CreateSubEntityView', require('./pages/CreateSubEntityView.vue').default)
Vue.component('EditEntityView', require('./pages/EditEntityView.vue').default)
Vue.component('RegisterView', require('./pages/RegisterView.vue').default)
Vue.component("flash", require("./components/Flash.vue").default);
Vue.component('v-select', require('vue-select').default)


const app = new Vue({
    el: '#app',

})