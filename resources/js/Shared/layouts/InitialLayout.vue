<script setup>
import Header from "../Header.vue"
import { Head } from "@inertiajs/vue3"
</script>

<template>
    <Head>
        <title>
            Blackbird
        </title>
    </Head>
    <Header/>

    <main>
        <slot/>
    </main>
</template>

<style scoped>

</style>
