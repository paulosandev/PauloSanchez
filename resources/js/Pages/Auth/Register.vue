<template>
    <GuestLayout>
        <template #logo>
            <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </template>

        <ValidationErrors class="mb-4" :errors="errors" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nombre" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Teléfono" />
                <TextInput id="phone" v-model="form.phone" type="tel" class="mt-1 block w-full" required maxlength="10"
                    @input="form.phone = form.phone.replace(/[^0-9]/g, '')" />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Correo" />
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="rfc" value="RFC" />
                <TextInput id="rfc" v-model="form.rfc" type="text" class="mt-1 block w-full" required maxlength="13"
                    @input="form.rfc = form.rfc.replace(/[^a-zA-Z0-9]/g, '').toUpperCase()" />
                <InputError :message="form.errors.rfc" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmación de Contraseña" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" required />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="notes" value="Notas" />
                <textarea id="notes" v-model="form.notes" class="form-control mt-1 block w-full"></textarea>
                <InputError :message="form.errors.notes" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :processing="form.processing">
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';

const form = useForm({
    name: '',
    phone: '',
    email: '',
    rfc: '',
    password: '',
    password_confirmation: '',
    notes: '',
});

const submit = () => {
    form.post(route('register'));
};
</script>
