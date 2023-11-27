<script setup>
defineProps({
    loggedIn: Boolean,
})
</script>

<template>
    <header>
            <a class="headerLink" href="/"><span class="headerFunColor">//</span>Blackbird</a>
            <a class="headerLink" href="/app" v-if="loggedIn">Chat</a>
            <a class="headerLink" href="/login" v-else>Login</a>
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
        padding: 12px 20px;
        font-size: 1.5em;
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
