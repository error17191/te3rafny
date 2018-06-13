<template>
    <transition name="fade">
        <div v-if="show" class="text-center">
            <h3>You answered {{answered}} Questions</h3>
            <p v-if="answered < minQuestions">You need at least to answer {{minQuestions}} questions to publish
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
                answered: 0,
                readyToGo: false,
                minQuestions: 0,
                maxQuestions: 0,
                show: false
            };
        },
        mounted() {
            bus.$on('init-data-ready', () => {
                this.show = true;
                this.answered = appData.numbers.answered;
                this.minQuestions = appData.numbers.min;
                this.maxQuestions = appData.numbers.max;
            });
            bus.$on('increment-questions', () => {
                this.answered++;
            });
        },

    }
</script>