require('./bootstrap');
import Vue from 'vue';

Vue.component('MapCategories', require('./components/MapCategories.vue').default)


const app = new Vue({
    el: '#app'
})