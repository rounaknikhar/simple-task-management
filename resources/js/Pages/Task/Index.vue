<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, Head, usePage, useForm, WhenVisible } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import TaskCard from "@/Components/Task/TaskCard.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, watch } from 'vue';

const page = usePage();

defineProps({
    tasks: {
        type: Object,
    },
});

const searchForm = useForm({
    search: ''
});

watch(searchForm, (value) => {
    router.get(route("tasks.index"), { search: value.search }, { preserveState: true });
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
                    <div class="my-4 mr-4 flex justify-between">
                        <!-- Search -->
                        <form class="mx-0 mb-4">
                            <div class="w-full flex flex-row align-middle justify-center">
                                <TextInput id="search" type="text" placeholder="Search a task..." class="py-1 w-full"
                                    v-model="searchForm.search" autofocus />
                            </div>
                        </form>
                        <!-- Add task -->
                        <div class="ms-4">
                            <PrimaryLink :href="route('tasks.create')">
                                Add task
                            </PrimaryLink>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <div class="flex flex-row flex-wrap">
                            <WhenVisible :data="tasks">
                                <template #fallback>
                                    <div class="flex justify-center align-middle w-full h-screen">
                                        <img src="/loading.gif" alt="loading" class="w-auto h-[200px]">
                                    </div>
                                </template>
                                <!-- Task card -->
                                <TaskCard v-for="task in tasks" :task="task" />
                            </WhenVisible>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
