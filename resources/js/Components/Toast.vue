<template>
    <div v-if="visible" class="fixed top-4 right-4 bg-gray-800 text-white p-4 rounded shadow-lg z-50">
      {{ message }}
    </div>
  </template>

  <script setup>
  import { ref, watchEffect } from 'vue';

  const props = defineProps({
    message: String,
    duration: {
      type: Number,
      default: 3000,
    },
  });

  const visible = ref(false);

  watchEffect(() => {
    if (props.message) {
      visible.value = true;
      setTimeout(() => {
        visible.value = false;
      }, props.duration);
    }
  });
  </script>

  <style scoped>
  .fixed {
    position: fixed;
  }
  .top-4 {
    top: 1rem;
  }
  .right-4 {
    right: 1rem;
  }
  </style>
