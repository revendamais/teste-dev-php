<template>
  <v-snackbar v-model="internalVisible" :color="snackbarColor" timeout="3000" top @input="updateVisibility">
    {{ text }}
    <template v-slot:action="{ attrs }">
      <v-btn color="white" text v-bind="attrs" @click="internalVisible = false">
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  name: 'Snackbar',
  props: {
    type: {
      type: String,
      required: true,
      validator: value => ['success', 'error'].includes(value),
    },
    text: {
      type: String,
      required: true,
    },
    visible: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      internalVisible: this.visible,
    };
  },
  watch: {
    visible(val) {
      this.internalVisible = val;
    },
    internalVisible(val) {
      this.$emit('update:visible', val);
    },
  },
  computed: {
    snackbarColor() {
      return this.type === 'success' ? 'green' : 'red';
    },
  },
  methods: {
    updateVisibility(val) {
      this.$emit('update:visible', val);
    },
  },
};
</script>

<style scoped></style>
