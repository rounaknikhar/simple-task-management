<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import DangerButton from "@/Components/DangerButton.vue";
import DeleteTask from "./_partials/DeleteTask.vue";

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
        })
    );
    // Display the success message by deafult.
    toast.success(page.props.flash.message ?? 'Task status updated');
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
                        class="relative overflow-x-auto shadow-md"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
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
                                    v-if="tasks.total > 0"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                                    v-for="task in tasks.data"
                                >
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input
                                                @change="handleTaskStatus(task.id)"
                                                :checked="task.complete"
                                                type="checkbox"
                                                class="cursor-pointer w-4 h-4 text-zinc-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-zinc-500 dark:focus:ring-zinc-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
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
                                        :class="task.complete ? 'line-through': ''"
                                    >
                                        <Link :href="route('tasks.show', {task: task.id})" class="underline hover:text-gray-400 transition duration-150 ease-in-out">{{ task.name }}</Link>
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
                                        <PrimaryLink
                                            :href="route('tasks.edit', {task: task.id})"
                                            >Edit
                                        </PrimaryLink>

                                        <DeleteTask :taskId="task.id"/>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="p-4 text-center">
                                        <span class="text-sm">Your task list is empty</span>
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
