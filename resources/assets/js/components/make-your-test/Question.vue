<template>
    <transition name="fade">
        <div v-if="question && ! answeredAll && ! reachedLimit">
            <div class="card question-select">
                <div class="card-header">{{question.content}}</div>

                <div class="card-body">
                    <ul class="choices list-group">
                        <li @click="selectedChoice = choice.id"
                            v-for="choice in choices"
                            :class="{'list-group choice':true,active: selectedChoice == choice.id}"
                            class="list-group-item">{{choice.content}}</li>
                    </ul>
                    <br>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col text-left">
                            <button class="btn btn-dark" :disabled="disableButtons" @click="skip">Skip</button>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" :disabled="!selectedChoice||disableButtons" @click="next">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <h4 class="text-center">OR</h4>
            <div class="text-center">
                <button class="btn btn-link" @click="addQuestion">Add your own question</button>
            </div>
        </div>
        <answered-all v-else-if="answeredAll"></answered-all>
        <reached-limit v-else-if="reachedLimit"></reached-limit>
        <no-questions v-else-if="noQuestions"></no-questions>
    </transition>
</template>

<script>
    export default {
        components: {
            'answered-all': require('./AnsweredAll.vue'),
            'reached-limit': require('./ReachedLimit.vue'),
            'no-questions': require('./NoQuestions.vue')
        },
        data() {
            return {
                question: null,
                choices: [],
                selectedChoice: null,
                currentQuestion: 0,
                reachedLimit: false,
                disableButtons: false,
                answeredAll: false,
                noQuestions: false,
            }
        },
        mounted() {
            bus.$on('init-data-ready', () => {
                this.getRandomQuestion();
            });
        },
        methods: {
            skip() {
                this.disableButtons = true;
                axios.post(appData.urls.skip, {question: this.question.id})
                    .then(response => {
                        axios.get(appData.urls.random).then(response => {
                            this.disableButtons = false;
                            this.question = response.data.question;
                            this.choices = response.data.question.choices;
                            this.selectedChoice = null;
                        });
                    });
            },
            next() {
                this.disableButtons = true;
                axios.post(appData.urls.accept, {question: this.question.id, choice: this.selectedChoice})
                    .then(response => {
                        bus.$emit('increment-questions');
                        this.getRandomQuestion();
                    });
            },
            getRandomQuestion() {
                axios.get(appData.urls.random).then(response => {
                    if (response.data.no_results) {
                        this.answeredAll = true;
                        return;
                    }
                    if (response.data.reached_limit) {
                        this.reachedLimit = true;
                        return;
                    }
                    if (response.data.no_questions) {
                        this.noQuestions = true;
                        return;
                    }
                    this.disableButtons = false;
                    this.question = response.data.question;
                    this.choices = response.data.question.choices;
                    this.selectedChoice = null;
                });
            },
            addQuestion() {
                bus.$emit('add-question');
            }
        }
    }
</script>

<style>
    .question-select .choice{
        cursor: pointer;
    }
</style>
