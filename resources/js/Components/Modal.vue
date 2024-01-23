<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
            return {
                sm: 'modal-sm',
                md: 'modal-md',
                lg: 'modal-lg',
                xl: 'modal-xl',
                '2xl': 'modal-xxl',
            }[props.maxWidth];
        });
</script>

<template>
    <div class="modal" v-show="show" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div v-show="show" class="modal-backdrop" @click="close"></div>
                <div v-show="show" class="modal-dialog" @click="close">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ title }}</h5>
                        <button type="button" class="close" @click="close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot v-if="show"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
