<template>
  <v-card-title class="text-center">{{ title }}</v-card-title>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
  },
};
</script>

<style scoped>
.text-center {
  text-align: center;
}
</style>
