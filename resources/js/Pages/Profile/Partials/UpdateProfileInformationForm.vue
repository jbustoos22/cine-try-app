<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    cedula: user.cedula,
    telefono: user.telefono,
    pais: user.pais,
    estado: user.estado,
    ciudad: user.ciudad
});
</script>

<template>
    <div>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Información de Perfil
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Actualiza la información de perfil y la dirección de correo
                electrónico de tu cuenta.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6"
        >
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input
                    id="name"
                    type="text"
                    class="form-control mt-1"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <div class="text-danger">{{ form.errors.name }}</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input
                    id="email"
                    type="email"
                    class="form-control mt-1"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <div class="text-danger">{{ form.errors.email }}</div>
            </div>
            <div class="row">
                <div class="mb-3 col-sm-6">
                    <label for="cedula" class="form-label">Cedula</label>
                    <input
                        id="cedula"
                        type="text"
                        class="form-control mt-1"
                        v-model="form.cedula"
                        required
                    />
                    <div class="text-danger">{{ form.errors.cedula }}</div>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input
                        id="telefono"
                        type="text"
                        class="form-control mt-1"
                        v-model="form.telefono"
                        required
                    />
                    <div class="text-danger">{{ form.errors.telefono }}</div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-sm-4">
                    <label for="Pais" class="form-label">Pais</label>
                    <select id="pais" class="form-select" v-model="form.pais">
                        <option value="Venezuela">Venezuela</option>
                    </select>
                    <div class="text-danger">{{ form.errors.Pais }}</div>
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select
                        id="estado"
                        class="form-select"
                        v-model="form.estado"
                    >
                        <option value="Carabobo">Carabobo</option>
                    </select>
                    <div class="text-danger">{{ form.errors.Estado }}</div>
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <select
                        id="ciudad"
                        class="form-select"
                        v-model="form.ciudad"
                    >
                        <option value="Valencia">Valencia</option>
                    </select>
                    <div class="text-danger">{{ form.errors.Ciudad }}</div>
                </div>
            </div>

            <div
                v-if="mustVerifyEmail && user.email_verified_at === null"
                class="mb-3"
            >
                <p class="text-sm mt-2 text-gray-800">
                    Tu dirección de correo electrónico no está verificada.
                    <a
                        :href="route('verification.send')"
                        method="post"
                        class="underline text-sm text-gray-600"
                        >Haz clic aquí para volver a enviar el correo de
                        verificación.</a
                    >
                </p>
                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    Se ha enviado un nuevo enlace de verificación a tu dirección
                    de correo electrónico.
                </div>
            </div>

            <div class="mb-3 d-flex align-items-center gap-4">
                <button :disabled="form.processing" class="btn btn-primary">
                    Guardar
                </button>
                <transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Guardado.
                    </p>
                </transition>
            </div>
        </form>
    </div>
</template>
