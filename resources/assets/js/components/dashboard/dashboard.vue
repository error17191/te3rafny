<template>
    <component v-if="currentView" v-bind:is="currentView"></component>
    <h3 class="text-center" v-else>NOT FOUND</h3>
</template>

<script>
    export default {
        components: {
            questions: require('./Questions.vue'),
            reports : require('./Reports.vue'),
            stats : require('./Stats.vue')
        },
        data() {
            return {
                currentView: null,
                views : {
                    questions: 'questions',
                    stats: 'stats',
                    reports: 'reports'
                }
            }
        },
        mounted() {
            let pieces = location.pathname.split('/');
            this.currentView = this.views[pieces[2]];
        }
    }
</script>
