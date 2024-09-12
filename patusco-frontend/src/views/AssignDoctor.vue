<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="400">
      <v-card-title class="text-center">Atribuir Médico</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="assignDoctor">
          <select v-model="selectedDoctor" required>
            <option disabled value="">Selecione um Médico</option>
            <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
              {{ doctor.name }}
            </option>
          </select>
          <v-btn type="submit" color="primary" block class="mt-3">Atribuir</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AssignDoctor',
  data() {
    return {
      selectedDoctor: "",
      doctors: [],
    };
  },
  methods: {
    async fetchDoctors() {
      try {
        const response = await axios.get('http://localhost/api/doctors', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        this.doctors = response.data.data || [];
        console.log('Médicos recebidos:', this.doctors);
      } catch (error) {
        console.error('Erro ao carregar médicos:', error.response);
        alert('Erro ao carregar médicos.');
      }
    },
    async assignDoctor() {
      try {
        await axios.put(
            `http://localhost/api/appointments/${this.$route.params.id}/assign-doctor`,
            {doctor_id: this.selectedDoctor},
            {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              },
            }
        );
        this.$router.push('/consultas');
      } catch (error) {
        console.error('Erro ao atribuir médico:', error.response);
        alert('Erro ao atribuir médico.');
      }
    },
  },
  mounted() {
    this.fetchDoctors();
  },
};
</script>

<style scoped>
select {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.v-container {
  max-height: 80vh;
}

.v-card-title {
  text-align: center;
}

.v-btn {
  width: 100%;
}
</style>
