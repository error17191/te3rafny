<template>
    <div class="card" id="create-question">
        <div class="card-body">
            <nav class="nav nav-pills nav-justified d-sm-flex d-none">
                <a class="nav-item nav-link active col-12" href="/dashboard/new">New</a>
                <a class="nav-item nav-link col-12" href="/dashboard/public">Public</a>
                <a class="nav-item nav-link" href="/dashboard/private">Private</a>
            </nav>
            <br>
            <component v-if="currentView" v-bind:is="currentView"></component>
            <h3 class="text-center" v-else>NOT FOUND</h3>
        </div>
    </div>

</template>
<script>
    export default {
        components: {
            'new-question': require('./NewQuestion.vue'),
            'private-questions': require('./PrivateQuestion.vue'),
            'public-questions': require('./PublicQuestions.vue')
        },
        data() {
            return {
                currentView: null,
                views : {
                    'new': 'new-question',
                    private: 'private-questions',
                    public : 'public-questions'
                },
            }
        },
        mounted() {
            window.onpopstate = function(event) {
                console.log("WORKING");
            };
            $(this.$el).on('click','a',(e)=>{
                e.preventDefault();
                let route = e.target.pathname.split('/').pop();
                history.pushState(null,null,`/dashboard/questions/${route}`)
            });
            let pieces = location.pathname.split('/');
        }


    }
</script>
