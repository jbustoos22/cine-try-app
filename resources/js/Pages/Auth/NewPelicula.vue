<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import axios from "axios";
</script>

<template>
    <Head :title="'Crear Película'" />
    <div class="container bg-light">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Registro de Película</h1>

                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Película</label>
                        <input
                            id="nombre"
                            type="text"
                            class="form-control"
                            v-model="pelicula.nombre"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select
                            id="genero"
                            class="form-select"
                            v-model="pelicula.genero"
                            required
                        >
                            <option>Acción</option>
                            <option>Aventura</option>
                            <option>Animación</option>
                            <option>Comedia</option>
                            <option>Crimen</option>
                            <option>Documental</option>
                            <option>Drama</option>
                            <option>Familia</option>
                            <option>Fantasía</option>
                            <option>Historia</option>
                            <option>Terror</option>
                            <option>Misterio</option>
                            <option>Romance</option>
                            <option>Ciencia ficción</option>
                            <option>Suspenso</option>
                            <option>Guerra</option>
                            <option>Occidental</option>
                            <option>Música</option>
                            <option>Thriller</option>
                            <option>Otros</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="clase" class="form-label">Clase</label>
                        <select
                            id="clase"
                            class="form-select"
                            v-model="pelicula.clase"
                            required
                        >
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label"
                            >Sinópsis</label
                        >
                        <input
                            id="descripcion"
                            type="text"
                            class="form-control"
                            v-model="pelicula.descripcion"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="idioma" class="form-label">Idioma</label>
                        <select
                            id="idioma"
                            class="form-select"
                            v-model="pelicula.idioma"
                            required
                        >
                            <option value="Español">Español</option>
                            <option value="Inglés">Inglés</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input
                            type="file"
                            class="form-control"
                            ref="imagen"
                            @change="onFileChange"
                            accept="image/*"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label"
                            >Código de color</label
                        >
                        <input
                            id="color"
                            type="text"
                            class="form-control"
                            v-model="pelicula.color"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Registrar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pelicula: {
                nombre: "",
                genero: "",
                clase: "",
                descripcion: "",
                idioma: "",
                imagen: null,
                color: '',
            },
            form: {
                processing: false,
            },
        };
    },
    methods: {
        onFileChange(e) {
            this.pelicula.imagen = e.target.files[0];
        },
        submitForm() {
            this.form.processing = true;

            this.$inertia
                .post(route("pelicula.crear"), this.pelicula)
                .then(() => {
                    this.form.processing = false;
                });
        },
    },
};
</script>
