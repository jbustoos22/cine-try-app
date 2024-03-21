<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Footer from "@/Pages/Auth/Footer.vue";
import { Head } from "@inertiajs/vue3";
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

        <div class="carousel">
            <div class="carousel-inner">
                <div class="slide active">
                    <img :src="movies[0].image" alt="Slide 1" />
                    <div class="caption text-center">
                        <h3>{{ movies[0].title }}</h3>
                        <p>{{ movies[0].description }}</p>
                    </div>
                </div>
                <div class="slide">
                    <img :src="movies[1].image" alt="Slide 2" />
                    <div class="caption text-center">
                        <h3>{{ movies[1].title }}</h3>
                        <p>{{ movies[1].description }}</p>
                    </div>
                </div>
                <div class="slide">
                    <img :src="movies[2].image" alt="Slide 3" />
                    <div class="caption text-center">
                        <h3>{{ movies[2].title }}</h3>
                        <p>{{ movies[2].description }}</p>
                    </div>
                </div>
                <!-- Add more slides as needed -->
            </div>
            <a id="autoslide" class="prev" @click="moveSlide(-1)">&#10094;</a>
            <a class="next" @click="moveSlide(1)">&#10095;</a>
        </div>

        <h2 class="text-center mt-3" style="color: white">Otras películas</h2>
        <div class="card-container mt-5">
            <div
                v-for="(movie, index) in additionalMovies"
                :key="index"
                class="card"
            >
                <a
                    :href="'/pelicula/' + movie.id"
                    style="border-color: black; text-decoration: none; color: black;"
                >
                    <div class="image-container">
                        <img
                            :src="movie.foto_path"
                            class="card-img-top equal-height-img"
                            alt="Movie Image"
                        />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ movie.nombre }}</h5>
                        <p class="card-text">{{ movie.descripcion }}</p>
                    </div>
                </a>
            </div>
        </div>
    </AuthenticatedLayout>

    <Footer />
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            movies: [
                {
                    title: "Mario Bros",
                    image: "https://www.latercera.com/resizer/JzHhj0HjOVLt-5SYbHUSz2mzNUk=/800x0/smart/cloudfront-us-east-1.images.arcpublishing.com/copesa/ZPEQXUEQKFELNAMFUTACTVA6NY.jpeg",
                    description:
                        "Mario es una persona que viaja junto a su hermano Luigi, tienen una empresa de tuberias y consiguen una donde viajan a otro mundo alternativo donde viviran aventuras increibles",
                },
                {
                    title: "Érase una vez",
                    image: "/storage/images/jXpj3tTXa53ZPquisVrHsdSQIc8xfUXDUZDdNMod.webp",
                    description:
                        "Antes de entrar en el País de las Maravillas y convertirse en Pan, Alicia y Peter eran hermanos. Una tragedia familiar los obliga a elegir entre los mundos de fantasía que tanto los atraen y el bienestar de sus padres.",
                },
                {
                    title: "Mentes Poderosas",
                    image: "/storage/images/7Wfap5c3arLiDRT6m9RAcWytumuZPrSuVMJHHcRC.webp",
                    description:
                        "Ruby es una adolescente que ha sido encerrada en un campo de concentración por haber desarrollado superpoderes. Ruby escapa y se une a otros jóvenes fugados con poderes excepcionales, pero los agentes del Gobierno tratarán de capturarlos.",
                },
            ],
            additionalMovies: [],
        };
    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/obtainPeliculas`)
            .then((response) => {
                this.additionalMovies = response.data.peliculas; // Actualizar la variable 'salas' con los datos de la respuesta
            })
            .catch((error) => {
                console.error("Error al obtener el JSON:", error);
            });
    },
};

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

<style>
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

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.card {
    width: 300px;
    margin: 10px;
}

.card:hover {
    box-shadow: 5px 5px 5px #888888;
    transform: scale(1.05);
    transition-duration: 0.3s;
}

.image-container {
    position: relative;
    width: 100%;
    padding-top: 150%; /* Establece la relación de aspecto deseada (por ejemplo 4:3) */
    overflow: hidden;
}

.equal-height-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegura que la imagen se ajuste al contenedor manteniendo su relación de aspecto */
}
</style>
