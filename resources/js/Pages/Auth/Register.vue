<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Register</h1>

                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <div class="text-danger">{{ form.errors.name }}</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
                        <div class="text-danger">{{ form.errors.email }}</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            type="password"
                            class="form-control"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <div class="text-danger">{{ form.errors.password }}</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            class="form-control"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <div class="text-danger">{{ form.errors.password_confirmation }}</div>
                    </div>

                    <div class="mb-3">
                        <a :href="route('login')">Already registered?</a>
                        <button class="btn btn-primary ms-3" :disabled="form.processing">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
