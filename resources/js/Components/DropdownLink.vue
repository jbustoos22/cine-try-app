<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <a
        :href="href"
        class="d-block w-100 px-4 py-2 text-start text-sm text-gray-700 dark-text-gray-300 hover-bg-gray-100 dark-hover-bg-gray-800 focus-outline-none focus-bg-gray-100 dark-focus-bg-gray-800 transition duration-150 ease-in-out"
        role="button"
    >
        <slot />
    </a>
</template>
