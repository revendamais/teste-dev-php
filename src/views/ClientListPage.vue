<template>
  <v-container>
    <ClientTable />
  </v-container>
</template>

<script>
import ClientTable from '@/components/ClientTable.vue';
export default {
  name: 'ClientListPage',
  components: {
    ClientTable,
  },
};
</script>
