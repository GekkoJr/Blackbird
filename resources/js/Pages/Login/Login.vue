<script setup>
import layout from '../../Shared/layouts/InitialLayout.vue'
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
})
</script>

<template>
    <layout>
        <div class="centerLogin">
            <form class="loginForm" @submit.prevent="form.post('/loginUser')">
                <label>
                    <span>Email</span>
                    <input type="email" v-model="form.email"></label>
                <div v-if="form.errors.email" class="error">
                    <p>{{ form.errors.email }}</p>
                </div>
                <label>
                    <span>Password</span>
                    <input type="password" v-model="form.password"></label>
                <div v-if="form.errors.password" class="error">
                    <p>{{ form.errors.password }}</p>
                </div>
                <button type="submit" :disabled="form.processing">Login</button>
                <p>Are you new? <Link href="/signup" class="link">click here</Link></p>
            </form>
        </div>
    </layout>
</template>

<style scoped lang="scss">
.loginForm {
    background-color: $mantle;
    padding: 30px;
    box-sizing: border-box;
    display: flex;
    flex-wrap: wrap;
    max-width: 400px;
    border-radius: 10px;
    justify-content: center;

    label {
        flex: 100%;
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    label input {
        flex: 100%;
        background-color: $surface0;
        border-radius: 6px;
        box-shadow: none;
        height: 30px;
        color: $text;
        border: none;
        padding: 0 5px;
        margin-top: 3px;

    }

    label span:nth-child(n + 2) {
        margin-top: 12px
    }

    button {
        flex: 100%;
        background-color: $surface0;
        border-radius: 6px;
        color: $text;
        height: 30px;
        border: 1px solid $surface0;
        font-size: 0.9em;
        margin-bottom: 10px;

        &:hover {
            background-color: $surface1;
        }
    }

    p {
        justify-self: center;
        padding: 0;
        margin: 0;
        font-size: 1em;
    }
}

.centerLogin {
    position: absolute;
    top: 0;
    left: 0;
    width: 100dvw;
    height: 100dvh;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
