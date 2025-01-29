<script setup lang="ts">
import { onMounted, ref, defineProps, defineExpose } from 'vue';

// Define a propriedade para a máscara
const props = defineProps({
  mask: {
    type: String,
    default: '',
  },  
});

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

// Foco automático se o atributo "autofocus" estiver presente
onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
  <input
    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    v-model="model"
    v-mask="props.mask"    
    ref="input"    
  />
</template>
