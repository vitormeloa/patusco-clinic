<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="600">
      <v-card-title class="text-center">Nova Consulta</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="createAppointment">
          <v-text-field
              v-model="animal_name"
              label="Nome do Animal"
              required
          ></v-text-field>

          <v-text-field
              v-model="animal_type"
              label="Tipo de Animal (Cão, Gato, etc.)"
              required
          ></v-text-field>

          <v-text-field
              v-model="age"
              label="Idade do Animal"
              type="number"
              required
          ></v-text-field>

          <v-textarea
              v-model="symptoms"
              label="Sintomas"
              required
          ></v-textarea>

          <v-text-field
              v-model="appointment_date"
              label="Data da Consulta"
              type="date"
              prepend-icon="mdi-calendar"
              required
          ></v-text-field>

          <v-select
              v-model="period"
              :items="['morning', 'afternoon']"
              label="Período da Consulta"
              prepend-icon="mdi-clock-time-four-outline"
              required
          ></v-select>

          <v-btn type="submit" color="primary" block>Criar Consulta</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      animal_name: '',
      animal_type: '',
      age: '',
      symptoms: '',
      appointment_date: '',
      period: '',
      menu: false,
    };
  },
  methods: {
    async createAppointment() {
      try {
        const response = await axios.post('http://localhost/api/appointments', {
          animal_name: this.animal_name,
          animal_type: this.animal_type,
          age: this.age,
          symptoms: this.symptoms,
          appointment_date: this.appointment_date,
          period: this.period,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        alert('Consulta criada com sucesso!');
        this.$router.push('/consultas');
      } catch (error) {
        alert('Erro ao criar consulta.');
      }
    },
  },
};
</script>

<style scoped>
.v-container {
  min-height: 100vh;
}

.v-card-title {
  text-align: center;
}

.v-btn {
  width: 100%;
}

.v-select, .v-text-field {
  margin-bottom: 20px;
}
</style>
