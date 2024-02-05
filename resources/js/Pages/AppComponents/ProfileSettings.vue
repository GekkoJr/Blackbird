<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: null,
})

const form = useForm({
    avatar: null,
})

console.log(props.user)


</script>

<template>
    <div style="padding: 10px">
        <div>
            <h3>Your current Profile image</h3>
            <img class="icon" :src="'/user/img/' + user.id" alt="Your user profile pic">
            <form class="img" @submit.prevent="form.post('/user/update-img')">
                <input required type="file" @input="form.avatar = $event.target.files[0]">
                <button type="submit">Upload new icon</button>
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </form>
        </div>
    </div>
</template>

<style scoped lang="scss">
.icon {
    border-radius: 100%;
    width: 300px;
    height: 300px;
    object-fit: cover;
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

.img {
    width: 300px;
    display: grid;
    grid-template-rows: repeat(2, auto);
    gap: 10px;
}
</style>
