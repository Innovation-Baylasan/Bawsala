require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'

Vue.use(VModal)

Vue.component('MapCategories', require('./components/MapCategories.vue').default)
Vue.component('SearchInput', require('./components/SearchInput.vue').default)
Vue.component('Carousel', require('./components/Carsouel.vue').default)
Vue.component('Slide', require('./components/Slide.vue').default)
Vue.component('Avatar', require('./components/Avatar.vue').default)
Vue.component('LocationPicker', require('./components/LocationPicker.vue').default)
Vue.component('AddressText', require('./components/AddressText.vue').default)
Vue.component('MapView', require('./pages/MapView.vue').default)
Vue.component('CreateEntityView', require('./pages/CreateEntityView.vue').default)


const app = new Vue({
    el: '#app',

})