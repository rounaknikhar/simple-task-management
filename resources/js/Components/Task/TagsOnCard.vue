<script setup>
defineProps({
    tags: Object,
});
</script>
<template>
    <div class="flex flex-row flex-wrap">
        <span class="text-sm m-1 bg-neutral-300 rounded-md p-1" v-for="tag in tags">#{{ tag.name }}</span>
    </div>
</template>