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
                <div class="p-4 text-gray-900 dark-text-gray-100">¡Iniciaste sesión correctamente!</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  