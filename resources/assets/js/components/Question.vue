<template>
    <transition name="fade">
        <div v-if="question && ! answeredAll" class="card">
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
                        <button class="btn btn-success" :disabled="!selectedChoice||disableButtons" @click="next">Next</button>
                    </div>
                </div>
            </div>

        </div>
        <answered-all v-if="answeredAll"></answered-all>
    </transition>
</template>

<script>
    export default {
        components: {
            'answered-all' : require('./AnsweredAll.vue')
        },
        data() {
            return {
                question: null,
                choices: [],
                selectedChoice: null,
                currentQuestion: 0,
                reachedLimit: false,
                disableButtons: false,
                answeredAll : false
            }
        },
        mounted() {
            bus.$on('init-data-ready', () => {
                axios.get(appData.urls.random).then(response => {
                    if(response.data.no_results){
                        this.answeredAll = true;
                        return;
                    }
                    this.question = response.data.question;
                    this.choices = response.data.question.choices;
                    this.currentQuestion = 1;
                });
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
                        axios.get(appData.urls.random).then(response => {
                            if(response.data.no_results){
                                this.answeredAll = true;
                                return;
                            }
                            bus.$emit('accepted-question');
                            this.disableButtons = false;
                            this.question = response.data.question;
                            this.choices = response.data.question.choices;
                            this.selectedChoice = null;
                        });
                    });
            }
        }
    }
</script>
