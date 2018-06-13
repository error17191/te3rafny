<template>
    <div class="modal fade" id="add-question">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Question</h4>
                    <button :disabled="posting" type="button" class="close" @click="cancel">&times;</button>
                </div>
                <form @submit.prevent="submitQuestion">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="question">
                            <h4 class="text-center font-weight-bold">Your Question: </h4>
                            <input class="question-content form-control" :disabled="posting" v-model="question"
                                   placeholder="* Required">
                        </div>
                        <br>
                        <div class="row choices justify-content-center">
                            <div class="col-11 col-md-9 col-lg-6">
                                <h5 class="text-center text-success font-weight-bold">Correct Answer: </h5>
                                <input :disabled="posting" v-model="choices[0]" class="form-control choice"
                                       placeholder="* Required">
                                <h5 :disabled="posting" class="text-center text-warning font-weight-bold">At least 1
                                    other choice</h5>
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

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="col text-left">
                            <button @click="cancel" :disabled="posting" type="button" class="btn btn-danger">Cancel</button>
                        </div>
                        <div class="col text-right">
                            <button type="submit" :disabled="!canPost" class="btn btn-success">
                                <span v-show="!posting">Done</span>
                                <span v-show = "posting">
                                     <i class="fas fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                choices: [],
                question: '',
                posting: false
            }
        },
        mounted() {
            bus.$on('add-question', () => {
                $('#add-question').modal({
                    backdrop: "static",
                    keyboard: false
                });

                $('#add-question').on('shown.bs.modal', function () {
                    $('#add-question .question-content').trigger('focus');
                })

            });
        },
        computed: {
            canPost: function () {
                return this.question && this.choices[0] && this.choices[1];
            }
        },
        methods: {
            submitQuestion() {
                this.posting = true;
                axios.post(appData.urls.add,{
                    choices: this.choices, question: this.question
                }).then(response => {
                    this.posting = false;
                    this.choices = [];
                    this.question = '';
                    $('#add-question').modal('hide');
                    bus.$emit('increment-questions');
                    toastr.success('Question added :)')
                });
            },
            cancel(){
                this.choices = [];
                this.question = '';
                $('#add-question').modal('hide');
            }
        }

    }
</script>

<style>
    #add-question .choice {
        margin-bottom: 10px;
    }
</style>