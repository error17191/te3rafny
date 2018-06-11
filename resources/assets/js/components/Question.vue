<template>
    <div class="card">
        <div class="card-header">{{question ? question.content: ''}}</div>

        <div class="card-body text-center">
            <div class="radio" v-for="choice in choices">
                <label><input type="radio" name="choice" v-model="selectedChoice" :value="choice.id">{{choice.content}}</label>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col text-left">
                    <button class="btn btn-default">Back</button>
                </div>
                <div class="col text-right">
                    <button class="btn btn-dark">Skip</button>
                    <button class="btn btn-success" :disabled="!selectedChoice">Next</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                question: null,
                choices: [],
                selectedChoice: null,
                currentQuestion: 0,
            }
        },
        mounted() {
            axios.get('/make-your-test/random').then(response => {
                this.question = response.data.question;
                this.choices = response.data.question.choices;
                this.currentQuestion = 1;
            });
        },
        methods: {
            skip() {
                axios.post('/make-your-test/skip', {question: this.question.id})
                    .then(response => {
                        this.currentQuestion++;
                    });
            },
            next() {
                axios.post();
            }
        }
    }
</script>