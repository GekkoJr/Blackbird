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
                <div style="height: 10px"></div>
                <button class="normal" @click="page = 1">Profile</button>
                <button class="normal" @click="page = 2">Account</button>
                <button class="logout" onclick="location.href = '/user/logout'">Log out</button>
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
        padding: 7px 10px;
        display: flex;
        align-items: center;
        border: none;
        background-color: $base;
        font-size: 1em;

        &:hover {
            background-color: $surface0;
        }


    }
}

.logout {
    color: $red;
}

.normal {
    color: $text;
}
</style>
