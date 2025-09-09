<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center  pt-6 sm:justify-center sm:pt-0 bg-stone-900">
        <div>
            <Link href="/">
            <ApplicationLogo class="h-20 w-20 fill-current text-stone-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg bg-stone-800">
            <slot />
        </div>
    </div>
</template>
