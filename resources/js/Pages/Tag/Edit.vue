<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TagForm from "./_partials/TagForm.vue";

const props = defineProps({
    tag: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Create tag" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Create tag
            </h2>
        </template>

        <TagForm :tag="props.tag" />
    </AuthenticatedLayout>
</template>
