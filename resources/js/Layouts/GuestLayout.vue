<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="d-flex min-vh-100 flex-column justify-content-center align-items-center pt-6 pt-sm-0 bg-light"
    >
        <div>
            <a href="/">
                <ApplicationLogo class="img-fluid logo-custom-class" />
            </a>
        </div>

        <div class="w-35 max-w-md mt-6 px-4 py-3 bg-white shadow-sm rounded">
            <slot />
        </div>
    </div>
</template>
