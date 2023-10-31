<script setup>
import { Link } from "@inertiajs/vue3";
import { reactive } from "vue";

let Friends = []

window.axios.get('/user/friends')
    .then(function (response) {
        Friends = response.data
        console.log(Friends)
    })

const allFriends = reactive(Friends)

</script>

<template>
    <div class="mainMenu">
        <div class="filler30px"></div>
        <Link as="button" href="/app"><span class="material-symbols-outlined">diversity_3</span><p>Friends</p></Link>
        <Link as="button" href="/app/global"><span class="material-symbols-outlined">public</span><p>Global Chat</p></Link>
    </div>
    <Link v-for="friend in allFriends" :key="friend[0]" :href="'/app/channel/' + friend[0]" v-text="friend[1]"></Link>
</template>

<style scoped lang="scss">
.mainMenu {
    border-right: 2px solid $surface1;
    height: 100%;

    button {
        width: 95%;
        margin: auto auto 5px;
        border-radius: 6px;
        height: 35px;
        padding: 7px 0;
        display: flex;
        align-items: center;
        border: none;
        background-color: $base;

        p {
            color: $text;
            font-size: 1.5em;
            text-align: left;
        }

        span.material-symbols-outlined {
            color: $text;
            font-size: 27px;
            margin: 0 5px;
        }

        &:hover {
            background-color: $surface0;
        }
    }
}

.filler30px {
    height: 30px;
}
</style>
