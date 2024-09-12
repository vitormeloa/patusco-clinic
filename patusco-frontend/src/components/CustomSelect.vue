<template>
  <div class="custom-select-wrapper">
    <select v-model="modelValue" :required="required">
      <option disabled value="">{{ placeholder }}</option>
      <option v-for="option in options" :key="option.value" :value="option.value">
        {{ option.text }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      required: true,
    },
    options: {
      type: Array,
      required: true,
    },
    placeholder: {
      type: String,
      default: 'Selecione uma opção',
    },
    required: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    updateValue(event) {
      this.$emit('update:modelValue', event.target.value);
    },
  },
  watch: {
    modelValue(value) {
      this.updateValue(value);
    },
  },
};
</script>

<style scoped>
select {
  width: 100%;
  padding: 10px 15px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: white;
  margin-bottom: 16px;
  transition: border-color 0.3s ease;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

select:focus {
  outline: none;
  border-color: #1976d2;
}

.custom-select-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.custom-select-wrapper::after {
  content: "▼";
  position: absolute;
  right: 10px;
  top: 12px;
  font-size: 12px;
  color: #999;
  pointer-events: none;
}
</style>
