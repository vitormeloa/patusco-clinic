<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="400">
      <v-card-title class="text-center">Cadastro</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="register">
          <v-text-field
              v-model="name"
              label="Nome"
              required
              class="mb-3"
          ></v-text-field>
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
          <v-text-field
              v-model="password_confirmation"
              label="Confirmar Senha"
              type="password"
              required
              class="mb-3"
          ></v-text-field>
          <v-btn type="submit" color="primary" block>Cadastrar</v-btn>
        </v-form>
      </v-card-text>
      <v-card-actions class="justify-center">
        <p>
          Já possui uma conta?
          <v-btn class="mt-0" text @click="$router.push('/entrar')">Entrar</v-btn>
        </p>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Register',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('http://localhost/api/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          role_id: 1,
        });
        const token = response.data.access_token;
        localStorage.setItem('auth_token', token);
        this.$store.dispatch('login', token);
        this.$router.push('/');
      } catch (error) {
        console.error(error.response.data);
        alert('Erro ao cadastrar: ' + error.response.data.message || 'Verifique os dados.');
      }
    }
  }
};
</script>

<style scoped>
.v-container {
  min-height: 100vh;
}
</style>
