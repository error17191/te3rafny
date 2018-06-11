/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.bus = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        question: require('./components/Question.vue'),
        'question-counter' : require('./components/QuestionsCount.vue')
    }

});
