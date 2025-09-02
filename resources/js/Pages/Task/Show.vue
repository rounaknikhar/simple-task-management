<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import DeleteTask from "./_partials/DeleteTask.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";

defineProps({
    task: {
        type: Object,
    },
});
</script>

<template>

    <Head title="Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-stone-200">
                Task # {{ task.id }}
            </h2>
        </template>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="my-4 flex justify-end">
                <PrimaryLink :href="route('tasks.edit', { task: task.id })">
                    Edit
                </PrimaryLink>
                <DeleteTask :taskId="task.id" class="ml-2" />
            </div>
        </div>
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-stone-800">
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full p-4 rounded-lg sm:p-6 md:p-8 bg-stone-800">
                            <span class="mb-4 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full" :class="task.complete
                                ? 'bg-green-100 text-green-800 '
                                : 'bg-yellow-100 text-yellow-800 '">
                                {{ task.complete ? "Completed" : "Pending" }}
                            </span>
                            <h2 class="text-stone-100 text-2xl md:text-3xl font-extrabold mb-2">
                                {{ task.name }}
                            </h2>
                            <p class="mb-0 text-lg font-normal text-stone-400">
                                {{ task.description }}
                            </p>
                        </div>
                        <div class="w-full p-4rounded-lg sm:p-6 md:p-8 bg-stone-800 text-stone-100 sm:w-[300px]">
                            <div class="mb-4">
                                <span class="block text-md font-semibold">Date created</span>
                                <span class="block text-sm">{{ task.created_at }}</span>
                            </div>
                            <div class="mb-4">
                                <span class="block text-md font-semibold">Created by</span>
                                <span class="block text-sm">{{ task.user.name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
