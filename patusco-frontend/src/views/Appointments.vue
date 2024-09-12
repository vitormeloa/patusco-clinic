<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="800">
      <v-card-title class="text-center">Gerenciar Consultas</v-card-title>
      <v-card-text>
        <v-row class="d-flex justify-center">
          <v-col cols="6" class="d-flex justify-center">
            <v-btn color="primary" @click="fetchAppointments" block>
              Carregar Consultas
            </v-btn>
          </v-col>
          <v-col cols="6" class="d-flex justify-center">
            <v-btn color="primary" @click="$router.push('/consultas/nova')" block>
              Nova Consulta
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>

    <v-card class="elevation-12 pa-4" width="800">
      <v-card-title class="text-center">Consultas</v-card-title>
      <v-card-text>
        <v-data-table
            :headers="headers"
            :items="appointments"
            class="elevation-1"
            item-value="id"
        >
          <template v-slot:item.period="{ item }">
            {{ item.period === 'morning' ? 'Manhã' : 'Tarde' }}
          </template>

          <template v-slot:item.actions="{ item }">
            <v-row class="d-flex justify-center justify-space-between">
              <v-col cols="4" class="d-flex justify-center">
                <v-btn class="actions"
                    color="primary"
                    v-if="!item.doctor_id"
                    @click="$router.push(`/consultas/${item.id}/atribuir-medico`)">
                  Médico
                </v-btn>
              </v-col>
              <v-col cols="4" class="d-flex justify-center">
                <v-btn class="actions" color="primary" @click="$router.push(`/consultas/${item.id}`)">
                  Editar
                </v-btn>
              </v-col>
              <v-col cols="4" class="d-flex justify-center">
                <v-btn class="actions" color="error" @click="deleteAppointment(item.id)">
                  Excluir
                </v-btn>
              </v-col>
            </v-row>
          </template>
        </v-data-table>

        <v-alert v-if="!appointments.length" type="info" class="mt-4">
          Nenhuma consulta encontrada.
        </v-alert>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Appointments',
  data() {
    return {
      appointments: [],
      headers: [
        { text: 'Nome do Animal', value: 'animal_name', align: 'start' },
        { text: 'Tipo do Animal', value: 'animal_type', align: 'start' },
        { text: 'Data da Consulta', value: 'appointment_date', align: 'start' },
        { text: 'Período', value: 'period', align: 'start' },
        { text: 'Sintomas', value: 'symptoms', align: 'start' },
        { text: 'Ações', value: 'actions', align: 'start', sortable: false },
      ],
    };
  },
  methods: {
    async fetchAppointments() {
      try {
        const response = await axios.get('http://localhost/api/appointments', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        this.appointments = response.data.data;
      } catch (error) {
        if (error.response) {
          console.error('Erro na resposta da API:', error.response.data);
          alert(`Erro ao carregar consultas: ${error.response.status} - ${error.response.data.message}`);
        } else if (error.request) {
          console.error('Nenhuma resposta recebida:', error.request);
          alert('Erro ao carregar consultas: Nenhuma resposta do servidor.');
        } else {
          console.error('Erro ao configurar a requisição:', error.message);
          alert('Erro ao carregar consultas.');
        }
      }
    },
    async deleteAppointment(id) {
      try {
        await axios.delete(`http://localhost/api/appointments/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        this.fetchAppointments();
      } catch (error) {
        alert('Erro ao excluir a consulta.');
      }
    },
  },
  mounted() {
    this.fetchAppointments();
  },
};
</script>

<style scoped>
.v-container {
  min-height: 100vh;
  max-height: 100vh;
}

.v-card-title {
  text-align: center;
}

.v-btn.actions {
  width: 100%;
  font-size: 12px;
  margin-outside: 10px;
  margin-inline: 10px;
}
</style>
