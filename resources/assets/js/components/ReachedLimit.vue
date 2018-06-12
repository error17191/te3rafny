<template>
    <div class="alert alert-secondary" role="alert">
        <h3 class="text-center">
            Your test has reached maximum of {{max}} Questions and ready to be published
        </h3>
    </div>

</template>
<script>
    export default {
        data(){
            return {
                max: 0,
            }
        },
        mounted(){
            this.max = appData.numbers.max;
        }
    }
</script>