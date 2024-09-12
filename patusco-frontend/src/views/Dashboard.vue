<template>
  <v-container class="d-flex align-center justify-center mt-5">
    <v-card class="elevation-12 pa-4" width="1000">
      <v-card-text>
        <h1>Olá, Seja bem Vindo!</h1>
        <h3 class="text-center"> Patusco - Clínica de Pets </h3>
      </v-card-text>
      <v-card-text>
        <v-row class="d-flex justify-center">
          <v-col cols="6" class="d-flex justify-center">
            <v-btn color="primary" @click="$router.push('/consultas')" block>
              Ver Consultas
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
  </v-container>
</template>

<style scoped>
h1 {
  text-align: center;
  margin-top: 20px;
}
</style>
<script setup>
</script>