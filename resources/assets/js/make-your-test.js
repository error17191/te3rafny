/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.bus = new Vue();
Vue.component('spinner',require('./components/Spinner.vue'));
Vue.component('horizontal-or',require('./components/HorizontalOr.vue'));
const app = new Vue({
    el: '#app',
    components: {
        question: require('./components/Question.vue'),
        'question-counter' : require('./components/QuestionsCount.vue'),
        'add-question' : require('./components/AddQuestionScreen.vue')
    },
});

setTimeout(function () {
    $('[data-toggle="tooltip"]').tooltip();
},1000);
axios.get('/make-your-test/init').then(response => {
    window.appData = response.data;
    bus.$emit('init-data-ready');
});
