<script setup>
defineProps({
    loggedIn: Boolean,
})
</script>

<template>
    <header>
        <nav>
            <a href="/home"><span>//</span>Blackbird</a>
            <a href="/app" v-if="loggedIn">Chat</a>
            <a href="/login" v-else>Login</a>
        </nav>
    </header>
</template>

<style scoped lang="scss">
header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    background-color: $mantle;

    a {
        z-index: 3;
        display: block;
        padding: 0 20px;
    }

    :nth-child(2) {
        text-align: right;
    }
}

.headerLink {
    text-decoration: none;
    color: $text;

    &:hover {
        color: $blue;
    }
}

.headerFunColor {
    color: $green;
}

</style>
