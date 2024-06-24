<template>
  <v-dialog v-model="localDialog" max-width="600px">
    <v-card>
      <v-card-title class="headline">{{ formTitle }}</v-card-title>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field v-model="formData.name" :rules="[rules.required]" label="Nome/Nome da Empresa"
            required></v-text-field>
          <v-text-field v-model="formData.cpfCnpj" :rules="[rules.required, rules.cpfCnpj]" label="CPF ou CNPJ"
            required></v-text-field>
          <v-text-field v-model="formData.contact" :rules="[rules.required]" label="Contato" required></v-text-field>
          <v-text-field v-model="formData.address.cep" @blur="fetchAddressByCep" :rules="[rules.required]" label="CEP"
            required></v-text-field>
          <v-text-field v-model="formData.address.street" :rules="[rules.required]" label="Rua" required></v-text-field>
          <v-text-field v-model="formData.address.neighborhood" :rules="[rules.required]" label="Bairro"
            required></v-text-field>
          <v-text-field v-model="formData.address.city" :rules="[rules.required]" label="Cidade"
            required></v-text-field>
          <v-text-field v-model="formData.address.state" :rules="[rules.required]" label="Estado"
            required></v-text-field>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red" @click="closeDialog">Cancelar</v-btn>
        <v-btn color="success" @click="submit">{{ submitLabel }}</v-btn>
      </v-card-actions>
      <SnackBar v-if="snackbarType && snackbarText" :type="snackbarType" :text="snackbarText"
        v-model:visible="snackbarVisible" />
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios';
import SnackBar from './SnackbarComponent.vue'

export default {
  name: "ClientForm",
  components: {
    SnackBar
  },
  props: {
    dialog: {
      type: Boolean,
      required: true
    },
    client: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      snackbarVisible: false,
      snackbarType: '',
      snackbarText: '',
      localDialog: this.dialog,
      valid: false,
      formData: {
        name: '',
        cpfCnpj: '',
        contact: '',
        address: {
          cep: '',
          street: '',
          neighborhood: '',
          city: '',
          state: ''
        }
      },
      rules: {
        required: value => !!value || 'Campo obrigatório',
        cpfCnpj: value => this.validateCpfCnpj(value) || 'CPF ou CNPJ inválido'
      },
      editingMode: false
    };
  },
  computed: {
    formTitle() {
      return this.editingMode ? 'Editar Fornecedor' : 'Cadastrar Fornecedor';
    },
    submitLabel() {
      return this.editingMode ? 'Salvar' : 'Cadastrar';
    }
  },
  watch: {
    dialog(val) {
      this.snackbarVisible = false;
      this.localDialog = val;
      if (!val) {
        this.resetForm();
      }
    },
    client: {
      handler(val) {
        if (val) {
          this.formData.name = val.name || "";
          this.formData.cpfCnpj = val.cpfCnpj || "";
          this.formData.contact = val.contact || "";
          if (val.address) {
            this.formData.address = { ...val.address };
          }
          this.editingMode = true;
        } else {
          this.resetForm();
          this.editingMode = false;
        }
      },
      immediate: true
    }
  },
  methods: {
    async fetchAddressByCep() {
      const cep = this.formData.address.cep.replace(/\D/g, '');

      if (cep.length !== 8) {
        return;
      }

      try {
        const response = await axios.get(`https://viacep.com.br/ws/${cep}/json/`);
        const addressData = response.data;

        if (!addressData.erro) {
          this.formData.address.street = addressData.logradouro || '';
          this.formData.address.neighborhood = addressData.bairro || '';
          this.formData.address.city = addressData.localidade || '';
          this.formData.address.state = addressData.uf || '';
        } else {
          alert('CEP não encontrado. Verifique e tente novamente.');
        }
      } catch (error) {
        console.error('Erro ao buscar endereço:', error);
        alert('Ocorreu um erro ao buscar o endereço. Tente novamente mais tarde.');
      }
    },
    showSuccessSnackbar(msg) {
      console.log("here")
      this.snackbarType = 'success';
      this.snackbarText = msg;
      this.snackbarVisible = true;
    },
    showErrorSnackbar() {
      this.snackbarType = 'error';
      this.snackbarText = 'Preencha todos os dados';
      this.snackbarVisible = true;
    },
    submit() {

      const isFormFilled = Object.values(this.formData).every(value => {
        if (typeof value === 'object') {
          return Object.values(value).every(subValue => !!subValue);
        }
        return !!value;
      });

      if (!isFormFilled) {
        this.showErrorSnackbar()
        return;
      }

      if (this.$refs.form.validate()) {
        const clientData = {
          name: this.formData.name,
          cpfCnpj: this.formData.cpfCnpj,
          contact: this.formData.contact,
          address: { ...this.formData.address }
        };

        if (this.editingMode) {
          clientData.id = this.client.id;
          this.$store.commit('editClient', clientData);
          this.showSuccessSnackbar('Cliente editado com sucesso!');
        } else {
          this.$store.commit('addClient', clientData);
          this.showSuccessSnackbar('Novo cliente adicionado com sucesso!');
        }

        this.closeDialog();
      }
    },
    closeDialog() {
      this.$emit('close');
      this.localDialog = false;
      this.resetForm();
    },
    resetForm() {
      this.formData.name = "";
      this.formData.cpfCnpj = "";
      this.formData.contact = "";
      this.formData.address = {
        cep: '',
        street: '',
        neighborhood: '',
        city: '',
        state: ''
      };
      if (this.$refs.form) {
        this.$refs.form.resetValidation();
      }
    },
    validateCpfCnpj(value) {
      const cleaned = value.replace(/\D/g, '');
      if (cleaned.length === 11) {
        return this.validateCpf(cleaned);
      }
      else if (cleaned.length === 14) {
        return this.validateCnpj(cleaned);
      }
      return false;
    },
    validateCpf(cpf) {
      cpf = cpf.replace(/[^\d]+/g, '');
      if (cpf.length !== 11) return false;
      let sum = 0;
      let remainder;
      if (cpf === "00000000000") return false;
      for (let i = 1; i <= 9; i++) sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
      remainder = (sum * 10) % 11;
      if ((remainder === 10) || (remainder === 11)) remainder = 0;
      if (remainder !== parseInt(cpf.substring(9, 10))) return false;
      sum = 0;
      for (let i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
      remainder = (sum * 10) % 11;
      if ((remainder === 10) || (remainder === 11)) remainder = 0;
      if (remainder !== parseInt(cpf.substring(10, 11))) return false;
      return true;
    },
    validateCnpj(cnpj) {
      cnpj = cnpj.replace(/[^\d]+/g, '');
      if (cnpj.length !== 14) return false;
      if (/^(\d)\1+$/.test(cnpj)) return false;
      let length = cnpj.length - 2;
      let numbers = cnpj.substring(0, length);
      let digits = cnpj.substring(length);
      let sum = 0;
      let pos = length - 7;
      for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
      }
      let result = sum % 11 < 2 ? 0 : 11 - sum % 11;
      if (result !== parseInt(digits.charAt(0))) return false;
      length = length + 1;
      numbers = cnpj.substring(0, length);
      sum = 0;
      pos = length - 7;
      for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
      }
      result = sum % 11 < 2 ? 0 : 11 - sum % 11;
      if (result !== parseInt(digits.charAt(1))) return false;
      return true;
    }
  }
};
</script>

<style scoped></style>
