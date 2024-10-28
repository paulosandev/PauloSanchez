<template>
    <button @click="logout" class="btn btn-danger">Cerrar sesión</button>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';

const logout = () => {
    Inertia.post(route('logout'));
};
</script>
