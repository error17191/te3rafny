<template>
    <div class="text-center">
        <h3>You answered {{questionsCount}} Questions</h3>
        <p v-if="questionsCount < minQuestions">You need at least to answer {{minQuestions}} questions to publish your test</p>
        <div v-else>
            <button class="btn btn-success btn-success">Publish Your Test</button>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                questionsCount: 0,
                readyToGo: false,
                minQuestions: 3
            };
        },
        mounted() {
            bus.$on('question-answered', () => this.questionsCount++)
        },

        watch: {
            questionsCount: function (count) {
                if (count >= this.minQuestions) {
                    this.readyToGo = true;
                }
            }
        }


    }
</script>