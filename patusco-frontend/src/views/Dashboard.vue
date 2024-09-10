<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>Dashboard - Consultas</v-card-title>
          <v-card-text>
            <v-btn color="primary" @click="fetchAppointments">Ver Consultas</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row v-if="appointments.length">
      <v-col cols="12">
        <v-list>
          <v-list-item-group>
            <v-list-item v-for="appointment in appointments" :key="appointment.id">
              <v-list-item-content>
                <v-list-item-title>{{ appointment.animal_name }} - {{ appointment.appointment_date }}</v-list-item-title>
                <v-list-item-subtitle>Cliente: {{ appointment.customer_name }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      appointments: [],
    };
  },
  methods: {
    async fetchAppointments() {
      const token = localStorage.getItem('auth_token');
      const response = await axios.get('http://localhost:8000/api/appointments', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      this.appointments = response.data;
    },
  },
};
</script>

<style scoped>
.v-container {
  margin-top: 20px;
}
</style>