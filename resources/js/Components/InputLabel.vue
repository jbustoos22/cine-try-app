<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="font-weight-normal small text-muted">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
