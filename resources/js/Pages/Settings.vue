<script setup>
import {ref} from "vue";
import AccountSettings from "./AppComponents/AccountSettings.vue";
import ProfileSettings from "./AppComponents/ProfileSettings.vue";
import AppLayout from "../Shared/layouts/AppLayout.vue";

let page = ref(1);
</script>

<template>
    <AppLayout>
        <div class="layout">
            <div class="mainMenu">
                <button @click="page = 1">Profile</button>
                <button @click="page = 2">Account</button>
            </div>
            <ProfileSettings v-if="page === 1"></ProfileSettings>
            <AccountSettings v-if="page === 2"></AccountSettings>
        </div>
    </AppLayout>
</template>

<style scoped lang="scss">
.layout {
    display: flex;

    height: calc(100dvh - 65px);

    :nth-child(1) {
        flex: 2;
    }

    :nth-child(2) {
        flex: 12;
    }
}

.mainMenu {
    border-right: 2px solid $surface1;
    height: 100%;
    color: $text;

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
</style>
