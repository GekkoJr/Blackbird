<script setup>
import { Head } from "@inertiajs/vue3";
import AppHeader from "../AppHeader.vue";
</script>

<template>
    <Head>
        <title>
            Blackbird
        </title>
    </Head>
    <app-header />
    <main>
        <slot />
    </main>
</template>

<style scoped>

</style>
