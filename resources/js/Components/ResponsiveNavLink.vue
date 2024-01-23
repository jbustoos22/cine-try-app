<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(
    () =>
        props.active
            ? "btn btn-indigo-400" // Reemplaza las clases de Tailwind con las clases de Bootstrap
            : "btn btn-outline-secondary" // Reemplaza las clases de Tailwind con las clases de Bootstrap
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
