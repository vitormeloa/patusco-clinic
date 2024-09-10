<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-toolbar-title>O Patusco - Clínica Veterinária</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text @click="logout">Logout</v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <router-view />
      </v-container>
    </v-main>

    <v-footer app color="primary" dark>
      <span class="white--text">&copy; 2024 O Patusco</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  methods: {
    logout() {
      localStorage.removeItem('auth_token');
      this.$router.push('/login');
    },
  },
};
</script>

<style scoped>
.v-app-bar {
  position: fixed;
  top: 0;
}
.v-main {
  margin-top: 64px;
}
.v-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
}
</style>
