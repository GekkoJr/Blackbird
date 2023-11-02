<script setup>
import {ref} from 'vue'
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import {all} from "axios";

const props = defineProps({
    friends: Array,
})

const searchForm = useForm({
    username: null
})

const addUserForm = useForm({
    user: null,
})

let pending = []
let userInfo = {}


window.axios.get('/user/pending')
    .then(function (response) {
        pending = response.data
    })

window.axios.get('/user/info')
    .then(function (response) {
        userInfo = response.data
    })

let menuPage = ref(1)

function confirmUser(id) {
    addUserForm.user = id
    addUserForm.post('/user/accept')
}

</script>

<template>
    <div class="container">
        <div class="menu">
            <button @click="menuPage = 1">All</button>
            <button @click="menuPage = 2">Add</button>
            <button @click="menuPage = 3">Pending</button>
        </div>
        <div v-show="menuPage === 1">
            <div v-if="friends.length !== 0" v-for="friend in friends" class="usersDisplay">
                <div>
                    <p v-text="friend[1]"></p>
                    <Link :href="'/app/channel/' + friend[0]" as="button" class="material-symbols-outlined">message
                    </Link>
                </div>
            </div>
            <div v-else>
                <p>You have no friends, yet</p>
            </div>
        </div>
        <div v-show="menuPage === 2">
            <form class="addUser" @submit.prevent="searchForm.post('/user/add')">
                <label>
                    <input type="text" v-model="searchForm.username" placeholder="Add user">
                    <button type="submit" class="material-symbols-outlined">add</button>
                </label>
                <p class="error" v-if="searchForm.errors.error">{{ searchForm.errors.error }}</p>
                <p class="error" v-if="searchForm.errors.success">{{ searchForm.errors.success }}</p>
            </form>
        </div>
        <div v-show="menuPage === 3">
            <div v-if="pending.length !== 0" v-for="friend in pending" class="usersDisplay">
                <div>
                    <p v-if="friend[0] !== userInfo.username" v-text="friend[0]"></p>
                    <p v-else v-text="friend[1]"></p>
                    <p v-if="parseInt(friend[2]) === userInfo.id">waiting for answer</p>
                    <button @click="confirmUser(parseInt(friend[3]))" v-else class="material-symbols-outlined">check
                    </button>
                </div>
            </div>
            <div v-else>
                <p>You have no pending friendrequest</p>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.usersDisplay {
    width: 100%;

    div {
        display: grid;
        grid-template-columns: auto auto;
        justify-content: space-between;

        button {
            background-color: $surface0;
            border: none;
            color: $text;
            padding: 0;
            margin: 0;
            width: 45px;
            height: 45px;
            border-radius: 100%;
        }
    }
}

.menu {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;

    button {
        background-color: $surface0;
        color: $text;
        width: fit-content;
        border-radius: 6px;
        padding: 5px 10px;
        margin: 0 5px;
        border: 1px solid $surface0;

        &:hover {
            color: $flamingo;
            border: 1px solid $surface1;
        }
    }
}

.addUser {
    display: flex;
    align-items: center;

    label {

        input {
            background-color: $surface0;
            color: $text;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
        }

        button {
            background-color: $surface0;
            color: $text;
            border: none;
            vertical-align: center;

            &:hover {
                color: $flamingo;
            }
        }
    }
}
</style>
