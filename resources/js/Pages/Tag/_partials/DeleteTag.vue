<script setup>
import { router, usePage } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    tagId: {
        type: Number,
    },
});

const deleteTag = () => {
    router.delete(
        route("tags.destroy", {
            tag: props.tagId,
        })
    );
    // Display the success message by deafult.
    toast.success(page.props.flash.message ?? "Tag has been deleted");
};
</script>

<template>
    <DangerButton @click="deleteTag" class="mt-1 md:ml-1 md:mt-0">
        Delete
    </DangerButton>
</template>
