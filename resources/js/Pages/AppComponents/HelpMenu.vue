<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    menu: null,
    page: null,
})
// this whole thing could be much more effcient / fast

</script>

<template>
    <div class="menu-container">
        <p>Blackbird Help</p>
        <div class="indent" v-for="item in JSON.parse(menu)">
            <Link v-if="!item.isDirectory && item.parent == null" :href="'/help/' + item.name"
                  :class="{ active: item.name === page}"
                  v-text="item.name"></Link>
        </div>
        <div v-for="item in JSON.parse(menu)">
            <div style="margin-top: 6px" class="directory" v-if="item.isDirectory">
                <p class="section">{{ item.name }}</p>
                <div class="indent" v-for="link in JSON.parse(menu)">
                    <Link v-if="link.parent === item.id" v-text="link.name"
                          :class="{ active: link.name === page}"
                          :href="'/help/' + item.name + '/' + link.name"></Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.menu-container {
    background-color: $mantle;
    width: 250px;
    padding: 10px;
    border-radius: 6px;

    p {
        margin: 0;
        padding: 2px;
    }
}

a {
    font-size: 0.9em;
}

.section {
    font-size: 0.9em;
    color: $subtext0;
}

.indent {
    padding-left: 10px;
}

.active {
    color: $sky;
}


</style>
