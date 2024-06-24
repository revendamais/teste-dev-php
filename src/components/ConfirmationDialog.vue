<template>
  <v-dialog v-model="dialog" max-width="400">
    <v-card>
      <v-card-title class="headline">{{ text }}</v-card-title>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" text @click="cancelar">Cancelar</v-btn>
        <v-btn color="green darken-1" text @click="confirmar">Confirmar</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: 'ConfirmationDialog',
  props: {
    text: {
      type: String,
      required: true
    },
    value: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      dialog: this.value
    }
  },
  watch: {
    value(val) {
      this.dialog = val;
    },
    dialog(val) {
      this.$emit('input', val);
    }
  },
  methods: {
    confirmar() {
      this.$emit('confirmar');
      this.dialog = false;
    },
    cancelar() {
      this.$emit('cancelar');
      this.dialog = false;
    }
  }
}
</script>

<style scoped></style>
