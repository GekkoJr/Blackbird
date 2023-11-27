<script setup>
import AppLayout from "../Shared/layouts/AppLayout.vue";
import Menu from "./AppComponents/Menu.vue";
import Friends from "./AppComponents/Friends.vue";
import Chat from "./AppComponents/Chat.vue";

const props = defineProps({
    chatting: Boolean,
    channel: String,
    friends: Array,
})

</script>

<template>
    <AppLayout>
        <div class="layout">
            <Menu :friends="friends"/>
            <Chat  class="mainView" :channel="channel" v-if="chatting"/>
            <Friends :friends="friends" class="mainView" v-else />
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

.mainView {
    // needed for it to start at the same line as menu
    margin-top: 40px;
    padding: 0 10px;

    p {
        margin: 0;
    }
}
</style>
