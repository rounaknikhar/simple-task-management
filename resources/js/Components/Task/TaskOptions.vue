<script setup>
import { usePage } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Link, router } from '@inertiajs/vue3';
import DeleteTask from '@/Pages/Task/_partials/DeleteTask.vue';

import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

defineProps({
    task: Object,
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
    <Menu as="div" class="relative inline-block text-left">
        <MenuButton>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </MenuButton>

        <transition enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                    <button href="#" class="w-full text-left" @click="handleTaskStatus(task.id)"
                        :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                        {{
                            !task.complete
                                ? "Completed"
                                : "Pending"
                        }}
                    </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <Link :href="route('tasks.edit', { task: task.id })"
                        :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                    Edit</Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <DeleteTask simpleLink :taskId="task.id" :active="active" />
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
