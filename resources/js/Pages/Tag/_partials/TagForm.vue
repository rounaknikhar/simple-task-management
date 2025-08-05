<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Input from "@/Components/Input.vue";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();

const props = defineProps({
    tag: {
        type: Object,
        default: null
    },
});

const form = useForm({
    name: props.tag?.name ?? "",
});

const tagRoute = ref(
    {
        source:
            props.tag === null
                ? route('tags.store')
                : route('tags.edit', { tag: props.tag?.id })
    }
);

const submit = () => {
    form.post(tagRoute.value.source, {
        preserveScroll: true,
        onSuccess: () => toast.success(page.props.flash.message),
    });
};
</script>
<template>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="w-full p-4 bg-white rounded-lg sm:p-6 md:p-8 dark:bg-gray-800">
                    <form @submit.prevent="submit" class="mx-0">
                        <div class="mb-4">
                            <InputLabel for="name" value="Name" />
                            <Input id="name" type="name" class="mt-1 block w-full py-3 px-2 border"
                                v-model="form.name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4 flex justify-end">
                            <PrimaryButton class="ms-4" :class="{
                                'opacity-25': form.processing,
                            }" :disabled="form.processing">
                                {{ props.tag === null
                                    ? 'Create'
                                    : 'Update'
                                }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
