<script setup>
import {useForm} from "@inertiajs/vue3";

const passwordForm = useForm({
    password: null,
    verify_password: null,
})

const emailForm = useForm({
    email: null,
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
            <div style="margin-bottom: 5px" v-if="passwordForm.errors.error" class="error">
                <p>{{ passwordForm.errors.error }}</p>
            </div>
            <button type="submit">Change Password</button>
        </form>
        <p>Change email</p>
        <form @submit.prevent="emailForm.post('/user/update/email')">
            <label>
                <span>New email</span>
                <input type="email" required v-model="emailForm.email">
            </label>
            <div class="error" style="margin-bottom: 5px" v-if="emailForm.errors.email">
                <p>{{ emailForm.errors.email }}</p>
            </div>
            <div style="margin-bottom: 5px" v-if="emailForm.errors.success">
                <p>{{ emailForm.errors.success }}</p>
            </div>
            <button type="submit">Change email</button>
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
