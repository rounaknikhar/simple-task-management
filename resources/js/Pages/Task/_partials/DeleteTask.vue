<script setup>
import { router, usePage } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    taskId: {
        type: Number,
    },
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
    <DangerButton @click="deleteTask" class="mt-1 sm:ml-1 sm:mt-0">
        Delete
    </DangerButton>
</template>
