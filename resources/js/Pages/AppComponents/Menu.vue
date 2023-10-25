<script setup>

</script>

<template>
    <div class="mainMenu">

    </div>
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
