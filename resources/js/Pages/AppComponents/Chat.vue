<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
    channel: String,
})

const form = useForm({
    message: null,
    channel: null,
})

window.Echo.private(`ws.${props.channel}`)
    .listen('Message', (e) => {
      console.log(e)
    })

form.channel = props.channel

</script>

<template>
    <div class="sendAndReciveContainer">
        <div class="reciveMessage">
        </div>
        <div class="sendMessage">
            <form @submit.prevent="form.post('/api/send')">
                <input type="text" v-model="form.message">
                <button><span class="material-symbols-outlined">send</span></button>
            </form>
        </div>
    </div>
</template>

<style scoped lang="scss">
.sendAndReciveContainer {
    height: calc(100dvh - 100px);
    display: grid;
    grid-auto-rows: auto 50px;
}

.sendMessage form{
    width: 100%;
    gap: 10px;
    display: grid;
    grid-template-columns: auto 37px;

    input {
        background-color: $surface0;
        border: none;
        border-radius: 6px;
        flex: 10;
        color: $text;
        padding: 0 5px;
        height: 37px;
    }


    button {
        background-color: $surface0;
        border: none;
        display: flex;
        justify-content: center;
        border-radius: 6px;
        align-items: center;
        height: 37px;
        width: 37px;
        margin-right: 10px;

        span.material-symbols-outlined {
            color: $text;
            font-size: 26px;
            flex: fit-content;
        }
    }
}

.reciveMessage {
    overflow: scroll;
}

.nameAndTime {
    margin-top: 5px;

    p {
        display: inline;
        margin-right: 10px;
    }

    :nth-child(1) {
        font-size: 1em;
    }

    :nth-child(2) {
        font-size: 0.7em;
        color: $surface2;
    }
}
</style>
