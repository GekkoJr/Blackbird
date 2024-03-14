<script setup>
import AppLayout from "../Shared/layouts/AppLayout.vue";
import {marked} from "marked";
import HelpMenu from "./AppComponents/HelpMenu.vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
    body: null,
    menu: null,
    path: null,
})
let page = ""

props.path.includes("/") ? page = props.path.split("/")[1] : page = props.path

console.log(props.path)
console.log("current page: " + page)

console.log(props.body)
</script>

<template>
    <AppLayout>
        <Head>
            <title>Blackbird: {{page}}</title>
        </Head>
        <div class="help-layout">
            <aside style="margin-top: 30px">
                <HelpMenu :page="page" :menu="menu"/>
            </aside>
            <!-- As this renders markdown as html it is important to never let a user create a help article -->
            <div class="help" v-html="marked(body)"></div>

        </div>
    </AppLayout>
</template>

<style scoped lang="scss">
div {
    padding: 10px;
}

.help-layout {
    display: grid;
    grid-template-columns: 300px auto;
}

</style>
