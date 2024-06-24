// clientService.js

const initialClients = [{
    id: '1',
    name: 'Cliente 1',
    cpfCnpj: '111.111.111-11',
    contact: '(11) 1111-1111',
    address: {
      cep: '11111-111',
      street: 'Rua Um',
      neighborhood: 'Bairro Um',
      city: 'Cidade Um',
      state: 'UF1'
    }
  },
  {
    id: '2',
    name: 'Cliente 2',
    cpfCnpj: '222.222.222-22',
    contact: '(22) 2222-2222',
    address: {
      cep: '22222-222',
      street: 'Rua Dois',
      neighborhood: 'Bairro Dois',
      city: 'Cidade Dois',
      state: 'UF2'
    }
  },
  {
    id: '3',
    name: 'Cliente 3',
    cpfCnpj: '333.333.333-33',
    contact: '(33) 3333-3333',
    address: {
      cep: '33333-333',
      street: 'Rua Três',
      neighborhood: 'Bairro Três',
      city: 'Cidade Três',
      state: 'UF3'
    }
  }
];

// Função para gerar um ID único para clientes
function generateClientId() {
  return '_' + Math.random().toString(36).substr(2, 9);
}

// Função para obter a lista de clientes do localStorage
export function getClients() {
  let clients = JSON.parse(localStorage.getItem('clients')) || initialClients;
  // Verifica se o localStorage está vazio e inicializa com os clientes iniciais
  if (!localStorage.getItem('clients')) {
    localStorage.setItem('clients', JSON.stringify(initialClients));
  }
  return clients;
}

// Função para adicionar um novo cliente ao localStorage
export function addClient(newClient) {
  const clients = getClients();
  newClient.id = generateClientId(); // Gera um ID único para o novo cliente
  clients.push(newClient);
  localStorage.setItem('clients', JSON.stringify(clients));
}

// Função para editar um cliente no localStorage
export function editClient(editedClient) {
  const clients = getClients();
  const index = clients.findIndex(client => client.id === editedClient.id);
  if (index !== -1) {
    clients.splice(index, 1, editedClient);
    localStorage.setItem('clients', JSON.stringify(clients));
  }
}

// Função para deletar um cliente do localStorage
export function deleteClient(clientId) {
  let clients = getClients();
  clients = clients.filter(client => client.id !== clientId);
  localStorage.setItem('clients', JSON.stringify(clients));
}

// Função para obter um cliente pelo ID do localStorage
export function getClientById(clientId) {
  const clients = getClients();
  return clients.find(client => client.id === clientId);
}
