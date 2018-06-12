<template>
    <div class="alert alert-secondary" role="alert">
        <h3 class="text-center">
            <p>No Questions Available right Now, You can add your own questions</p>
            <button class="btn btn-dark" @click="bus.$emit('add-question')">Add Question</button>
        </h3>
    </div>
</template>

<style></style>