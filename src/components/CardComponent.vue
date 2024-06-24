<template>
  <v-card :color="backgroundColor" outlined class="ma-2" max-width="300">
    <v-card-title>{{ title }}</v-card-title>
    <v-card-text>
      <v-row align="center">
        <v-col cols="auto">
          <v-icon>{{ icon }}</v-icon>
        </v-col>
        <v-col cols="auto" class="ml-2">
          <div>{{ value }}</div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'CardComponent',
  props: {
    backgroundColor: {
      type: String,
      default: 'white', // Cor de fundo padrão
    },
    title: {
      type: String,
      required: true,
    },
    value: {
      type: Number,
      required: true,
    },
    icon: {
      type: String,
      required: true,
    },
  },
};
</script>
