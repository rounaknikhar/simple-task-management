<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import DeleteTask from "./_partials/DeleteTask.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import AssignedTagPill from "./_partials/AssignedTagPill.vue";

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
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Task # {{ task.id }}
            </h2>
        </template>
        <div class="my-4 mr-6 flex justify-end">
            <PrimaryLink
                :href="route('tasks.edit', { task: task.id })"
            >
                Edit
            </PrimaryLink>
            <DeleteTask :taskId="task.id" class="ml-2"/>
        </div>
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="flex flex-col md:flex-row">
                        <div
                            class="w-full p-4 bg-white rounded-lg sm:p-6 md:p-8 dark:bg-gray-800"
                        >
                            <span
                                class="mb-4 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full"
                                :class="
                                    task.complete
                                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                        : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'"
                            >
                                {{ task.complete ? "Completed" : "Pending" }}
                            </span>
                            <h2
                                class="text-gray-900 dark:text-white text-2xl md:text-3xl font-extrabold mb-2"
                            >
                                {{ task.name }}
                            </h2>
                            <p
                                class="mb-0 text-lg font-normal text-gray-500 dark:text-gray-400"
                            >
                                {{ task.description }}
                            </p>
                        </div>
                        <div class="w-full p-4 bg-white rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 sm:w-[300px]">
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

                <div
                    class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Manage tags</h3>
                        <div class="mt-4">
                            <div class="w-full">
                                <div class="p-3 max-h-[400px] min-h-[200px] overflow-y-auto card rounded-sm shadow-md w-full m-1">
                                    <h4 class="text-md font-semibold my-2">Assigned tags</h4>
                                    <div class="flex flex-row flex-wrap">
                                        <AssignedTagPill
                                        v-if="task.tags.length > 0"
                                            v-for="tag in task.tags"
                                            :name="tag.name"
                                            :hideActionButton="true"
                                        />
                                        <span v-else class="text-sm text-gray-400">
                                            No tag has been assigned to this task
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
