<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="mb-5">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Eliminar cuenta</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar
                tu cuenta, por favor descarga cualquier dato o información que desees conservar.
            </p>
        </header>

        <button class="btn btn-danger" @click="confirmUserDeletion">Eliminar cuenta</button>

        <div class="modal" :class="{ 'show': confirmingUserDeletion }" @close="closeModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title text-lg font-medium text-gray-900 dark:text-gray-100">
                            ¿Estás seguro de que deseas eliminar tu cuenta?
                        </h2>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán de forma permanente. Por favor
                            ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.
                        </p>

                        <div class="mt-3">
                            <label for="password" class="visually-hidden">Contraseña</label>
                            <input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="form-control"
                                placeholder="Contraseña"
                                @keyup.enter="deleteUser"
                            />
                            <div class="invalid-feedback">{{ form.errors.password }}</div>
                        </div>

                        <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-secondary" @click="closeModal">Cancelar</button>
                            <button
                                class="btn btn-danger ms-2"
                                :class="{ 'disabled': form.processing }"
                                :disabled="form.processing"
                                @click="deleteUser"
                            >
                                Eliminar cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
