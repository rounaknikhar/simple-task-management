<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring-zinc-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-zinc-600 dark:focus:ring-zinc-600"
        v-model="model"
        ref="input"
    />
</template>
