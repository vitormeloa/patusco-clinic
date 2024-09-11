<template>
  <v-app>
    <Header />
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Header from './components/Header.vue';

export default {
  name: 'App',
  components: {
    Header,
  },
};
</script>

<style scoped>
html, body, #app {
  height: 100%;
  margin: 0;
  font-family: 'Roboto', sans-serif;
}
</style>
