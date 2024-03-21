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
    <Head :title="'Adicionar Post de Instagram'" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <h2 class="mt-5 mb-4 text-center">
                    Agregar post de instagram a película
                </h2>

                <div class="row">
                    <form @submit.prevent="submit">
                        <div class="col-sm-3 m-auto">
                            <label for="pelicula_id" class="form-label"
                                >Seleccione película:</label
                            >
                            <select
                                name="pelicula_id"
                                id="pelicula_id"
                                class="form-select"
                                v-model="comment.pelicula_id"
                                required
                            >
                            <option disabled>Seleccione una opción</option>
                                <option
                                    v-for="pelicula in peliculas"
                                    :value="pelicula.id"
                                    :key="pelicula.id"
                                >
                                    {{pelicula.id + ' - ' + pelicula.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-3 m-auto">
                            <label for="id_pelicula" class="form-label"
                                >Codigo HTML:</label
                            >
                            <input
                                id="html_code"
                                type="text"
                                class="form-control"
                                v-model="comment.html_code"
                                required
                            />
                        </div>

                        <div class="col-sm-3 mt-3 mb-3 m-auto">
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            comment: {
                pelicula_id: "Seleccione una opción",
                html_code: "",
            },
            form: {
                processing: false,
            },
            peliculas: [],
        };
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/obtainPeliculas")
            .then((response) => {
                this.peliculas = response.data.peliculas;
            })
            .catch((error) => {
                console.error("Error al obtener las películas:", error);
            });
    },
    methods: {
        submit() {
            this.form.processing = true;
            // Aquí puedes enviar la solicitud utilizando Inertia.js, por ejemplo
            this.$inertia
                .post(route("comment.crear"), this.comment)
                .then(() => {
                    this.form.processing = false;
                    // Realizar cualquier otra acción luego de enviar el formulario
                });
        },
    },
};
</script>
