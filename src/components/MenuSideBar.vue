<template>
  <v-navigation-drawer v-model="isDrawerOpen" app>
    <v-list>
      <router-link to="/" tag="v-list-item" exact class="custom-link">
        <v-list-item prepend-icon="mdi-home" :class="{ 'active-link': $route.path === '/' }">
          Dashboard
        </v-list-item>
      </router-link>
      <router-link to="/clientes" tag="v-list-item" exact class="custom-link">
        <v-list-item prepend-icon="mdi-account" :class="{ 'active-link': $route.path === '/clientes' }">
          Clientes
        </v-list-item>
      </router-link>

    </v-list>
  </v-navigation-drawer>
  <v-app-bar app>
    <v-app-bar-nav-icon @click="isDrawerOpen = !isDrawerOpen"></v-app-bar-nav-icon>
    <v-toolbar-title>RevendaMais</v-toolbar-title>
  </v-app-bar>
</template>

<script>
export default {
  name: 'MenuSideBar',

  data() {
    return {
      isDrawerOpen: false,
    };
  },
};
</script>

<style scoped>
.custom-link {
  color: inherit;
  text-decoration: none;
}

.active-link {
  background-color: #f0f0f0;
}
</style>
