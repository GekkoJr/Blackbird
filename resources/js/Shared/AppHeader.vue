<script setup>
</script>

<template>
    <header>
        <nav>
            <a class="headerLink" href="/"><span class="headerFunColor">//</span>Blackbird</a>
            <a class="headerLink">Settings</a>
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

.dropdown {
    position: absolute;
    top: 70px;
    right: 20px;
    display: grid;
    grid-template-rows: repeat(2, auto);
    background-color: $mantle;
    z-index: 10;

}
</style>
