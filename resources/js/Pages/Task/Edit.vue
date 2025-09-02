<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref } from 'vue';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps({
    task: {
        type: Object,
    }
});

const statusCheckedState = ref({
    complete: Boolean(props.task?.complete)
});

const page = usePage();

const form = useForm({
    name: props.task?.name,
    description: props.task?.description,
    complete: statusCheckedState.value.complete,
    due_by: props.task?.due_by
});

const submit = () => {
    form.patch(route("tasks.update", { task: props.task?.id }), {
        preserveScroll: true,
        onSuccess: () => toast.success(page.props.flash.message),
    });
};
</script>

<template>

    <Head title="Update task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-stone-200">
                Update task
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-stone-800">
                    <div class="w-full p-4 rounded-lg sm:p-6 md:p-8 bg-stone-800">
                        <form @submit.prevent="submit" class="mx-0">
                            <div class="mb-4">
                                <InputLabel for="name" value="Name" />
                                <Input id="name" type="name" class="mt-1 block w-full py-3 px-2 border"
                                    v-model="form.name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <InputLabel for="description" value="Description" />
                                <Textarea id="description" type="description" class="mt-1 block w-full"
                                    v-model="form.description" />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div>
                                <InputLabel for="due_by" value="Due date" />
                                <Input type="date" name="due_by" id="due_by" v-model="form.due_by"
                                    class="mt-1 block w-full py-3 px-2 border" />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" v-model="form.complete"
                                    class="mr-4 my-4 w-4 h-4 text-stone-600 rounded-sm ring-offset-stone-800 focus:ring-offset-stone-800 focus:ring-2 bg-stone-700 border-stone-600" />
                                <label for="checkbox-table-search-1" class="text-stone-100">
                                    {{
                                        form.complete
                                            ? "Completed"
                                            : "Pending"
                                    }}
                                </label>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <PrimaryButton class="ms-4" :class="{
                                    'opacity-25': form.processing,
                                }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
