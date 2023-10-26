<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
    channel: String,
})

const form = useForm({
    message: String,
    channel: String,
})

window.Echo.private('ws.' + props.channel)
    .listen('Message', (e) => {
      console.log(e)
    })

</script>

<template>
    <div class="sendAndReciveContainer">
        <div class="reciveMessage">
        </div>
        <p>{{ channel }}</p>
        <div class="sendMessage">
            <form @submit.prevent="form.post('/api/send')">
                <input type="text">
                <button><span class="material-symbols-outlined">send</span></button>
            </form>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
