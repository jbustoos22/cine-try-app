<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import "bootstrap";
</script>

<template>
    <Head :title="'Inicio'" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 my-4"
            >
                Inicio
            </h2>
        </template>

        <div class="movie-preview">
            <h2 class="text-center">{{ movieTitle }}</h2>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-2">
                    <img
                        :src="url"
                        alt="Movie Poster"
                        class="img-fluid movie-poster"
                    />
                </div>
                <div class="col-md-6">
                    <p><strong>Género:</strong> {{ movieGenre }}</p>
                    <p><strong>Clase:</strong> {{ movieRating }}</p>
                    <p><strong>Descripción: </strong>{{ movieDescription }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
// Realiza la solicitud HTTP utilizando Axios
export default {
    props: {
        url: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            movieTitle: "Título de la Película",
            movieImage:
                "https://www.latercera.com/resizer/JzHhj0HjOVLt-5SYbHUSz2mzNUk=/800x0/smart/cloudfront-us-east-1.images.arcpublishing.com/copesa/ZPEQXUEQKFELNAMFUTACTVA6NY.jpeg",
            movieGenre: "Género de la Película",
            movieRating: "Clase de Edad",
            movieDescription: "Descripción de la Película",
        };
    },
    created() {
        // Obtener la ruta de la URL
        let path = window.location.pathname;

        // Obtener el último segmento de la ruta
        let segments = path.split("/");
        let valor = segments[segments.length - 1]; // Esto recuperará "1" del ejemplo "127.0.0.1/pelicula/1"
        console.log(valor);
        axios
            .get(`http://127.0.0.1:8000/obtainPelicula/${valor}`)
            .then((response) => {
                this.movieTitle = response.data.peliculas.nombre;
                this.movieGenre = response.data.peliculas.genero;
                this.movieDescription = response.data.peliculas.descripcion;
                this.movieRating = response.data.peliculas.clase;
                this.movieImage = response.data.peliculas.foto;
                // Actualizar otras propiedades con los datos necesarios
            })
            .catch((error) => {
                console.error("Error al obtener el JSON:", error);
            });
    },
};
</script>

<style scoped>
.movie-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.movie-poster {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
