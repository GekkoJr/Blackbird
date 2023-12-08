<script setup>
import {useForm} from '@inertiajs/vue3'
import {onUpdated, onMounted, ref, onBeforeMount, onBeforeUpdate} from "vue"

// gets current channel from inertia js
const props = defineProps({
    channel: String,
})

// form to send a message
const form = useForm({
    message: null,
    channel: null,
})

let skip = 0;
let ableToGet = true;
const messages = ref([]);
let firstScroll = true
let newMessagesDB = false
let lastScrollHeight = 0

function getMessages() {
    // yes its shit, but it hinders you from sending more than one request at a time
    if (ableToGet) {
        let link = `/message/get/${props.channel}/${skip}`
        ableToGet = false
        // axios contacts the server asking for messages and reverses them, so they display correctly
        window.axios.get(link)
            .then(function (response) {
                messages.value = response.data.reverse().concat(messages.value)
                skip = skip + 50
                // allows it to send a new request
                ableToGet = true
                newMessagesDB = true
            })
    }
}

// listens for the SendMessage event over websockets
window.Echo.private(`ws.${props.channel}`)
    .listen('SendMessage', (e) => {
        console.log(e)
        skip++;
        messages.value.push(e)
        // makes sure we scroll after the message loads
        firstScroll = true
    })

// turns unix dates into readable dates
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

// checks if user is at the top of the page and starts loading more messages
function handleScroll(e) {
    if (e.target.scrollTop === 0) {
        getMessages()
    }
}

form.channel = props.channel

// scrolls to bottom after messages have loaded
onMounted(() => {
    const chatBox = document.getElementById('chatBox');
    console.log('Chat mounted succesfully')
    scrollToBottom()
})

// gets messages after the page has been given to the user but before it has finished initializing
onBeforeMount(() => {
    getMessages()
})

// if there is new messages from db make sure we keep our current position in the window
onUpdated(() => {
    if (newMessagesDB && !firstScroll) {
        // moves the user to where they were
        chatBox.scrollTop = chatBox.scrollHeight - lastScrollHeight
        newMessagesDB = false
    }
    if (firstScroll) {
        // only runs when the first messages appear
        scrollToBottom()
        firstScroll = false;
    }

})

// saves current pos before we load more messages
onBeforeUpdate(() => {
    if (newMessagesDB) {
        lastScrollHeight = chatBox.scrollHeight
    }
})

</script>

<template>
    <div class="sendAndReciveContainer">
        <div class="reciveMessage" id="chatBox" v-on:scroll="handleScroll">
            <div v-for="message of messages" :key="message.id">
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
