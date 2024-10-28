<template>
    <div v-if="errors && errors.length" class="alert alert-danger">
      <ul class="mb-0">
        <li v-for="(error, index) in errors" :key="index">
          {{ error }}
        </li>
      </ul>
    </div>
  </template>

  <script>
  export default {
    props: {
      errors: {
        type: Array,
        default: () => [],  // Valor por defecto si no se proporcionan errores
      },
    },
  };
  </script>

  <style scoped>
  .alert {
    margin-bottom: 1rem;
  }
  </style>
