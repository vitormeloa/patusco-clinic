<template>
  <v-container class="d-flex align-center justify-center fill-height">
    <v-card class="elevation-12 pa-4" width="600">
      <v-card-title class="text-center">Editar Consulta</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="updateAppointment">

          <div v-if="isReceptionist" class="mb-3">
            <label for="customer" class="custom-label">Selecione o Cliente</label>
            <select v-model="appointment.customer_id" class="custom-select" required>
              <option disabled value="">Escolha um cliente</option>
              <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                {{ customer.name }}
              </option>
            </select>
          </div>

          <v-text-field
              v-model="appointment.animal_name"
              label="Nome do Animal"
              required
          ></v-text-field>

          <v-text-field
              v-model="appointment.animal_type"
              label="Tipo de Animal (Cão, Gato, etc.)"
              required
          ></v-text-field>

          <v-text-field
              v-model="appointment.age"
              label="Idade do Animal"
              type="number"
              required
          ></v-text-field>

          <v-textarea
              v-model="appointment.symptoms"
              label="Sintomas"
              required
          ></v-textarea>

          <v-text-field
              v-model="appointment.appointment_date"
              label="Data da Consulta"
              type="date"
              prepend-icon="mdi-calendar"
              required
          ></v-text-field>

          <div class="mb-3">
            <label for="period" class="custom-label">Período da Consulta</label>
            <select v-model="appointment.period" class="custom-select" required>
              <option value="morning">Manhã</option>
              <option value="afternoon">Tarde</option>
            </select>
          </div>

          <v-btn type="submit" color="primary" block>Salvar Alterações</v-btn>
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
      appointment: {
        animal_name: '',
        animal_type: '',
        age: '',
        symptoms: '',
        appointment_date: '',
        period: '',
        customer_id: null,
      },
      customers: [],
      isReceptionist: false,
    };
  },
  methods: {
    async fetchAppointment() {
      try {
        const response = await axios.get(`http://localhost/api/appointments/${this.$route.params.id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        this.appointment = response.data;
      } catch (error) {
        alert('Erro ao carregar consulta.');
      }
    },
    async updateAppointment() {
      try {
        await axios.put(`http://localhost/api/appointments/${this.$route.params.id}`, this.appointment, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        alert('Consulta atualizada com sucesso!');
        this.$router.push('/consultas');
      } catch (error) {
        alert('Erro ao atualizar consulta.');
      }
    },
    async fetchCustomers() {
      try {
        const response = await axios.get('http://localhost/api/customers', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        this.customers = response.data.data;
      } catch (error) {
        console.error('Erro ao carregar clientes.', error);
      }
    },
    async checkUserRole() {
      try {
        const response = await axios.get('http://localhost/api/user', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        const user = response.data;
        if (user.role_id === 2) {
          this.isReceptionist = true;
          await this.fetchCustomers();
        } else {
          this.appointment.customer_id = user.id;
        }
      } catch (error) {
        console.error('Erro ao verificar o usuário.', error);
      }
    },
  },
  mounted() {
    this.checkUserRole();
    this.fetchAppointment();
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

.custom-select {
  display: block;
  width: 100%;
  padding: 10px;
  font-size: 16px;
  line-height: 1.5;
  color: #495057;
  background-color: #EDEDED;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.375rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  margin-bottom: 20px;
}

.custom-select:focus {
  border-color: #3f51b5;
  box-shadow: 0 0 0 0.2rem rgba(63, 81, 181, 0.25);
}

.custom-label {
  font-size: 16px;
  color: #495057;
  margin-bottom: 8px;
  display: block;
}

.form-select {
  margin-bottom: 20px;
}
</style>