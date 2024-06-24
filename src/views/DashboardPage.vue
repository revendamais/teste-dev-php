<template>
  <v-container>
    <CardComponent backgroundColor="#64e764" title="Clientes Cadastrados" :value="numberOfClients" icon="mdi-account" />
  </v-container>
</template>

<script>
import CardComponent from '../components/CardComponent.vue';
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
  name: 'DashboardPage',
  components: {
    CardComponent,
  },
  setup() {
    const store = useStore();
    const numberOfClients = computed(() => {
      return store.state.clients.length;
    });

    return {
      numberOfClients,
    };
  },
};
</script>
