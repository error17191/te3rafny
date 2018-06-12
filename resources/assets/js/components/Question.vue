<template>
    <transition name="fade">
        <div v-if="question && ! answeredAll && ! reachedLimit" class="card">
            <div class="card-header">{{question.content}}</div>

            <div class="card-body text-center">
                <div class="radio" v-for="choice in choices">
                    <label><input type="radio" name="choice" v-model="selectedChoice" :value="choice.id">{{choice.content}}</label>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col text-left">
                        <button class="btn btn-dark" :disabled="disableButtons" @click="skip">Skip</button>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success" :disabled="!selectedChoice||disableButtons" @click="next">Next
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <answered-all v-if="answeredAll"></answered-all>
        <reached-limit v-if="reachedLimit"></reached-limit>
        <no-questions v-if="noQuestions"></no-questions>
        <div v-if="question">
            <br>
            <br>
            <hr>
            <h5 class="text-center">OR</h5>
            <div class="text-center">
                <button @click="bus.$emit('add-question')" class="btn btn-default">Add your own question</button>
            </div>
        </div>

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
                        this.getRandomQuestion();
                    });
            },
            getRandomQuestion(){
                axios.get(appData.urls.random).then(response => {
                    if (response.data.no_results) {
                        this.answeredAll = true;
                        return;
                    }
                    if (response.data.reached_limit) {
                        this.reachedLimit = true;
                        return;
                    }
                    if(response.data.no_questions){
                        this.noQuestions = true;
                        return;
                    }
                    bus.$emit('accepted-question');
                    this.disableButtons = false;
                    this.question = response.data.question;
                    this.choices = response.data.question.choices;
                    this.selectedChoice = null;
                });
            }
        }
    }
</script>
