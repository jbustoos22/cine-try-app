<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="h3">Actualizar Contraseña</h2>

            <p class="mt-1 text-muted">
                Asegúrate de que tu cuenta esté utilizando una contraseña larga
                y aleatoria para mantenerla segura.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-4">
            <div class="mb-3">
                <label for="current_password" class="form-label"
                    >Contraseña Actual</label
                >
                <input
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="form-control"
                    autocomplete="current-password"
                />
                <div class="text-danger">
                    {{ form.errors.current_password }}
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"
                    >Nueva Contraseña</label
                >
                <input
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    autocomplete="new-password"
                />
                <div class="text-danger">{{ form.errors.password }}</div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label"
                    >Confirmar Contraseña</label
                >
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-control"
                    autocomplete="new-password"
                />
                <div class="text-danger">
                    {{ form.errors.password_confirmation }}
                </div>
            </div>

            <div class="mb-3">
                <button :disabled="form.processing" class="btn btn-primary">
                    Guardar
                </button>
            </div>

            <div class="mb-3" v-if="form.recentlySuccessful">
                <p class="text-success">Guardado.</p>
            </div>
        </form>
    </section>
</template>
