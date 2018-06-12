<template>
    <div class="overlay" id="add-question">
        <div class="overlay-content">
            <div class="from-group question">
                <h4 class="text-center font-weight-bold">Your Question: </h4>
                <input class="form-control" autofocus>
            </div>
            <div class="choices">
                <h5 class="text-center text-success">Correct Answer: </h5>
                <input class="form-control choice">
                <h5 class="text-center text-warning">At least 1 other choice</h5>
                <input class="form-control choice">
                <input class="form-control choice">
                <input class="form-control choice">
                <input class="form-control choice">
            </div>
            <div class="overlay-footer">
                <hr>
                <div class="row">
                    <div class="col-6 text-left">
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-success">Add Question</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false
            }
        }
    }
</script>

<style>
    #add-question .question {
        margin: 50px auto auto auto;
        width: 80%;
    }

    #add-question .choices {
        margin: 50px auto auto auto;
        width: 65%;
    }

    #add-question .choices .choice {
        margin-bottom: 10px;
    }

    #add-question .overlay-footer{
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 80px;
    }

    @media screen and (max-width: 800px) {
        #add-question .question {
            width: 90%;
        }

        #add-question .choices {
            width: 75%;
        }
        #add-question .overlay-footer {
            width: 90%;
        }

    }

    @media screen and (max-width: 450px) {
        #add-question .question {
            width: 95%;
            margin-top: 50px;
        }

        #add-question .choices {
            width: 90%;
        }
        #add-question .overlay-footer {
            width: 90%;
        }

    }
</style>