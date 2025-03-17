<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import DeleteTag from "./_partials/DeleteTag.vue";

const page = usePage();

defineProps({
    tags: {
        type: Object,
    },
});
</script>
<template>
    <Head title="Tags" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tags
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="my-4 mr-4 flex justify-end">
                        <PrimaryLink class="ms-4" :href="route('tags.create')">
                            Add tag
                        </PrimaryLink>
                    </div>
                    <div
                        class="relative overflow-x-auto shadow-md"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-2/3">Tag</th>
                                    <th scope="col" class="px-6 py-3 w-1/3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-if="tags.total > 0"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                                    v-for="tag in tags.data"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ tag.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <PrimaryLink
                                            :href="route('tags.edit', {tag: tag.id})"
                                            >Edit
                                        </PrimaryLink>

                                        <DeleteTag :tagId="tag.id"/>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="2" class="p-4 text-center">
                                        <span class="text-sm">Your tag list is empty</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <pagination :pagination="tags" />
        </div>
    </AuthenticatedLayout>
</template>
