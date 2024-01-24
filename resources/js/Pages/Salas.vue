<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
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
        <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-ride="carousel"
        >
            <ol class="carousel-indicators">
                <li
                    v-for="(movie, index) in movies"
                    :key="index"
                    data-target="#carouselExampleIndicators"
                    :data-slide-to="index"
                    :class="index === 0 ? 'active' : ''"
                ></li>
            </ol>
            <div class="carousel-inner">
                <div
                    v-for="(movie, index) in movies"
                    :key="index"
                    :class="'carousel-item ' + (index === 0 ? 'active' : '')"
                >
                    <img
                        :src="movie.image"
                        class="d-block w-50 mx-auto"
                        alt="Movie Slide"
                    />
                    <!-- Aplicación de la clase 'w-50' para ajustar el ancho de la imagen -->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ movie.title }}</h5>
                        <p>{{ movie.description }}</p>
                    </div>
                </div>
            </div>
            <a
                class="carousel-control-prev"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="sr-only">Previous</span>
            </a>
            <a
                class="carousel-control-next"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <h2>Otras películas</h2>
        <div class="row">
            <div
                class="col-md-4"
                v-for="(movie, index) in additionalMovies"
                :key="index"
            >
                <div class="card mb-4">
                    <img
                        :src="movie.image"
                        class="card-img-top"
                        alt="Movie Image"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ movie.title }}</h5>
                        <p class="card-text">{{ movie.description }}</p>
                        <a href="#" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            movies: [
                {
                    title: "Mario Bros",
                    image: "https://www.latercera.com/resizer/JzHhj0HjOVLt-5SYbHUSz2mzNUk=/800x0/smart/cloudfront-us-east-1.images.arcpublishing.com/copesa/ZPEQXUEQKFELNAMFUTACTVA6NY.jpeg",
                    description: "Descripción de la película 1",
                }
            ],
            additionalMovies: [
                {
                    title: "Peli 4",
                    image: "/storage/images/7Wfap5c3arLiDRT6m9RAcWytumuZPrSuVMJHHcRC.webp",
                    description: "Descripción de la película 4",
                },
                {
                    title: "Peli 5",
                    image: "/storage/images/fYTSq624PLLW2iVozI6PjpyQzJL4CUbwCNEJoBeF.webp",
                    description: "Descripción de la película 5",
                },
                {
                    title: "Peli 6",
                    image: "/storage/images/jXpj3tTXa53ZPquisVrHsdSQIc8xfUXDUZDdNMod.webp",
                    description: "Descripción de la película 6",
                },
            ],
        };
    },
};
</script>
