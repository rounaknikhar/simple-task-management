<template>
    <div>
        <PrimaryButton @click="open = true">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
        </PrimaryButton>
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                            <TransitionChild as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full" enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                                    <TransitionChild as="template" enter="ease-in-out duration-500"
                                        enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500"
                                        leave-from="opacity-100" leave-to="opacity-0">
                                        <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                                            <button type="button"
                                                class="relative rounded-md text-gray-300 hover:text-white focus-visible:ring-2 focus-visible:ring-white focus-visible:outline-hidden"
                                                @click="open = false">
                                                <span class="absolute -inset-2.5" />
                                                <span class="sr-only">Close panel</span>
                                                <XMarkIcon class="size-6" aria-hidden="true" />
                                            </button>
                                        </div>
                                    </TransitionChild>
                                    <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                                        <div class="px-4 sm:px-6">
                                            <DialogTitle class="text-base font-semibold text-gray-900">Filter
                                            </DialogTitle>
                                        </div>
                                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                            <div class="mx-4">
                                                <p class="text-md pb-2">Status</p>
                                                <div class="flex flex-row align-middle justify-start">
                                                    <input type="checkbox" name="complete" id="complete"
                                                        class="rounded border-gray-300 text-zinc-600 shadow-sm focus:ring-zinc-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-zinc-600 dark:focus:ring-offset-gray-800" />
                                                    <label for="complete" class="ml-2 cursor-pointer">Complete</label>
                                                </div>
                                                <div class="flex">
                                                    <input type="checkbox" name="pending" id="pending"
                                                        class="mt-1 rounded border-gray-300 text-zinc-600 shadow-sm focus:ring-zinc-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-zinc-600 dark:focus:ring-offset-gray-800" />
                                                    <label for="pending" class="ml-2 cursor-pointer">Pending</label>
                                                </div>
                                                <p class="text-md pt-4 pb-2">Search</p>
                                                <form @submit.prevent="searchSubmit" class="mx-0 mb-4">
                                                    <div class="w-full flex flex-row align-middle justify-center">
                                                        <TextInput id="search" type="text" class="py-1 w-full"
                                                            v-model="searchForm.search" autofocus />
                                                        <PrimaryButton type="submit" class="ml-2">Search</PrimaryButton>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import PrimaryButton from '../PrimaryButton.vue'
import TextInput from '../TextInput.vue'
import { useForm } from '@inertiajs/vue3'

const open = ref(false)

const searchForm = useForm({
    search: ''
});

const searchSubmit = () => {
    searchForm.get(route("tasks.index"), {
        preserveScroll: true,
    });
};
</script>