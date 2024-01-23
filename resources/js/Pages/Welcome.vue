<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 text-end">
                <!-- Right-aligned content -->
                <!-- Use Bootstrap buttons for the links -->
                <!-- Replace Link component with anchor tags -->
                <a v-if="$page.props.auth.user" :href="route('dashboard')" class="btn btn-primary me-4">Dashboard</a>
                <a v-else :href="route('login')" class="btn btn-primary me-4">Log in</a>
                <a v-if="canRegister" :href="route('register')" class="btn btn-secondary">Register</a>
            </div>
        </div>

        <!-- Content section -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- Card component for documentation link -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Documentation</h5>
                        <p class="card-text">
                            Laravel has wonderful documentation covering every aspect of the framework. Whether you
                            are a newcomer or have prior experience with Laravel, we recommend reading our
                            documentation from beginning to end.
                        </p>
                        <a href="https://laravel.com/docs" class="btn btn-primary">Go to Documentation</a>
                    </div>
                </div>
            </div>
            <!-- Repeat card component for other links -->
            <!-- ... -->
        </div>

        <!-- Footer section -->
        <div class="row mt-5">
            <div class="col-sm-6">
                <!-- Laravel version info -->
                <p class="text-end">Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})</p>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
