<template>
  <v-container class="fill-height">
    <v-row justify="center" align="center">
      <v-col cols="12" md="4">
        <v-card>
          <v-card-title class="text-center">Login</v-card-title>
          <v-card-text>
            <v-form @submit.prevent="login">
              <v-text-field v-model="email" label="Email" required></v-text-field>
              <v-text-field v-model="password" label="Senha" type="password" required></v-text-field>
              <v-btn type="submit" color="primary" block>Entrar</v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>

import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://localhost:8000/api/login', {
          email: this.email,
          password: this.password,
        });

        localStorage.setItem('auth_token', response.data.token);
        this.$router.push('/');
      } catch (error) {
        alert('Erro no login. Verifique suas credenciais.');
      }
    },
  },
};
</script>

<style scoped>
.v-container {
  min-height: 100vh;
}
</style>