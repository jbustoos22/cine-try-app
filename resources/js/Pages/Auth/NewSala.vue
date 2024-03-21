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
                <h1 class="mt-5 mb-4">Registro de Sala de Cine</h1>

                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="numero" class="form-label"
                            >Numero de la Sala</label
                        >
                        <input
                            id="numero"
                            type="text"
                            class="form-control"
                            v-model="sala.numero"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label"
                            >Tipo de Sala</label
                        >
                        <input
                            id="tipo"
                            type="number"
                            class="form-control"
                            v-model="sala.tipo"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="aforo" class="form-label">Aforo</label>
                        <input
                            id="aforo"
                            type="text"
                            class="form-control"
                            v-model="sala.aforo"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="desde" class="form-label">Desde</label>
                        <input
                            id="desde"
                            type="datetime-local"
                            class="form-control"
                            v-model="sala.desde"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="hasta" class="form-label">Hasta</label>
                        <input
                            id="hasta"
                            type="datetime-local"
                            class="form-control"
                            v-model="sala.hasta"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="id_pelicula" class="form-label"
                            >Seleccione la película:</label
                        >
                        <select
                            id="id_pelicula"
                            class="form-select"
                            v-model="sala.id_pelicula"
                            required
                        >
                            <option
                                v-for="pelicula in peliculasDisponibles"
                                :key="pelicula.id"
                                :value="pelicula.id"
                            >
                                {{ pelicula.nombre }}
                            </option>
                        </select>
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
            peliculasDisponibles: [],
            sala: {
                numero: "",
                tipo: null,
                aforo: "",
                desde: "",
                hasta: "",
                id_pelicula: "",
            },
            form: {
                processing: false,
            },
        };
    },
    mounted() {
        this.obtenerPeliculas(); // Llama a la función para obtener las películas al cargar el componente
    },
    methods: {
        submit() {
            this.form.processing = true;
            // Aquí puedes enviar la solicitud utilizando Inertia.js, por ejemplo
            this.$inertia.post(route("sala.crear"), this.sala).then(() => {
                this.form.processing = false;
                // Realizar cualquier otra acción luego de enviar el formulario
            });
        },
        // Función para obtener las películas disponibles desde el endpoint
        async obtenerPeliculas() {
            try {
                const response = await axios.get(
                    "http://127.0.0.1:8000/obtainPeliculas"
                );
                // Almacena las películas disponibles en una variable del componente
                this.peliculasDisponibles = response.data.peliculas;
            } catch (error) {
                console.error("Error al obtener las películas", error);
            }
        },
    },
};
</script>
