<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, Head, usePage, useForm, WhenVisible } from "@inertiajs/vue3";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import TaskCard from "@/Components/Task/TaskCard.vue";
import Input from "@/Components/Input.vue";
import { watch } from 'vue';
const page = usePage();

defineProps({
    tasks: {
        type: Object,
    },
    groupedTasks: {
        type: Object,
    }
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
            <h2 class="text-xl font-semibold leading-tight text-stone-200">
                My Tasks
            </h2>
        </template>
        <div class="pb-12 h-full">
            <div
                class="mb-4 mx-auto max-w-7xl sm:px-6 lg:px-8 backdrop-filter backdrop-blur-md bg-opacity-20 sticky top-0 z-10 border-b border-stone-600">
                <div class=" mr-4 flex align-middle justify-between">
                    <!-- Search -->
                    <form class="mx-0 mb-4 mt-4 ml-4 md:ml-0">
                        <div class="w-full flex flex-row align-middle justify-center">
                            <Input id="search" type="text" placeholder="Search a task..."
                                class="py-1 w-full bg-stone-700 text-stone-900 border-stone-400 placeholder-stone-500 placeholder-opacity-75"
                                v-model="searchForm.search" autofocus />
                        </div>
                    </form>
                    <!-- Add task -->
                    <div class="ms-4 mt-4">
                        <PrimaryLink :href="route('tasks.create')">
                            Add task
                        </PrimaryLink>
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden pb-4">
                    <div class="relative overflow-x-auto mb-4" v-for="(groupedTask, index) in groupedTasks">
                        <div
                            class="block backdrop-blur-md bg-stone-600 text-stone-300 px-2 py-4 rounded-md shadow-lg w-[90px] mx-2 mb-4 text-center">
                            <span class="text-sm block text-stone-400">
                                {{
                                    new Date(index).toLocaleString('default', {
                                        weekday: 'long'
                                    })
                                }}
                            </span>
                            <span class="text-2xl block">
                                {{
                                    new Date(index).getDate()
                                }}
                            </span>
                            <span class="text-sm block text-stone-400">
                                {{
                                    new Date(index).toLocaleString('default', {
                                        month: 'long'
                                    })
                                }}
                            </span>
                        </div>
                        <div class="flex flex-row flex-wrap">
                            <WhenVisible :data="groupedTask">
                                <template #fallback>
                                    <div class="flex justify-center align-middle w-full h-screen">
                                        <img src="/spinner.gif" alt="loading" class="w-auto h-[50px]">
                                    </div>
                                </template>
                                <!-- Task card -->
                                <TaskCard v-for="task in groupedTask" :task="task" />
                            </WhenVisible>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
