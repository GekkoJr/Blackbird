<script setup>
defineProps({
    name: String,
    frameworks: Array,
})


</script>

<template>
    <p>Test</p>
    <h1>HElllo {{ name }} </h1>
    <ul>
        <li v-for="framework of frameworks" v-text="framework"></li>

    </ul>
</template>

<style scoped>

</style>
