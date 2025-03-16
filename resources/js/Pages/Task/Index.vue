<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

defineProps({
    tasks: {
        type: Object,
    },
});

const handleTaskStatus = (taskId) => {
    router.post(
        route("handle.task.status", {
            task: taskId,
        }),
        {
            preserveScroll: true,
        }
    );

    // Bug to check: on first submission,
    // doesn't display success message, even though
    // the message has been correctly passing through.
    // But the second onwards, displaying mesage correctly.
    toast.success(page.props.flash.message);
};
</script>
<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="my-4 mr-4 flex justify-end">
                        <PrimaryLink class="ms-4" :href="route('tasks.create')">
                            Add task
                        </PrimaryLink>
                    </div>
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="p-4"></th>
                                    <th scope="col" class="px-6 py-3">Task</th>
                                    <th scope="col" class="px-6 py-3">
                                        Created
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    v-for="task in tasks.data"
                                >
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input
                                                @change="handleTaskStatus(task.id)"
                                                :checked="task.complete"
                                                type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label
                                                for="checkbox-table-search-1"
                                                class="sr-only"
                                            >
                                                Status
                                            </label>
                                        </div>
                                    </td>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ task.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ task.created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-xs font-medium me-2 px-2.5 py-0.5 rounded-full"
                                            :class="
                                                task.complete
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                                    : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'"
                                        >
                                            {{
                                                task.complete
                                                    ? "Completed"
                                                    : "Pending"
                                            }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link
                                            :href="route('tasks.edit', {task: task.id})"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <pagination :pagination="tasks" />
        </div>
    </AuthenticatedLayout>
</template>
