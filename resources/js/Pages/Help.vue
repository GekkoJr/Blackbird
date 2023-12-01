<script setup>
import AppLayout from "../Shared/layouts/AppLayout.vue";
import {marked} from "marked";

const props = defineProps({
    body: null,
})
</script>

<template>
    <AppLayout>
        <!-- As this renders markdown as html it is important to never let a user create a help article -->
        <div v-html="marked(body)"></div>
    </AppLayout>
</template>

<style scoped lang="scss">
a {
    color: $blue;

    &:hover {
        color: $maroon;
        cursor: grab;
    }
}
</style>
