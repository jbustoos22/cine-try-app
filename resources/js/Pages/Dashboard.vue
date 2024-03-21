<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

window.location.replace('http://127.0.0.1:8000/salas');
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
                <div class="p-4 text-gray-900 dark-text-gray-100">¡Iniciaste sesión correctamente!</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>