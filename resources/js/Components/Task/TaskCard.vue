<script setup>
import PrimaryLink from '../PrimaryLink.vue';
import DeleteTask from '@/Pages/Task/_partials/DeleteTask.vue';
import TaskOptions from './TaskOptions.vue';

defineProps({
    task: Object,
});
</script>
<template>
    <div class="w-[300px] h-[300px] border shadow-lg m-1">
        <div class="flex flex-col h-full w-full justify-between">
            <div class="flex flex-row justify-between align-middle" :class="task.complete
                ? 'bg-green-700 text-white'
                : 'bg-orange-400 text-white'">
                <span class="px-3 py-1 mt-2">
                    {{
                        task.complete
                            ? "Completed"
                            : "Pending"
                    }}
                </span>
                <TaskOptions :task="task" class="px-3 py-1 mt-2" />
            </div>

            <div class=" flex-grow bg-white p-3">{{ task.name }}</div>
        </div>
    </div>
</template>