<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

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
                    <div class="col-sm-3"><a class="btn btn-primary" href="/sala/crear"> Crear nueva sala</a></div>

                    <table class="table">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Sala #</th>
                        <th class="text-center" scope="col">Desde</th>
                        <th class="text-center" scope="col">Hasta</th>
                        <th class="text-center" scope="col">Aforo</th>
                        <th class="text-center" scope="col">Pelicula</th>
                        <th class="text-center" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sala, index) in salas" :key="index">
                            <td class="text-center" scope="row">{{ sala.id }}</td>
                            <td class="text-center">{{ sala.numero }}</td>
                            <td class="text-center">{{ sala.desde }}</td>
                            <td class="text-center">{{ sala.hasta }}</td>
                            <td class="text-center">{{ sala.aforo }}</td>
                            <td class="text-center">{{ sala.id_pelicula }}</td>
                            <td class="text-center"><a class="btn btn-dark" @click="openEditModal(sala.id)">Editar 🖋️</a> <a @click="
                                                        eliminarRegistro(
                                                            sala.id
                                                        )
                                                    "
                                                    href="/admpelis" class="btn btn-danger" >Eliminar✖️</a></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
              </div>
              <div class="modal" id="editModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Editar Sala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form @submit.prevent="updateSala">
                        <!-- Campos del formulario para editar los datos de la sala -->
                        <div class="form-group">
                        <label for="numero">Número de Sala:</label>
                        <input type="text" class="form-control" id="numero" v-model="editedSala.numero">
                        </div>
                        <!-- Otros campos del formulario para editar los datos de la sala -->
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" @click="updateSala">Guardar cambios</button>
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

export default {
  data() {
    return {
      salas: [],
      editedSala: {}  // Variable para almacenar los resultados de la solicitud Axios
    };
  },
  created() {
    axios
      .get(`http://127.0.0.1:8000/verSalas`)
      .then((response) => {
        this.salas = response.data.salas;  // Actualizar la variable 'salas' con los datos de la respuesta
      })
      .catch((error) => {
        console.error("Error al obtener el JSON:", error);
      });
  },
  methods: {
    openEditModal(salaId) {
        axios.get(`http://127.0.0.1:8000/obtainSala/${salaId}`)
            .then(response => {
                this.editedSala = response.data.salas;  // Asumiendo que la respuesta directamente contiene la sala
                $(document).ready(() => {
                $('#editModal').modal('show');  // Espera a que jQuery se cargue completamente
                console.log(response.data.salas);
                });
            })
            .catch(error => {
                console.error("Error al obtener datos de la sala:", error);
            });
    },
    updateSala() {
      // Lógica para enviar los datos editados al servidor y guardar los cambios
      // ...
      // Cerrar el modal después de guardar los cambios
      $('#editModal').modal('hide');
    }
  }
};


</script>
