<template>
    <div class="modal fade" id="add-question">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="question">
                        <h4 class="text-center font-weight-bold">Your Question: </h4>
                        <input class="form-control" placeholder="* Required">
                    </div>
                    <br>
                    <div class="row choices justify-content-center">
                        <div class="col-11 col-md-9 col-lg-6">
                            <h5 class="text-center text-success font-weight-bold">Correct Answer: </h5>
                            <input class="form-control choice" placeholder="* Required">
                            <h5 class="text-center text-warning font-weight-bold">At least 1 other choice</h5>
                            <input class="form-control choice" placeholder="* Required">
                            <input class="form-control choice" placeholder="+ Optional">
                            <input class="form-control choice" placeholder="+ Optional">
                            <input class="form-control choice" placeholder="+ Optional">
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="col text-left">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-success">Done</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            bus.$on('add-question', () => {
                $('#add-question').modal()
            });
        }
    }
</script>

<style>
    #add-question .choice {
        margin-bottom: 10px;
    }
</style>