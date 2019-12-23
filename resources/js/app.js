require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'

Vue.use(VModal)

Vue.component('MapCategories', require('./components/MapCategories.vue').default)
Vue.component('Carousel', require('./components/Carsouel.vue').default)
Vue.component('Slide', require('./components/Slide.vue').default)
Vue.component('Avatar', require('./components/Avatar.vue').default)


const app = new Vue({
    el: '#app'
})