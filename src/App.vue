<!-- src/App.vue -->
<template>
  <v-app :theme="theme">
    <v-main>
      <v-container>
        <router-view />
      </v-container>
    </v-main>
    <MenuSideBar />
  </v-app>
</template>

<script>
import MenuSideBar from './components/MenuSideBar.vue';

export default {
  name: 'App',
  components: {
    MenuSideBar,
  },

};
</script>
