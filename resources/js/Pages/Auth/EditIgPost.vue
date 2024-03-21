<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, usePage, useForm } from "@inertiajs/vue3";
import axios from "axios";
const { comment } = usePage().props;
const form = useForm({
    pelicula_id: comment.pelicula_id,
    html_code: comment.html_code,
});
const submitForm = async () => {
    form.processing = true;

    try {
        const formData = new FormData();
        formData.append('pelicula_id', form.pelicula_id);
        formData.append('html_code', form.html_code);

        await axios.post(`/comment/update/${comment.id}`, formData);

        window.location.replace('http://127.0.0.1:8000/comment')
        // Manejar la respuesta o redireccionar a otra página
    } catch (error) {
        console.log(error);
        // Manejar el error, por ejemplo, mostrar un mensaje de error
    }

    form.processing = false;
};
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
                    <form @submit.prevent="submitForm">
                        <div class="col-sm-3 m-auto">
                            <label for="pelicula_id" class="form-label"
                                >Seleccione película:</label
                            >
                            <select
                                id="pelicula_id"
                                class="form-select"
                                v-model="form.pelicula_id"
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
                            <label for="html_code" class="form-label"
                                >Codigo HTML:</label
                            >
                            <input
                                id="html_code"
                                type="text"
                                class="form-control"
                                v-model="form.html_code"
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
};
</script>
