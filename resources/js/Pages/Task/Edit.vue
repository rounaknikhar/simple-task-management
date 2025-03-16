<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps({
    task: {
        type: Object,
    },
});

const page = usePage();

const form = useForm({
    name: props.task?.name,
    description: props.task?.description,
    complete: props.task?.complete
});

const submit = () => {
    form.patch(route("tasks.update", {task: props.task?.id}), {
        preserveScroll: true,
        onSuccess: () => toast.success(page.props.flash.message),
    });
};
</script>

<template>
    <Head title="Update task" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Update task
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div
                        class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
                    >
                        <form @submit.prevent="submit" class="mx-0">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="name"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="description"
                                    value="Description"
                                />
                                <Textarea
                                    id="description"
                                    type="description"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.description"
                                />
                            </div>
                            <div class="flex items-center">
                                <input
                                    :checked="form.complete"
                                    v-model="form.complete"
                                    type="checkbox"
                                    class="mr-4 my-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label
                                    for="checkbox-table-search-1"
                                >
                                {{
                                    form.complete
                                        ? "Completed"
                                        : "Pending"
                                }}
                                </label>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <PrimaryButton
                                    class="ms-4"
                                    :class="{
                                        'opacity-25': form.processing,
                                    }"
                                    :disabled="form.processing"
                                >
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
