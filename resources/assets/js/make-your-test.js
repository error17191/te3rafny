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
        question: require('./components/make-your-test/Question.vue'),
        'question-counter' : require('./components/make-your-test/QuestionsCount.vue'),
        'add-question' : require('./components/make-your-test/AddQuestionScreen.vue')
    },
});

setTimeout(function () {
    $('[data-toggle="tooltip"]').tooltip();
},1000);
axios.get('/make-your-test/init').then(response => {
    window.appData = response.data;
    bus.$emit('init-data-ready');
});
