<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import axios from "axios";

const { data, setData } = useForm({
  sala: {
    numero: "",
    tipo: "",
    aforo: "",
    desde: "",
    hasta: "",
    id_pelicula: ""
  }
});

// Función para obtener los valores de la sala desde 127.0.0.1:8000/obtainSala/{id}
const obtenerSala = async () => {
  try {
    const id = 2; // Reemplaza con el valor adecuado de la sala que deseas obtener
    const response = await axios.get(`http://127.0.0.1:8000/obtainSala/${id}`);
    setData('sala', response.data);
  } catch (error) {
    console.error('Error al obtener los datos de la sala', error);
  }
};

// Función para manejar el envío del formulario
const submit = async () => {
  try {
    // Lógica para enviar los datos del formulario
    await axios.post('http://127.0.0.1:8000/updateSala', data.sala);
    // Redireccionar o mostrar un mensaje de éxito
  } catch (error) {
    console.error('Error al enviar los datos del formulario', error);
    // Mostrar un mensaje de error o manejar el error de otra manera
  }
};

obtenerSala();  // Llamar a la función obtenerSala al cargar la página
</script>

<template>
  <Head :title="'Actualizar'" />
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="mt-5 mb-4">Actualizar Salas de Cine</h1>

        <form @submit.prevent="submit">
          <div class="mb-3">
            <label for="numero" class="form-label">Numero de la Sala</label>
            <TextInput
              id="numero"
              type="text"
              v-model="sala.numero"
              required
              autofocus
            />
          </div>

          <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Sala</label>
            <TextInput
              id="tipo"
              type="number"
              v-model="sala.tipo"
              required
            />
          </div>

          <div class="mb-3">
            <label for="aforo" class="form-label">Aforo</label>
            <TextInput
              id="aforo"
              type="text"
              v-model="sala.aforo"
              required
            />
          </div>

          <div class="mb-3">
            <label for="desde" class="form-label">Desde</label>
            <TextInput
              id="desde"
              type="date"
              v-model="sala.desde"
              required
            />
          </div>

          <div class="mb-3">
            <label for="hasta" class="form-label">Hasta</label>
            <TextInput
              id="hasta"
              type="date"
              v-model="sala.hasta"
              required
            />
          </div>

          <div class="mb-3">
            <label for="id_pelicula" class="form-label">Seleccione sala:</label>
            <TextInput
              id="id_pelicula"
              type="text"
              v-model="sala.id_pelicula"
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
