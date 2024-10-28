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
                <InputLabel for="email" value="Correo electrónico" />
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <Checkbox id="remember_me" v-model="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link href="/forgot-password" class="underline text-sm text-gray-600 hover:text-gray-900">
                    ¿Olvidaste tu contraseña?
                </Link>

                <PrimaryButton class="ml-4" :processing="form.processing">
                    Iniciar sesión
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'));
};
</script>
