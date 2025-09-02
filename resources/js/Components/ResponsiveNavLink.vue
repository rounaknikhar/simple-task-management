<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-stone-400 dark:border-stone-600 text-start text-base font-medium text-stone-700 dark:text-stone-300 bg-stone-50 dark:bg-stone-900/50 focus:outline-none focus:text-stone-800 dark:focus:text-stone-200 focus:bg-stone-100 dark:focus:bg-stone-900 focus:border-stone-700 dark:focus:border-stone-300 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-stone-600 dark:text-stone-400 hover:text-stone-800 dark:hover:text-stone-200 hover:bg-stone-50 dark:hover:bg-stone-700 hover:border-stone-300 dark:hover:border-stone-600 focus:outline-none focus:text-stone-800 dark:focus:text-stone-200 focus:bg-stone-50 dark:focus:bg-stone-700 focus:border-stone-300 dark:focus:border-stone-600 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
