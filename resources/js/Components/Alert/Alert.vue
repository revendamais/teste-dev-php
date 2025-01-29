<script setup lang="ts">
import { ref, computed, watch } from 'vue';

const props = defineProps({
    backgroundColor: {
        type: String,
        default: 'bg-blue-500'
    },
    textColor: {
        type: String,
        default: 'text-white'
    },
    message: {
        type: String,
        required: true
    },
    show: {
        type: Boolean,
        default: true
    }
});

// Controle interno de visibilidade
const show = ref(props.show);

const alertClasses = computed(() => {
    return `${props.backgroundColor} ${props.textColor}`;
});

// Reage à mudança na prop 'visible' e configura o timeout
watch(
    () => props.show,
    (newVal) => {
        show.value = newVal;

        if (newVal) {
            setTimeout(() => {
                show.value = false;
            }, 5000);
        }
    },
    { immediate: true } // Executa no início para sincronizar o estado inicial
);
</script>

<template>
    <div v-if="show" :class="alertClasses" class="p-4 rounded-md">
        {{ message }}
    </div>
</template>
