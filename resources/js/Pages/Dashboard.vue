<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Toast from '@/Components/Toast.vue';

const page = usePage();
const users = page.props.value.users;
const searchQuery = ref('');
const sortKey = ref('');
const sortAsc = ref(true);
const authUser = page.props.value.auth.user;
const editingUser = ref(null);
const showModal = ref(false);

const toastMessage = ref(null);

const startEditUser = (user) => {
    editingUser.value = { ...user };
    showModal.value = true;
};

const updateUser = async () => {
    try {
        // Realiza la actualización del usuario
        await axios.put(route('user.update', editingUser.value.id), editingUser.value);
        showModal.value = false;

        // Guarda el mensaje en localStorage
        localStorage.setItem('toastMessage', 'Usuario actualizado con éxito');

        // Recarga la página
        window.location.reload();

    } catch (error) {
        // Muestra el mensaje de error si la actualización falla
        toastMessage.value = 'Hubo un error al actualizar al usuario.';
        setTimeout(() => {
            toastMessage.value = null;
        }, 3000); // El mensaje de error desaparece después de 3 segundos
    }
};

// Mostrar el mensaje después de recargar la página
if (localStorage.getItem('toastMessage')) {
    toastMessage.value = localStorage.getItem('toastMessage');
    localStorage.removeItem('toastMessage'); // Elimina el mensaje después de mostrarlo

    setTimeout(() => {
        toastMessage.value = null;
    }, 5000); // Mensaje desaparece después de 5 segundos
}



const exportCSV = () => {
    window.location.href = route('users.export.csv');
};

const exportPDF = () => {
    window.location.href = route('users.export.pdf');
};

const filteredUsers = computed(() => {
    let result = users;
    if (searchQuery.value) {
        result = result.filter(user =>
            user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            user.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            user.phone.includes(searchQuery.value) ||
            user.rfc.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
    if (sortKey.value) {
        result = [...result].sort((a, b) => {
            let result = 0;
            if (a[sortKey.value] < b[sortKey.value]) result = -1;
            if (a[sortKey.value] > b[sortKey.value]) result = 1;
            return sortAsc.value ? result : -result;
        });
    }
    return result;
});

const sortColumn = (key) => {
    if (sortKey.value === key) {
        sortAsc.value = !sortAsc.value;
    } else {
        sortKey.value = key;
        sortAsc.value = true;
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inicio
            </h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Bienvenido, {{ authUser.name }} ({{ authUser.email }})</h3>

                    <div class="flex justify-between my-4">
                        <input v-model="searchQuery" type="text" placeholder="Buscar..." class="border p-2 rounded w-1/3" />
                        <button @click="exportCSV" class="bg-green-500 text-white py-1 px-4 rounded">Exportar CSV</button>
                        <button @click="exportPDF" class="bg-red-500 text-white py-1 px-4 rounded ml-2">Exportar PDF</button>
                    </div>

                    <table class="min-w-full mt-4 bg-white border">
    <thead>
        <tr>
            <th class="py-2 px-4 border cursor-pointer" @click="sortColumn('name')">Nombre</th>
            <th class="py-2 px-4 border cursor-pointer" @click="sortColumn('email')">Correo</th>
            <th class="py-2 px-4 border cursor-pointer" @click="sortColumn('phone')">Teléfono</th>
            <th class="py-2 px-4 border cursor-pointer" @click="sortColumn('rfc')">RFC</th>
            <th class="py-2 px-4 border">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="user in filteredUsers" :key="user.id">
            <td class="py-2 px-4 border">{{ user.name }}</td>
            <td class="py-2 px-4 border">{{ user.email }}</td>
            <td class="py-2 px-4 border">{{ user.phone }}</td>
            <td class="py-2 px-4 border">{{ user.rfc }}</td>
            <td class="py-2 px-4 border">
                <button @click="startEditUser(user)" class="bg-blue-500 text-white py-1 px-2 rounded">Editar</button>
            </td>
        </tr>
    </tbody>
</table>
                </div>
            </div>
        </div>

        <!-- Modal para editar usuario -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Editar Usuario</h3>
                <label class="block mb-2">Nombre:</label>
                <input v-model="editingUser.name" type="text" class="w-full mb-4 p-2 border rounded" required />

                <label class="block mb-2">Teléfono:</label>
                <input v-model="editingUser.phone" type="text" class="w-full mb-4 p-2 border rounded" required />

                <label class="block mb-2">RFC:</label>
                <input v-model="editingUser.rfc" type="text" class="w-full mb-4 p-2 border rounded" required />

                <label class="block mb-2">Contraseña (dejar en blanco para no cambiarla):</label>
                <input v-model="editingUser.password" type="password" class="w-full mb-4 p-2 border rounded" />

                <div class="flex justify-end">
                    <button @click="showModal = false" class="bg-gray-500 text-white py-1 px-4 rounded mr-2">Cancelar</button>
                    <button @click="updateUser" class="bg-blue-500 text-white py-1 px-4 rounded">Guardar</button>
                </div>
            </div>
        </div>

        <Toast :message="toastMessage"/>
    </AuthenticatedLayout>
</template>

<style scoped>
.modal {
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
