<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Inicio de Sesión" />

        <div v-if="status" class="mb-4 font-medium text-sm text-success">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <div class="invalid-feedback">{{ form.errors.email }}</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <div class="invalid-feedback">{{ form.errors.password }}</div>
            </div>

            <div class="mb-3 form-check">
                <input
                    type="checkbox"
                    id="remember"
                    class="form-check-input"
                    v-model="form.remember"
                />
                <label for="remember" class="form-check-label"
                    >Recuérdame</label
                >
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-decoration-underline text-gray-600"
                >
                    ¿Olvidaste tu contraseña?
                </a>
                <a
                    v-if="canResetPassword"
                    :href="route('register')"
                    class="text-decoration-underline text-gray-600"
                >
                    Registrate
                </a>
                <button
                    class="btn btn-primary ms-4"
                    :class="{ disabled: form.processing }"
                    :disabled="form.processing"
                >
                    Iniciar
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
