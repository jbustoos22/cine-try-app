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

        <div class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div
                            class="bg-white dark-bg-gray-800 rounded overflow-hidden shadow-sm"
                        >
                            <div class="p-4 text-gray-900 dark-text-gray-100">
                                <div class="col-sm-3">
                                    <a
                                        class="btn btn-primary"
                                        href="/comment/crear"
                                    >
                                        Crear nuevo preview de post</a
                                    >
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">
                                                ID
                                            </th>
                                            <th class="text-center" scope="col">
                                                Pelicula #
                                            </th>
                                            <th class="text-center">
                                                Preview
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(comment, index) in comments"
                                            :key="index"
                                        >
                                            <td class="text-center" scope="row">
                                                {{ comment.id }}
                                            </td>
                                            <td class="text-center">
                                                {{ comment.pelicula_id }}
                                            </td>
                                            <td class="text-center overflow-x-auto">
                                                <!-- Añade la clase overflow-x-auto para activar el scroll horizontal -->
                                                <div class="text-center overflow-x-auto">
                                                    <div
                                                        v-html="
                                                            comment.html_code
                                                        "
                                                    ></div>
                                                </div>
                                            </td>
                                            
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-dark"
                                                    :href="`/comment/actualizar/${comment.id}`"
                                                    >Editar 🖋️</a
                                                >
                                                <a
                                                    class="btn btn-danger p-1"
                                                    @click="
                                                        eliminarRegistro(
                                                            comment.id
                                                        )
                                                    "
                                                    href="/comment"
                                                    >Eliminar ✖️</a
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div
                            class="modal"
                            id="editModal"
                            tabindex="-1"
                            role="dialog"
                        >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Sala</h5>
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="updateSala">
                                            <!-- Campos del formulario para editar los datos de la sala -->
                                            <div class="form-group">
                                                <label for="numero"
                                                    >Número de Sala:</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="numero"
                                                    v-model="editedSala.numero"
                                                />
                                            </div>
                                            <!-- Otros campos del formulario para editar los datos de la sala -->
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-dismiss="modal"
                                        >
                                            Cancelar
                                        </button>
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                            @click="updateSala"
                                        >
                                            Guardar cambios
                                        </button>
                                    </div>
                                </div>
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
const script = document.createElement("script");
script.src = "https://platform.twitter.com/widgets.js";
script.charset = "utf8";
script.async = true;
document.body.appendChild(script);
export default {
    data() {
        return {
            comments: [],
            editedSala: {}, // Variable para almacenar los resultados de la solicitud Axios
        };
    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/comment/get`)
            .then((response) => {
                this.comments = response.data.comment; // Actualizar la variable 'salas' con los datos de la respuesta
            })
            .catch((error) => {
                console.error("Error al obtener el JSON:", error);
            });
    },
    methods: {
        updateSala() {
            // Lógica para enviar los datos editados al servidor y guardar los cambios
            // ...
            // Cerrar el modal después de guardar los cambios
            $("#editModal").modal("hide");
        },
        eliminarRegistro(id) {
            axios
                .delete(`/comment/destroy/${id}`)
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
            this.$router.push({ name: "editarPelicula", params: { id: id } });
        },
    },
};
</script>
