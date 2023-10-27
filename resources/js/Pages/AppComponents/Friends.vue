<script setup>
import { ref } from 'vue'

let menuPage = ref(1)

let allFriends = window.axios.get('/user/friends')

console.log(allFriends)

</script>

<template>
    <div class="container">
        <div>
            <button @click="menuPage = 1">All</button>
            <button @click="menuPage = 2">Add</button>
            <button @click="menuPage = 3">Pending</button>
        </div>
        {{ menuPage }}
        <div v-show="menuPage === 1">
            Aaaa
        </div>
        <div v-show="menuPage === 2">
            bbbbb
        </div>
        <div v-show="menuPage === 3">
            cccc
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
