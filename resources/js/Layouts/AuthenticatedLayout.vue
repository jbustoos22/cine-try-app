<script setup>
import { ref } from "vue";

import { usePage } from "@inertiajs/vue3";

const showingDropdown = ref(false);
const { props } = usePage();

// Accede a la información de sesión del usuario desde las propiedades proporcionadas por Inertia
const user = props.auth.user;

// Comprueba si el usuario es administrador
const isAdmin = ref(user.rango === "Administrador");
</script>

<template>
    <div>
        <div class="min-vh-100 bg-dark dark-bg-dark">
            <nav
                class="navbar navbar-expand-lg navbar-dark dark-border-dark"
                style="color: white; background-color: black;"
            >
                <div class="container">
                    <div
                        class="collapse navbar-collapse justify-content-start"
                        id="navbarNav"
                    >
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" :href="route('salas.ver')"
                                    >🏯Inicio</a
                                >
                            </li>
                            <li v-if="isAdmin" class="nav-item">
                                <a
                                    class="nav-link"
                                    :href="route('pelicula.admin')"
                                    >🍿Administrar Peliculas</a
                                >
                            </li>
                            <li v-if="isAdmin" class="nav-item">
                                <a class="nav-link" :href="route('sala.admin')"
                                    >🚪Administrar Salas</a
                                >
                            </li>
                            <li v-if="isAdmin" class="nav-item">
                                <a class="nav-link" :href="route('comment.index')"
                                    >💭Administrar Posts</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            @click="showingDropdown = !showingDropdown"
                            >
                            🧑🏻{{ $page.props.auth.user.name }}
                        </a>
                        <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdown"
                                :class="{ show: showingDropdown }"
                            >
                                <li>
                                    <a
                                        class="dropdown-item"
                                        :href="route('profile.edit')"
                                        >🖋️Perfil</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        :href="route('logout')"
                                        method="post"
                                        >✖️Cerrar Sesión</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <header class="dark-bg-dark shadow" v-if="$slots.header"></header>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
<style>
.nav-link {
    color: white;
}
</style>
