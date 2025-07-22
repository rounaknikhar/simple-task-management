<script setup>
import { router, usePage, Link } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    taskId: {
        type: Number,
    },
    simpleLink: {
        type: Boolean,
        default: false
    },
    active: {
        type: Boolean,
        default: false
    }
});

const deleteTask = () => {
    router.delete(
        route("tasks.destroy", {
            task: props.taskId,
        })
    );
    // Display the success message by deafult.
    toast.success(page.props.flash.message ?? "Task has been deleted");
};
</script>

<template>
    <button class="w-full text-left"
        :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden' : 'text-gray-700', 'block px-4 py-2 text-sm']"
        v-if="simpleLink" @click="deleteTask">
        Delete
    </button>
    <DangerButton @click="deleteTask" class="mt-1 sm:ml-1 sm:mt-0" v-else>
        Delete
    </DangerButton>
</template>
