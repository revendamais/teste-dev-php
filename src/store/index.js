import {
  createStore
} from 'vuex';
import * as clientService from '../services/clientService';

const store = createStore({
  state: {
    clients: clientService.getClients(),
  },
  mutations: {
    addClient(state, newClient) {
      clientService.addClient(newClient);
      state.clients.push(newClient);
    },
    editClient(state, editedClient) {
      clientService.editClient(editedClient);
      const index = state.clients.findIndex(client => client.id === editedClient.id);
      if (index !== -1) {
        state.clients.splice(index, 1, editedClient); // Atualiza o cliente no estado Vuex local
      }
    },
    deleteClient(state, clientId) {
      clientService.deleteClient(clientId); // Remove o cliente do localStorage
      state.clients = state.clients.filter(client => client.id !== clientId); // Remove o cliente do estado Vuex local
    }
  },
  actions: {
    deleteClientAsync({
      commit
    }, clientId) {
      clientService.deleteClient(clientId);
      commit('deleteClient', clientId);
    }
  },
  getters: {
    getClientById: (state) => (clientId) => {
      return state.clients.find(client => client.id === clientId);
    }
  }
});

export default store;
