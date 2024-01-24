<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-vh-100 bg-light dark-bg-dark">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark dark-bg-dark border-bottom border-light dark-border-dark" style="color: white">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" :href="route('dashboard')">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :href="route('salas.ver')">Ver Salas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :href="route('sala.nuevo')">Crear Salas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :href="route('pelicula.nuevo')">Crear Pelicula</a>
                            </li>
                        </ul>
                    </div>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p style="color:rgb(216, 25, 25)">{{ $page.props.auth.user.name }}</p>
                                <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" :href="route('profile.edit')">Perfil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" :href="route('logout')" method="post">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <header class="dark-bg-dark shadow" v-if="$slots.header">
            </header>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
