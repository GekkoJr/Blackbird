<script setup>
import AppLayout from "../Shared/layouts/AppLayout.vue";
import Menu from "./AppComponents/Menu.vue";
import Friends from "./AppComponents/Friends.vue";

defineProps({
    friends: Object,
})
</script>

<template>
    <AppLayout>
        <div class="layout">
            <Menu />
            <Friends />
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
</style>
