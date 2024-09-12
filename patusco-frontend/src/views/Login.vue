<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="400">
      <v-card-title class="text-center">Login</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="login">
          <v-text-field
              v-model="email"
              label="Email"
              type="email"
              required
              class="mb-3"
          ></v-text-field>
          <v-text-field
              v-model="password"
              label="Senha"
              type="password"
              required
              class="mb-3"
          ></v-text-field>
          <v-btn type="submit" color="primary" block>Entrar</v-btn>
        </v-form>
      </v-card-text>
      <v-card-actions class="justify-center">
        <p>
          Não tem uma conta?
          <v-btn class="mt-0" text @click="$router.push('/cadastro')">Cadastre-se</v-btn>
        </p>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://localhost/api/login', {
          email: this.email,
          password: this.password
        });

        const token = response.data.access_token;
        this.$store.dispatch('login', token);
        this.$router.push('/');
      } catch (error) {
        alert('Erro ao fazer login.');
      }
    },
  }
};
</script>

<style scoped>
.v-container {
  min-height: 100vh;
}
.v-btn {
  margin-top: 16px;
}
</style>