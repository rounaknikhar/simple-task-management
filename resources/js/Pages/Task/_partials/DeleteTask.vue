<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import DangerButton from "@/Components/DangerButton.vue";

const page = usePage();

const props = defineProps({
    taskId: {
        type: Object,
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
    <DangerButton @click="deleteTask" class="mt-1 md:ml-1 md:mt-0">
        Delete
    </DangerButton>
</template>
