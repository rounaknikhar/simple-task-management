<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import TaskCard from "@/Components/Task/TaskCard.vue";

const page = usePage();

defineProps({
    tasks: {
        type: Object,
    },
});
</script>
<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                My Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="overflow-hidden pb-4">
                    <div class="my-4 mr-4 flex justify-end">
                        <PrimaryLink class="ms-4" :href="route('tasks.create')">
                            Add task
                        </PrimaryLink>
                    </div>
                    <div class="relative overflow-x-auto">
                        <div class="flex flex-row flex-wrap">
                            <!-- Task card -->
                            <TaskCard v-for="task in tasks.data" :task="task" />
                        </div>
                    </div>
                </div>
            </div>

            <pagination :pagination="tasks" />
        </div>
    </AuthenticatedLayout>
</template>
