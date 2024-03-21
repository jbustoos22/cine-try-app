<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from "axios";

</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></link>
<template>
    <Head :title="'Inicio'" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-weight-semibold text-xl text-gray-800 dark:text-gray-200 my-4">Inicio</h2>
      </template>

      <div class="py-4">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="bg-white dark-bg-gray-800 rounded overflow-hidden shadow-sm">
                <div class="p-4 text-gray-900 dark-text-gray-100">
                    <div class="col-sm-3"><a class="btn btn-primary" href="/peliculas/crear"> Agregar nueva Pelicula</a></div>

                    <table class="table">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Genero</th>
                        <th class="text-center" scope="col">Descripción</th>
                        <th class="text-center" scope="col">Idioma(s)</th>
                        <th class="text-center" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(pelicula, index) in peliculas" :key="index">
                            <td class="text-center" scope="row">{{ pelicula.id }}</td>
                            <td class="text-center">{{ pelicula.nombre }}</td>
                            <td class="text-center">{{ pelicula.genero }}</td>
                            <td class="text-center">{{ pelicula.descripcion }}</td>
                            <td class="text-center">{{ pelicula.idioma }}</td>
                            <td class="text-center">
                                <a class="btn btn-dark" :href="`/peliculas/actualizar/${pelicula.id}`">Editar 🖋️</a>
                                <a class="btn btn-danger" @click="eliminarRegistro(pelicula.id)" href="/admpelis">Eliminar✖️</a></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
<script>
import axios from "axios";

export default {
  data() {
    return {
      peliculas: []  // Variable para almacenar los resultados de la solicitud Axios
    };
  },
  created() {
    axios
      .get(`http://127.0.0.1:8000/obtainPeliculas`)
      .then((response) => {
        this.peliculas = response.data.peliculas;  // Actualizar la variable 'salas' con los datos de la respuesta
      })
      .catch((error) => {
        console.error("Error al obtener el JSON:", error);
      });
  },
  methods: {
    eliminarRegistro(id) {
        axios
        .delete(`/pelicula/destroy/${id}`)
        .then((response) => {
            alert("Registro eliminado exitosamente");
        })
        .catch((error) => {
            console.error(
                "Error al intentar eliminar el registro:",
                error
            );
            // Aquí puedes manejar errores y mostrar mensajes al usuario si la eliminación no se realiza correctamente
        });
    },
    actualizarRegistro(id) {
        this.$router.push({ name: 'editarPelicula', params: { id: id } });
    },
  },
};


</script>
