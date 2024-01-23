<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="d-block" >
        <p class="small text-danger">
            {{ message }}
        </p>
    </div>
</template>

