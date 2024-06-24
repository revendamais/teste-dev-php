<template>
  <v-card>
    <v-row align="center">
      <v-card-title>Tabela de Fornecedores</v-card-title>
      <v-icon color="green" @click="createUser()" md>mdi-plus</v-icon>
    </v-row>
    <v-data-table :headers="headers" :items="clients" :search="search" :pagination.sync="pagination" :loading="loading"
      :footer-props="footerProps" item-key="id" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-text-field v-model="search" label="Pesquisar" single-line hide-details></v-text-field>
        </v-toolbar>
      </template>

      <template v-slot:item.actions="{ item }">
        <v-icon color="blue" small @click="editClient(item)">mdi-pencil</v-icon>
        <v-icon color="red" small @click="deleteClient(item)">mdi-delete</v-icon>
      </template>
    </v-data-table>
    <ConfirmationDialog :value="confirmationDialog" text="Tem certeza que deseja excluir?"
      @input="confirmationDialog = $event" @confirmar="handleConfirm" @cancelar="handleCancel">
    </ConfirmationDialog>
    <ClientForm :dialog="dialog" :client="selectedClient" @close="closeClientForm" @update:dialog="dialog = $event">
    </ClientForm>
  </v-card>
</template>

<script>
import ConfirmationDialog from './ConfirmationDialog.vue';
import ClientForm from './ClientForm.vue';

export default {
  name: 'ClientTable',
  components: {
    ConfirmationDialog,
    ClientForm
  },
  computed: {
    clients() {
      return this.$store.state.clients;
    }
  },
  data() {
    return {
      confirmationDialog: false,
      dialog: false,
      headers: [
        { text: 'ID', align: 'start', sortable: true, value: 'id' },
        { text: 'Nome', value: 'name' },
        { text: 'CPF / CNPJ', value: 'cpfCnpj' },
        { text: 'Ações', value: 'actions', sortable: false },
      ],
      search: '',
      pagination: {
        sortBy: 'id',
        descending: false,
        page: 1,
        rowsPerPage: 5,
      },
      loading: false,
      footerProps: {
        itemsPerPageOptions: [5, 10, 25],
        showFirstLastPage: true,
      },
      selectedClient: null,
    };
  },
  methods: {
    closeClientForm() {
      this.dialog = false;
    },
    createUser() {
      this.dialog = true;
      this.selectedClient = null;
    },
    showConfirmationDialog() {
      this.confirmationDialog = true;
    },
    handleConfirm() {
      console.log('Confirmado');
      this.$store.dispatch("deleteClientAsync", this.selectedClient.id);

      this.confirmationDialog = false;
    },
    handleCancel() {
      console.log('Cancelado');
      this.confirmationDialog = false;
    },
    editClient(client) {
      this.dialog = true;
      this.selectedClient = { ...client };
    },
    deleteClient(client) {
      this.selectedClient = client;
      this.showConfirmationDialog();
    },
  },
};
</script>

<style scoped></style>
