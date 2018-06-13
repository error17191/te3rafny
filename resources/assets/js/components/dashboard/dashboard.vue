<template>
    <div class="card" id="create-question">
        <div class="card-body">
            <nav class="nav nav-pills nav-justified">
                <a class="nav-item nav-link active" href="#">New</a>
                <a class="nav-item nav-link" href="#">Public</a>
                <a class="nav-item nav-link" href="#">Private</a>
            </nav>
            <br>
            <form @submit.prevent="submitQuestion">
                <!-- Modal body -->
                <div class="question">
                    <h4 class="text-center font-weight-bold">Your Question: </h4>
                    <input class="question-content form-control" :disabled="posting" v-model="question"
                           placeholder="* Required">
                </div>
                <br>
                <div class="row choices justify-content-center">
                    <div class="col-11 col-md-9 col-lg-6">
                        <h5 class="text-center font-weight-bold">
                            At least 2 choices
                        </h5>
                        <input :disabled="posting" v-model="choices[0]" class="form-control choice"
                               placeholder="* Required">
                        <input :disabled="posting" v-model="choices[1]" class="form-control choice"
                               placeholder="* Required">
                        <input :disabled="posting" v-model="choices[2]" class="form-control choice"
                               placeholder="+ Optional">
                        <input :disabled="posting" v-model="choices[3]" class="form-control choice"
                               placeholder="+ Optional">
                        <input :disabled="posting" v-model="choices[4]" class="form-control choice"
                               placeholder="+ Optional">
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-11 col-md-9 col-lg-6">
                        <button type="submit"
                                :disabled="!canPost" class="btn btn-success btn-block">
                            <span v-show="!posting">Done</span>
                            <span v-show="posting">
                                     <i class="fas fa-spinner fa-spin"></i>
                                </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                posting: false,
                choices: [],
                question: ''
            }
        },
        computed: {
            canPost: function () {
                return this.question && this.choices[0] && this.choices[1];
            }
        },
        mounted() {
            $('#create-question .question-content').trigger('focus');
        },
        methods: {
            submitQuestion() {
                this.posting = true;
                axios.post(appData.urls.questions.store,{
                    choices: this.choices, question: this.question
                }).then(response => {
                    this.posting = false;
                    this.choices = [];
                    this.question = '';
                    toastr.success('You can add another question now','Question added successfully');
                    $('#create-question .question-content').trigger('focus');
                });
            }
        }
    }
</script>

<style>
    #dashboard #create-question .choice {
        margin-bottom: 10px;
    }
</style>