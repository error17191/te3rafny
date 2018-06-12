<template>
    <transition name="fade">
        <div v-if="show" class="text-center">
            <h3>You answered {{accepted}} Questions</h3>
            <p v-if="accepted < minQuestions">You need at least to answer {{minQuestions}} questions to publish
                your test</p>
            <div v-else>
                <button class="btn btn-success btn-success">Publish Your Test</button>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        data() {
            return {
                accepted: 0,
                readyToGo: false,
                minQuestions: 0,
                maxQuestions: 0,
                show: false
            };
        },
        mounted() {
            bus.$on('question-answered', () => this.questionsCount++)
            bus.$on('init-data-ready', () => {
                this.show = true;
                this.accepted = appData.numbers.accepted;
                this.minQuestions = appData.numbers.min;
                this.maxQuestions = appData.numbers.max;
            });
            bus.$on('accepted-question', () => {
                this.accepted++;
            });
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