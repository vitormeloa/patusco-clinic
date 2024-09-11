<template>
  <v-app-bar app>
    <v-toolbar-title><b>O Patusco</b></v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn
        v-if="!isAuthenticated"
        text
        @click="$router.push('/entrar')"
    >
      Entrar
    </v-btn>
    <v-btn
        v-if="!isAuthenticated"
        text
        @click="$router.push('/cadastro')"
    >
      Cadastrar
    </v-btn>

    <v-btn
        v-if="isAuthenticated"
        text
        @click="handleLogout"
    >
      Sair
    </v-btn>
  </v-app-bar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'Header',
  computed: {
    ...mapGetters(['isAuthenticated']),
  },
  methods: {
    ...mapActions(['logout']),
    handleLogout() {
      this.$router.push('/entrar');
      this.logout();
    },
  },
};
</script>