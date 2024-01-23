<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="submit" class="mt-4">
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <div class="text-danger mt-2">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="password">Contraseña</label>
                        <input
                            id="password"
                            type="password"
                            class="form-control"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <div class="text-danger mt-2">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="password_confirmation"
                            >Confirmar Contraseña</label
                        >
                        <input
                            id="password_confirmation"
                            type="password"
                            class="form-control"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <div class="text-danger mt-2">
                            {{ form.errors.password_confirmation }}
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="form.processing"
                        >
                            Resetear Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
