<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center rounded-md border border-stone-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-stone-700 shadow-sm transition duration-150 ease-in-out hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 disabled:opacity-25 dark:border-stone-500 dark:bg-stone-800 dark:text-stone-300 dark:hover:bg-stone-700 dark:focus:ring-offset-stone-800">
        <slot />
    </button>
</template>
