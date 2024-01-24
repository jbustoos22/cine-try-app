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
    <Head :title="'Registro'" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Registro de Película</h1>

                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
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
                        <input
                            id="genero"
                            type="text"
                            class="form-control"
                            v-model="pelicula.genero"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="clase" class="form-label">Clase</label>
                        <input
                            id="clase"
                            type="text"
                            class="form-control"
                            v-model="pelicula.clase"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label"
                            >Descripción</label
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
                        <input
                            id="idioma"
                            type="text"
                            class="form-control"
                            v-model="pelicula.idioma"
                            required
                        />
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
