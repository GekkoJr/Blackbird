<script setup>
import {useForm} from "@inertiajs/vue3";

const passwordForm = useForm({
    password: null,
    verify_password: null,
})

</script>

<template>
    <div class="container">
        <h3>Settings for updating your account</h3>
        <p>Change password</p>
        <form @submit.prevent="passwordForm.post('/user/update/password')">
            <label>
                <span>new password</span>
                <input required type="password" v-model="passwordForm.password">
            </label>
            <label>
                <span>repeat password</span>
                <input required type="password" v-model='passwordForm.verify_password'>
            </label>
            <div v-if="passwordForm.errors.password" class="error">
                <p>TEST</p>
            </div>

            <button type="submit">Change</button>
        </form>
    </div>
</template>

<style scoped lang="scss">
.container {
    padding: 7px;
}

form {
    background-color: $mantle;
    width: fit-content;
    padding: 20px;
    border-radius: 6px;

    label {
        display: grid;
        margin-bottom: 7px;
        grid-template-rows: repeat(2, auto);

        input {
            width: 200px;
            padding: 2px 7px;
            border-radius: 6px;
            border: 1px solid $surface1;
            background-color: $surface0;
            color: $text;
        }
    }

    button {
        background-color: $surface0;
        color: $text;
        border-radius: 6px;
        padding: 5px 7px;
        border: 1px solid $surface1;

        &:hover {
            background-color: $surface1;
        }
    }
}
</style>
