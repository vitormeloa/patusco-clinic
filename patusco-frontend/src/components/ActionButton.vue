<template>
  <v-btn :color="color" block @click="onClick">
    {{ label }}
  </v-btn>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      required: true,
    },
    color: {
      type: String,
      default: 'primary',
    },
    onClick: {
      type: Function,
      required: true,
    },
  },
};
</script>

<style scoped>
.v-btn {
  width: 100%;
}
</style>
