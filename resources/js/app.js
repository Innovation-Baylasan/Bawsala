require('./bootstrap');
import Vue from 'vue';

Vue.component('MapCategories', require('./components/MapCategories.vue').default)
Vue.component('Carousel', require('./components/Carsouel.vue').default)
Vue.component('Slide', require('./components/Slide.vue').default)


const app = new Vue({
    el: '#app'
})