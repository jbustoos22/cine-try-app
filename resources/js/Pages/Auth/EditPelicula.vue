<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import axios from "axios";


const { pelicula } = usePage().props;
const form = useForm({
    nombre: pelicula.nombre,
    genero: pelicula.genero,
    clase: pelicula.clase,
    descripcion: pelicula.descripcion,
    idioma: pelicula.idioma,
    color: pelicula.color,
    imagen: null,
    processing: false,
});

const submitForm = async () => {
    form.processing = true;

    try {
        const formData = new FormData();
        formData.append('nombre', form.nombre);
        formData.append('genero', form.genero);
        formData.append('clase', form.clase);
        formData.append('descripcion', form.descripcion);
        formData.append('idioma', form.idioma);
        formData.append('color', form.color);
        formData.append('imagen', form.imagen);

        await axios.post(`/peliculas/update/${pelicula.id}`, formData);

        window.location.replace('http://127.0.0.1:8000/admpelis')
        // Manejar la respuesta o redireccionar a otra página
    } catch (error) {
        // Manejar el error, por ejemplo, mostrar un mensaje de error
    }

    form.processing = false;
};

const onFileChange = (e) => {
    const file = e.target.files[0];
    form.imagen = file;
};
</script>

<template>
    <Head :title="'Actualizar Película'" />
    <div class="container bg-light">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Actualizar Película</h1>

                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label"
                            >Nombre de la Película</label
                        >
                        <input
                            id="nombre"
                            type="text"
                            class="form-control"
                            v-model="form.nombre"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select
                            id="genero"
                            class="form-select"
                            v-model="form.genero"
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
                            v-model="form.clase"
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
                            v-model="form.descripcion"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="idioma" class="form-label">Idioma</label>
                        <select
                            id="idioma"
                            class="form-select"
                            v-model="form.idioma"
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
                            v-model="form.color"
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