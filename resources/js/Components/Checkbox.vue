<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
        class="rounded text-stone-600 shadow-sm border-stone-700 bg-stone-900 focus:ring-stone-600 focus:ring-offset-stone-800" />
</template>
