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
    <Head title="Bienvenido" />

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark dark-bg-dark border-bottom border-light dark-border-dark" style="color: white">
            <div class="container">
                <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
                    <div class="ms-auto">
                        <ul class="navbar-nav" style="color: white">
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Iniciar sesion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Registrar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Content section -->
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Bienvenido!</h2>
            </div>
            <div class="card-body">
                <h3 class="text-center">Inicie sesión o si no tiene una cuenta activa en nuestro cine <a href="/register">Registrese</a></h3>
            </div>
        </div>

        <!-- Footer section -->
        
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

.nav-link {
    color:white;
}
</style>
