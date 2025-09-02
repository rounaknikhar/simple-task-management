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
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-stone-400 border-stone-600 text-sm font-medium leading-5 text-stone-900 text-stone-100 focus:outline-none focus:border-stone-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-stone-500 text-stone-400 hover:text-stone-700 hover:text-stone-300 hover:border-stone-300 hover:border-stone-700 focus:outline-none focus:text-stone-700 focus:text-stone-300 focus:border-stone-300 focus:border-stone-700 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
