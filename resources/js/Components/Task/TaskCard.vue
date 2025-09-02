<script setup>
import TaskOptions from './TaskOptions.vue';
import PrimaryLink from '../PrimaryLink.vue';

defineProps({
    task: Object,
});
</script>
<template>
    <div class="w-[286px] h-[200px] border shadow-lg m-2">
        <div class="flex flex-col h-full w-full justify-between">
            <div class="flex flex-row justify-between align-middle" :class="task.complete
                ? 'bg-gradient-to-r from-[#1e3a2d] to-[#185c3c] text-white'
                : 'bg-gradient-to-r from-[#897966] to-stone-500 text-white'">
                <span class="px-3 py-1 mt-2">
                    {{
                        task.complete
                            ? "Completed"
                            : "Pending"
                    }}
                </span>
                <TaskOptions :task="task" class="px-3 py-1 mt-2" />
            </div>
            <div class="flex-grow bg-white p-3">{{ task.name }}</div>
            <div class="py-2 px-4 flex justify-end w-full">
                <PrimaryLink :href="route('tasks.show', { task: task.id })" :class="task.complete
                    ? 'bg-gradient-to-r from-[#1e3a2d] to-[#185c3c] text-white hover:opacity-90'
                    : 'bg-gradient-to-r from-[#897966] to-stone-500 text-white hover:opacity-90'">
                    View
                </PrimaryLink>
            </div>
        </div>
    </div>
</template>