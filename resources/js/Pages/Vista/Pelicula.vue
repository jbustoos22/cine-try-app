<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Footer from "@/Pages/Auth/Footer.vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import "bootstrap";
</script>
<template>
    <Head :title="'Pelicula'" />

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
                <div class="col-md-5">
                    <p><strong>Género:</strong> {{ movieGenre }}</p>
                    <p><strong>Clase:</strong> {{ movieRating }}</p>
                    <p><strong>Sinópsis: </strong>{{ movieDescription }}</p>
                    <a class="btn btn-dark" href="/sala/comprar">
                        Comprar Entradas </a
                    >
                </div>
            </div>
        </div>
        <div class="carousel">
            <div class="carousel-inner">
                <div v-for="post in posts" :key="post.id" class="slide">
                    <div v-html="post.html_code"></div>
                </div>
            </div>
            <a id="autoslide" class="prev" @click="moveSlide(-1)">&#10094;</a>
            <a class="next" @click="moveSlide(1)">&#10095;</a>
        </div>
        <Footer />
    </AuthenticatedLayout>
</template>

<style>
.text-muted {
    color: white;
}
</style>
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
            posts: [],
            movieTitle: "Título de la Película",
            movieImage:
                "https://www.latercera.com/resizer/JzHhj0HjOVLt-5SYbHUSz2mzNUk=/800x0/smart/cloudfront-us-east-1.images.arcpublishing.com/copesa/ZPEQXUEQKFELNAMFUTACTVA6NY.jpeg",
            movieGenre: "Género de la Película",
            movieRating: "Clase de Edad",
            movieDescription: "Descripción de la Película",
        };
    },
    created() {
        // Llama a la operación CRUD para obtener los bloques de cotización de la base de datos

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

        axios
            .get(`http://127.0.0.1:8000/comment/get/${valor}`)
            .then((response) => {
                console.log(response.data); // Imprime la respuesta de la API
                this.posts = response.data.comment;
            })
            .catch((error) => {
                console.error("Error al obtener el JSON:", error);
            });
    },
};
const script = document.createElement("script");
script.src = "https://platform.twitter.com/widgets.js";
script.charset = "utf8";
script.async = true;
document.body.appendChild(script);
let slideIndex = 0;

function showSlide(n) {
    const slides = document.getElementsByClassName("slide");
    if (n >= slides.length) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = slides.length - 1;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.transform = `translateX(-${slideIndex * 100}%)`;
    }
}
// sensacion de slider, automatico

const totalSlides = 2; /* coloca aquí el número total de diapositivas - 1 */

function slideAuto() {
    showSlide(slideIndex);
    if (slideIndex < totalSlides) {
        slideIndex++;
    } else {
        slideIndex = 0; // Reiniciar el carrusel al final de las diapositias
    }
}

const interval = setInterval(slideAuto, 5000);

// Limpia el intervalo después de que se haya mostrado la última diapositiva
setTimeout(() => {
    clearInterval(interval);
}, 10000 * totalSlides);

function moveSlide(n) {
    showSlide((slideIndex += n));
}
</script>

<style scoped>
.carousel {
    position: relative;
    max-width: 100%;
    overflow: hidden;
}

.carousel-inner {
    display: flex;
    transition: transform 0.5s ease; /* Agregar transición para suavizar el desplazamiento */
}

.slide {
    flex: 0 0 100%;
    display: flex;
    justify-content: center;
    transition: transform 0.5s; /* Agregar transición para animar los desplazamientos */
}

.slide img {
    max-width: 30%;
    height: auto;
}

.caption {
    position: absolute;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    width: 100%;
    padding: 10px;
}

.prev,
.next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    padding: 30px;
    color: white;
    font-weight: bold;
    font-size: 70px;
}

.prev {
    left: 0;
    text-decoration: none;
}

.next {
    right: 0;

    text-decoration: none;
}
.movie-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center; /* Centra el contenido */
    margin-bottom: 20px; /* Añade un espacio entre las visualizaciones de películas */
}

.movie-poster {
    width: 100%; /* Asegura que todas las imágenes tengan el mismo ancho */
    height: auto; /* Permite que la altura se ajuste automáticamente para mantener la proporción original */
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilos para la descripción de la película */
.movie-description {
    text-align: left;
}
</style>
