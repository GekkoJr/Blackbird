<script setup>
import { ref } from 'vue'
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const searchForm = useForm({
    username: null
})

let menuPage = ref(1)
let allFriends = []
let pending = []
let userInfo = {}

window.axios.get('/user/friends')
    .then(function (response) {
        allFriends = response.data
    })

window.axios.get('/user/pending')
    .then(function (response) {
        pending = response.data
        console.log(pending)
    })

window.axios.get('/user/info')
    .then(function (response) {
        userInfo = response.data
        console.log(userInfo)
    })

</script>

<template>
    <div class="container">
        <div>
            <button @click="menuPage = 1">All</button>
            <button @click="menuPage = 2">Add</button>
            <button @click="menuPage = 3">Pending</button>
        </div>
        <div v-show="menuPage === 1">
            <div v-for="friend in allFriends">
                <div>
                    <p v-text="friend[1]"></p>
                    <Link :href="'/app/channel/' + friend[0]" as="button" class="material-symbols-outlined">message</Link>
                </div>
            </div>
        </div>
        <div v-show="menuPage === 2">
            <form @submit.prevent="searchForm.post('/user/add')">
                <label>
                    <span style="display: none">Add user here</span>
                    <input type="text" v-model="searchForm.username" placeholder="Add user">
                    <button type="submit" class="material-symbols-outlined">add</button>
                </label>
                <p class="error" v-if="searchForm.errors.error">{{ searchForm.errors.error }}</p>
                <p class="error" v-if="searchForm.errors.success">{{ searchForm.errors.success }}</p>
            </form>
        </div>
        <div v-show="menuPage === 3">
            <div v-for="friend in pending">
                <p v-if="friend[0] !== userInfo.username" v-text="friend[0]"></p>
                <p v-else v-text="friend[1]"></p>
                <p v-if="friend[2] === userInfo.id">waiting for answer</p>
                <button v-else class="material-symbols-outlined">check</button>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
