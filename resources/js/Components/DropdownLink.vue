<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 transition duration-150 ease-in-outfocus:outline-none text-stone-300 hover:bg-stone-800 focus:bg-stone-800">
    <slot />
    </Link>
</template>
