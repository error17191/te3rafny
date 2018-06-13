/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.bus = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        dashboard: require('./components/dashboard/Dashboard.vue')
    },
});

setTimeout(function () {
    $('[data-toggle="tooltip"]').tooltip();
},1000);

axios.get('/dashboard/init').then(response => {
    window.appData = response.data;
    bus.$emit('init-data-ready');
});
