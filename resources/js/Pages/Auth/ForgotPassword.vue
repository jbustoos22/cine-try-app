<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
      <Head :title="'Olvidó su contraseña'" />
  
      <div class="mb-4 text-sm text-gray-600">
        Si olvidó su contraseña, coloque su correo y inmediatamente recibirá un correo electrónico con pasos a seguir para reiniciar su contraseña.
      </div>
  
      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>
  
      <form @submit.prevent="submit">
        <div class="mb-3">
          <label for="email" :class="{'form-label': true, 'is-invalid': form.errors.email}" class="form-label">Correo</label>
  
          <input
            id="email"
            type="email"
            v-model="form.email"
            class="form-control"
            :class="{'is-invalid': form.errors.email}"
            required
            autofocus
            autocomplete="username"
          />
  
          <div v-if="form.errors.email" class="invalid-feedback">
            {{ form.errors.email }}
          </div>
        </div>
  
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary" :disabled="form.processing">
                Enviar Correo
            </button>

        </div>
      </form>
    </GuestLayout>
  </template>
  