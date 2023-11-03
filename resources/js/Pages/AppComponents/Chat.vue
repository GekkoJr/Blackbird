<script setup>
import {useForm} from '@inertiajs/vue3'
import {onUpdated, onMounted, reactive, ref,  onBeforeMount} from "vue"

const props = defineProps({
    channel: String,
})

const form = useForm({
    message: null,
    channel: null,
})

let skip = 0;
let messages = [];

function getMessages() {
    let link = `/message/get/${props.channel}/${skip}`
    window.axios.get(link)
        .then(function (response) {
            messages = response.data
            console.log(messages)
            console.log('messages recived from server')
        })
}


const messageData = reactive(messages)

window.Echo.private(`ws.${props.channel}`)
    .listen('SendMessage', (e) => {
        messageData.push(e)
    })

function displayDate(unix) {
    let date = new Date(unix * 1000)
    return date
}

function sendMessage() {
    form.post('/message/send')
    form.message = ''
}

function scrollToBottom() {
    const container = document.getElementById('chatBox')
    container.scrollTop = container.scrollHeight
}

form.channel = props.channel

onMounted(() => {
    console.log('Chat mounted succesfully')
    scrollToBottom()
})

onUpdated(() => {
    scrollToBottom()
})

onBeforeMount(() => {
    getMessages()
})

</script>

<template>
    <div class="sendAndReciveContainer">
        <div class="reciveMessage" id="chatBox">
            <div v-for="message of messageData" :key="message.id">
                <div class="nameAndTime">
                    <p v-text="message.fromUser"></p>
                    <p v-text="displayDate(message.created_at_unix)"></p>
                </div>
                <p class="message" v-text="message.message"></p>
            </div>
        </div>

        <div class="sendMessage">
            <form @submit.prevent="sendMessage">
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

.sendMessage form {
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
        color: $lavender;
    }

    :nth-child(2) {
        font-size: 0.7em;
        color: $surface2;
    }
}

.message {
    margin: 0;
    font-size: 0.9em;
}

.message:last-of-type {
    margin-bottom: 20px;
}
</style>
